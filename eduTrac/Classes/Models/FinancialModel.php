<?php namespace eduTrac\Classes\Models;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Financial Model
 *  
 * PHP 5.4+
 *
 * eduTrac(tm) : Student Information System (http://www.7mediaws.org/)
 * @copyright (c) 2013 7 Media Web Solutions, LLC
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 3
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 * 
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License, version 3
 * @link        http://www.7mediaws.org/
 * @since       1.0.3
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */

use \eduTrac\Classes\Core\DB;
class FinancialModel {
    
    private $_auth;
    private $_log;
	
	public function __construct() {
        $this->_auth = new \eduTrac\Classes\Libraries\Cookies; 
        $this->_log = new \eduTrac\Classes\Libraries\Log;  
	}
    
    public function search() {
        $array = [];
        $post = isPostSet('invoice');
        $bind = [ ":invoice" => "%$post%" ];
        
        $q = DB::inst()->query( "SELECT a.ID,a.stuID,a.termID,b.termCode,c.fname,c.lname,c.uname 
                FROM 
                    invoice a 
                LEFT JOIN 
                    term b 
                ON 
                    a.termID = b.termID 
                LEFT JOIN 
                    person c
                ON 
                    a.stuID = c.personID 
                WHERE 
                    (CONCAT(c.fname,' ',c.lname) LIKE :invoice
                OR 
                    CONCAT(c.lname,' ',c.fname) LIKE :invoice 
                OR 
                    CONCAT(c.lname,', ',c.fname) LIKE :invoice) 
                OR 
                    c.fname LIKE :invoice 
                OR 
                    c.lname LIKE :invoice 
                OR 
                    c.uname LIKE :invoice 
                OR 
                    a.stuID LIKE :invoice 
                GROUP BY 
                    a.stuID,a.termID",
                $bind
        );
        
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
        
        redirect( BASE_URL . 'application/' );
    }
    
    public function billingTable() {
        $array = [];
        $q = DB::inst()->query( "SELECT 
                    CASE 
                        status 
                    WHEN 
                        'A' 
                    THEN 
                        'Active' 
                    ELSE 
                        'Inactive' 
                    END AS 
                        'Status',
                        ID,
                        name,
                        amount,
                        status 
                    FROM 
                        billing_table" );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function invoice($id) {
        $array = [];
        $bind = [ ":id" => $id,":termID" => isGetSet('termID') ];
        $q = DB::inst()->query( "SELECT 
                        a.ID AS 'FeeID',
                        a.stuID,
                        b.name,
                        b.amount,
                        d.termName 
                    FROM 
                        student_fee a 
                    LEFT JOIN 
                        billing_table b 
                    ON 
                        a.feeID = b.ID 
                    LEFT JOIN 
                        invoice c 
                    ON 
                        a.stuID = c.stuID 
                    LEFT JOIN 
                        term d 
                    ON 
                        c.termID = d.termID 
                    WHERE 
                        c.stuID = :id 
                    AND 
                        c.termID = :termID 
                    AND 
                        a.invoiceID = c.ID",
                    $bind 
        );
        
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function address($id) {
        $array = [];
        $bind = array( ":id" => $id );
        $q = DB::inst()->query( "SELECT * 
            FROM 
                address 
            WHERE 
                personID = :id 
            AND 
                addressStatus = 'C' 
            AND 
                (endDate = '' OR endDate = '0000-00-00')",
            $bind
        );
        
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function beginBalance($id) {
        $array = [];
        $bind = [ ":stuID" => $id, ":termID" => isGetSet('termID') ];
        $q = DB::inst()->query( "SELECT 
                        SUM(b.amount) 
                    FROM 
                        student_fee a 
                    LEFT JOIN 
                        billing_table b 
                    ON 
                        a.feeID = b.ID 
                    LEFT JOIN 
                        invoice c 
                    ON 
                        a.invoiceID = c.ID 
                    WHERE 
                        a.stuID = c.stuID 
                    AND 
                        c.stuID = :stuID 
                    AND 
                        c.termID = :termID 
                    GROUP BY 
                        c.stuID,c.termID",
                    $bind 
        );
        foreach($q as $r) {
            $array[] = money_format('-%n', $r['SUM(b.amount)']);
        }
        
        return $array;
    }
    
    public function endBalance($id) {
        $array1 = [];
        $array2 = [];
        $bind = [ ":stuID" => $id, ":termID" => isGetSet('termID') ];
        $q1 = DB::inst()->query( "SELECT 
                        SUM(b.amount) 
                    FROM 
                        student_fee a 
                    LEFT JOIN 
                        billing_table b 
                    ON 
                        a.feeID = b.ID 
                    LEFT JOIN 
                        invoice c 
                    ON 
                        a.invoiceID = c.ID 
                    WHERE 
                        a.stuID = c.stuID 
                    AND 
                        c.stuID = :stuID 
                    AND 
                        c.termID = :termID 
                    GROUP BY 
                        c.stuID,c.termID",
                    $bind 
        );
        foreach($q1 as $r1) {
            $array1[] = money_format('-%n', $r1['SUM(b.amount)']);
        }
        
        $q2 = DB::inst()->query( "SELECT 
                        SUM(amount) 
                    FROM 
                        payment 
                    WHERE 
                        stuID = :stuID 
                    AND 
                        termID = :termID 
                    GROUP BY 
                        stuID,termID",
                    $bind 
        );
        foreach($q2 as $r2) {
            $array2[] = $r2['SUM(amount)'];
        }
        
        $balance = $array1 + $array2;
        
        if(count($q2) <= 0) {
            return $array1;
        } else {
            return $balance;
        }
    }
    
    public function payment($id) {
        $array = [];
        $bind = [ ":id" => $id,":termID" => isGetSet('termID') ];
        $q = DB::inst()->query( "SELECT 
                        a.amount,
                        a.paymentType 
                    FROM 
                        payment a 
                    LEFT JOIN 
                        invoice b 
                    ON 
                        a.stuID = b.stuID 
                    WHERE 
                        a.termID = b.termID 
                    AND 
                        a.stuID = :id 
                    AND 
                        a.termID = :termID",
                    $bind 
        );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function runBillTable($data) {
        if($data['update'] == 1 ) {
            $bind = [ ":ID" => $data['ID'] ];
            $update = [ 
                    "name" => $data['name'],"amount" => $data['amount'],
                    "status" => $data['status']
                    ];
                    
            $q = DB::inst()->update("billing_table",$update,"ID = :ID",$bind);
            
            $this->_log->setLog('Update Record','Billing Table',$data['name']);
            redirect( BASE_URL . 'financial/billing_table/' . bm() );
        } else {
            $date = date("Y-m-d");
            $bind = [ 
                    "name" => $data['name'],"amount" => $data['amount'],
                    "status" => $data['status'],"addDate" => $date
                    ];
                    
            $q = DB::inst()->insert( "billing_table", $bind );
            
            if(!$q) {
                redirect( BASE_URL . 'error/save_data/' );
            } else {
                $this->_log->setLog('New Record','Billing Table',$data['name']);
                redirect( BASE_URL . 'financial/billing_table/' . bm() );
            }
        }
    }
    
    public function runStuLookup($data) {
        $bind = [ ":id" => $data['stuID'] ];
        $q = DB::inst()->select( "student","stuID = :id","","stuID",$bind );
        foreach($q as $k => $v) {
            $json = [ 'input#stuName' => get_name(_h($v['stuID'])) ];
        }
        echo json_encode($json);
    }
    
    public function runInvoice($data) {
        $array = [];
        /**
         * Check to see if an invoice was already created for the particular student 
         * for the requested term.
         */
        $bind1 = [ ":stuID" => $data['stuID'],":termID" => $data['termID'] ];
        $q1 = DB::inst()->select( "invoice","stuID = :stuID AND termID = :termID","","*",$bind1 );
        foreach($q1 as $r) {
            $array[] = $r;
        }
        
        /**
         * If the above records return 0, then create a new invoice and enter an array 
         * of fees for the student into the student_fee table.
         */
        if(count($q1) <= 0) {
            $bind2 = [ "stuID" => $data['stuID'],"termID" => $data['termID'],
                       "dateTime" => date('Y-m-d h:m:s') 
                     ];
            $q2 = DB::inst()->insert( "invoice", $bind2 );
            $ID = DB::inst()->lastInsertId('ID');
            
            $size = count($data['feeID']);
            $i = 0;
            while($i < $size) {
                $bind3 = [ "stuID" => $data['stuID'],"invoiceID" => $ID,
                           "feeID" => $data['feeID'][$i] 
                         ];
                $q3 = DB::inst()->insert( "student_fee", $bind3 );
            ++$i;
            }
        }
        
        /**
         * If an invoice already exists for a student for the requested term, 
         * then new fees will be added to the invoice.
         */
        else {
            $size = count($data['feeID']);
            $i = 0;
            while($i < $size) {
                $bind3 = [ "stuID" => $data['stuID'],"invoiceID" => $r['ID'],
                           "feeID" => $data['feeID'][$i] 
                         ];
                $q3 = DB::inst()->insert( "student_fee", $bind3 );
            ++$i;
            }
        }
        
        if(!$q3) {
            redirect( BASE_URL . 'error/save_data/' );
        } else {
            redirect( BASE_URL . 'financial/view_invoice/' . $data['stuID'] . '&termID=' . $data['termID'] );
        }
    }
    
    public function deleteFee($id) {
        $bind = [ ":id" => $id ];
        DB::inst()->delete( "student_fee", "ID = :id", $bind );
        redirect( $_SERVER['HTTP_REFERER'] );
    }
    
    public function __destruct() {
        DB::inst()->close();
    }

}