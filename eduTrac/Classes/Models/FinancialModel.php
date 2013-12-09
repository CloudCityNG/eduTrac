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
 * @since       1.0.4
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */

use \eduTrac\Classes\Core\DB;
class FinancialModel {
    
    private $_auth;
    private $_log;
    private $_uname;
	
	public function __construct() {
        $this->_auth = new \eduTrac\Classes\Libraries\Cookies; 
        $this->_log = new \eduTrac\Classes\Libraries\Log;
        $this->_uname = $this->_auth->getPersonField('uname'); 
	}
    
    public function search() {
        $array = [];
        $post = isPostSet('bill');
        $bind = [ ":bill" => "%$post%" ];
        
        $q = DB::inst()->query( "SELECT a.ID,a.stuID,a.termID,b.termCode,c.fname,c.lname,c.uname 
                FROM 
                    bill a 
                LEFT JOIN 
                    term b 
                ON 
                    a.termID = b.termID 
                LEFT JOIN 
                    person c
                ON 
                    a.stuID = c.personID 
                WHERE 
                    (CONCAT(c.fname,' ',c.lname) LIKE :bill
                OR 
                    CONCAT(c.lname,' ',c.fname) LIKE :bill 
                OR 
                    CONCAT(c.lname,', ',c.fname) LIKE :bill) 
                OR 
                    c.fname LIKE :bill 
                OR 
                    c.lname LIKE :bill 
                OR 
                    c.uname LIKE :bill 
                OR 
                    a.stuID LIKE :bill 
                GROUP BY 
                    a.stuID,a.termID",
                $bind
        );
        
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
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
    
    public function bill($id) {
        $array = [];
        $bind = [ ":id" => $id,":termID" => isGetSet('termID') ];
        $q = DB::inst()->query( "SELECT 
                        a.ID AS 'FeeID',
                        a.stuID,
                        b.name,
                        b.amount,
                        c.dateTime,
                        d.termName 
                    FROM 
                        student_fee a 
                    LEFT JOIN 
                        billing_table b 
                    ON 
                        a.feeID = b.ID 
                    LEFT JOIN 
                        bill c 
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
                        a.billID = c.ID",
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
                        bill c 
                    ON 
                        a.billID = c.ID 
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
    
    public function courseFees($id) {
        $array = [];
        $bind = [ ":stuID" => $id, ":termID" => isGetSet('termID') ];
        
        $q = DB::inst()->query( "SELECT 
                        SUM(a.courseFee) AS 'CourseFee',
                        SUM(a.labFee) AS 'LabFee',
                        SUM(a.materialFee) AS 'MaterialFee' 
                    FROM 
                        course_sec a 
                    LEFT JOIN 
                        stu_acad_cred b 
                    ON 
                        a.termID = b.termID 
                    WHERE 
                        b.stuID = :stuID 
                    AND 
                        b.termID = :termID 
                    GROUP BY 
                        b.stuID,b.termID,b.courseSecID",
                    $bind 
        );
        
        foreach($q as $r) {
            $array[] = $r;
        }
        
        return $array;
    }
    
    public function sumPayments($id) {
        $array = [];
        $bind = [ ":stuID" => $id, ":termID" => isGetSet('termID') ];
        
        $q = DB::inst()->query( "SELECT 
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
        
        foreach($q as $r) {
            $array[] = $r['SUM(amount)'];
        }
        
        return $array;
    }
    
    public function sumRefund($id) {
        $array = [];
        $bind = [ ":stuID" => $id, ":termID" => isGetSet('termID') ];
        
        $q = DB::inst()->query( "SELECT 
                        SUM(amount) 
                    FROM 
                        refund 
                    WHERE 
                        stuID = :stuID 
                    AND 
                        termID = :termID 
                    GROUP BY 
                        stuID,termID",
                    $bind 
        );
        
        foreach($q as $r) {
            $array[] = $r['SUM(amount)'];
        }
        
        return $array;
    }
    
    public function payment($id) {
        $array = [];
        $bind = [ ":id" => $id,":termID" => isGetSet('termID') ];
        $q = DB::inst()->query( "SELECT 
                        a.ID AS 'paymentID',
                        a.amount,
                        a.comment,
                        a.dateTime,
                        c.type 
                    FROM 
                        payment a 
                    LEFT JOIN 
                        bill b 
                    ON 
                        a.stuID = b.stuID 
                    LEFT JOIN 
                        payment_type c 
                    ON 
                        a.paymentTypeID = c.ptID 
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
    
    public function refund($id) {
        $array = [];
        $bind = [ ":id" => $id,":termID" => isGetSet('termID') ];
        $q = DB::inst()->query( "SELECT 
                        a.ID AS 'refundID',
                        a.amount,
                        a.comment,
                        a.dateTime 
                    FROM 
                        refund a 
                    LEFT JOIN 
                        bill b 
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
            
            $this->_log->setLog('Update Record','Billing Table',$data['name'],$this->_uname);
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
                $this->_log->setLog('New Record','Billing Table',$data['name'],$this->_uname);
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
    
    public function runBill($data) {
        $array = [];
        /**
         * Check to see if a bill was already created for the particular student 
         * for the requested term.
         */
        $bind1 = [ ":stuID" => $data['stuID'],":termID" => $data['termID'] ];
        $q1 = DB::inst()->select( "bill","stuID = :stuID AND termID = :termID","","*",$bind1 );
        foreach($q1 as $r) {
            $array[] = $r;
        }
        
        /**
         * If the above records return 0, then create a new bill and enter an array 
         * of fees for the student into the student_fee table.
         */
        if(count($q1) <= 0) {
            $bind2 = [ "stuID" => $data['stuID'],"termID" => $data['termID'],
                       "dateTime" => date('Y-m-d H:i:s') 
                     ];
            $q2 = DB::inst()->insert( "bill", $bind2 );
            $ID = DB::inst()->lastInsertId('ID');
            
            $size = count($data['feeID']);
            $i = 0;
            while($i < $size) {
                $bind3 = [ "stuID" => $data['stuID'],"billID" => $ID,
                           "feeID" => $data['feeID'][$i] 
                         ];
                $q3 = DB::inst()->insert( "student_fee", $bind3 );
            ++$i;
            }
        }
        
        /**
         * If a bill already exists for a student for the requested term, 
         * then new fees will be added to the bill.
         */
        else {
            $size = count($data['feeID']);
            $i = 0;
            while($i < $size) {
                $bind3 = [ "stuID" => $data['stuID'],"billID" => $r['ID'],
                           "feeID" => $data['feeID'][$i] 
                         ];
                $q3 = DB::inst()->insert( "student_fee", $bind3 );
            ++$i;
            }
        }
        
        if(!$q3) {
            redirect( BASE_URL . 'error/save_data/' );
        } else {
            redirect( BASE_URL . 'financial/view_bill/' . $data['stuID'] . '&termID=' . $data['termID'] );
        }
    }
    
    public function runBatch($data) {
        if(empty($data['population'])) {
            redirect( BASE_URL . 'error/population/' );
            exit();
        }
        
        if($data['stu_program'] && $data['major'] || $data['stu_program'] && $data['acadLevelCode'] || $data['major'] && $data['acadLevelCode']) {
            redirect( BASE_URL . 'error/population/' );
            exit();
        }
        
        $array = [];
        
        if($data['stu_program']) {
            $bind1 = [ ":prog" => $data['stu_program'],":termID" => $data['termID'] ];
            /**
             * Check to see if a bill was already created for the particular student 
             * population for the requested term.
             */
            $q1 = DB::inst()->query( "SELECT 
                            a.stuID 
                        FROM 
                            stu_program a 
                        INNER JOIN 
                            bill b 
                        ON 
                            (a.stuID = b.stuID) 
                        WHERE 
                            a.progID = :prog 
                        AND 
                            a.currStatus = 'A' 
                        AND 
                            a.endDate = '0000-00-00' 
                        AND 
                            b.termID <> :termID 
                        GROUP BY 
                            b.stuID,b.termID",
                        $bind1
            );
            foreach($q1 as $r1) {
                $array[] = $r1;
            }
            
            /**
             * Retrieve a list of students based on particular population 
             * who already have a bill for the term in question.
             */
            $q2 = DB::inst()->query( "SELECT 
                            a.stuID, b.ID 
                        FROM 
                            stu_program AS a, bill AS b 
                        WHERE 
                            a.progID = :prog 
                        AND 
                            a.currStatus = 'A' 
                        AND 
                            a.endDate = '0000-00-00' 
                        AND 
                            a.stuID = b.stuID 
                        AND 
                            b.termID = :termID",
                        $bind1
            );
            foreach($q2 as $r2) {
                $array[] = $r2;
            }
        }
        
        if($data['major']) {
            $bind1 = [ ":major" => $data['major'],":termID" => $data['termID'] ];
            /**
             * Check to see if a bill was already created for the particular student 
             * population for the requested term.
             */
            $q1 = DB::inst()->query( "SELECT 
                            a.stuID 
                        FROM 
                            stu_program a 
                        INNER JOIN 
                            bill b 
                        ON 
                            (a.stuID = b.stuID) 
                        LEFT JOIN 
                            acad_program c
                        ON 
                            a.progID = c.acadProgID  
                        WHERE 
                            c.majorID = :major 
                        AND 
                            a.currStatus = 'A' 
                        AND 
                            a.endDate = '0000-00-00' 
                        AND 
                            b.termID <> :termID 
                        GROUP BY 
                            b.stuID,b.termID",
                        $bind1
            );
            foreach($q1 as $r1) {
                $array[] = $r1;
            }
            
            /**
             * Retrieve a list of students based on particular population 
             * who already have a bill for the term in question.
             */
            $q2 = DB::inst()->query( "SELECT 
                            a.stuID,
                            b.ID 
                        FROM 
                            stu_program a 
                        LEFT JOIN 
                            bill b 
                        ON 
                            a.stuID = b.stuID 
                        LEFT JOIN 
                            acad_program c
                        ON 
                            a.progID = c.acadProgID  
                        WHERE 
                            c.majorID = :major 
                        AND 
                            a.currStatus = 'A' 
                        AND 
                            a.endDate = '0000-00-00' 
                        AND 
                            b.termID = :termID",
                        $bind1
            );
            foreach($q2 as $r2) {
                $array[] = $r2;
            }
        }
        
        if($data['acadLevelCode']) {
            $bind1 = [ ":level" => $data['acadLevelCode'],":termID" => $data['termID'] ];
            /**
             * Check to see if a bill was already created for the particular student 
             * population for the requested term.
             */
            $q1 = DB::inst()->query( "SELECT 
                            a.stuID 
                        FROM 
                            stu_program a 
                        INNER JOIN 
                            bill b 
                        ON 
                            (a.stuID = b.stuID) 
                        LEFT JOIN 
                            stu_acad_level c 
                        ON 
                            a.progID = c.acadProgID 
                        WHERE 
                            c.acadLevelCode = :level 
                        AND 
                            a.currStatus = 'A' 
                        AND 
                            a.endDate = '0000-00-00' 
                        AND 
                            b.termID <> :termID 
                        GROUP BY 
                            b.stuID,b.termID",
                        $bind1
            );
            foreach($q1 as $r1) {
                $array[] = $r1;
            }
            
            /**
             * Retrieve a list of students based on particular population 
             * who already have a bill for the term in question.
             */
            $q2 = DB::inst()->query( "SELECT 
                            a.stuID,
                            b.ID 
                        FROM 
                            stu_program a 
                        LEFT JOIN 
                            bill b 
                        ON 
                            a.stuID = b.stuID 
                        LEFT JOIN 
                            stu_acad_level c
                        ON 
                            a.progID = c.acadProgID  
                        WHERE 
                            c.acadLevelCode = :level 
                        AND 
                            a.currStatus = 'A' 
                        AND 
                            a.endDate = '0000-00-00' 
                        AND 
                            b.termID = :termID",
                        $bind1
            );
            foreach($q2 as $r2) {
                $array[] = $r2;
            }
        }
        
        /**
         * If a bill for a population of students does not exist, 
         * then create a new bill and enter an array 
         * of fees for the student into the student_fee table.
         */
        if(count($q1 > 0)) {
            $stuCount = count($q1);
            $t = 0;
            while($t < $stuCount) {
                $bind2 = [ "stuID" => $r1['stuID'],"termID" => $data['termID'],
                           "dateTime" => date('Y-m-d H:i:s') 
                         ];
                $q3 = DB::inst()->insert( "bill", $bind2 );
                $ID = DB::inst()->lastInsertId('ID');
                
                $size = count($data['feeID']);
                $i = 0;
                while($i < $size) {
                    $bind3 = [ "stuID" => $r1['stuID'],"billID" => $ID,
                               "feeID" => $data['feeID'][$i] 
                             ];
                    $q4 = DB::inst()->insert( "student_fee", $bind3 );
                ++$i;
                }
            ++$t;
            }
        }
        
        /**
         * If a bill already exists for a student population for the requested term, 
         * then new fees will be added to the bill.
         */
        if(count($q2 > 0)) {
            $stuCount = count($q2);
            $t = 0;
            while($t < $stuCount) {
                $size = count($data['feeID']);
                $i = 0;
                while($i < $size) {
                    $bind4 = [ "stuID" => $r2['stuID'],"billID" => $r2['ID'],
                               "feeID" => $data['feeID'][$i] 
                             ];
                    $q5 = DB::inst()->insert( "student_fee", $bind4 );
                ++$i;
                }
            ++$t;
            }
        }
        
        if(!$q3) {
            redirect( BASE_URL . 'error/save_data/' );
        } else {
            redirect( BASE_URL . 'success/save_data/' );
        }
    }
    
    public function runPayment($data) {
        $date = date('Y-m-d H:i:s');
        
        if(empty($data['checkNum'])) {
            $check = NULL;
        } else {
            $check = $data['checkNum'];
        }
        
        $bind = [ 
                "stuID" => $data['stuID'],"termID" => $data['termID'],
                "amount" => $data['amount'],"checkNum" => $check,
                "paymentTypeID" => $data['paymentTypeID'],"comment" => $data['comment'],
                "dateTime" => $date
                ];
        $q = DB::inst()->insert( "payment", $bind );
        if(!$q) {
            redirect( BASE_URL . 'error/save_data/' );
        } else {
            redirect( BASE_URL . 'success/save_data/' );
        }
    }
    
    public function runRefund($data) {
        $date = date('Y-m-d H:i:s');
        
        $bind = [ 
                "stuID" => $data['stuID'],"termID" => $data['termID'],
                "amount" => $data['amount'],"comment" => $data['comment'],
                "dateTime" => $date
                ];
        $q = DB::inst()->insert( "refund", $bind );
        if(!$q) {
            redirect( BASE_URL . 'error/save_data/' );
        } else {
            redirect( BASE_URL . 'success/save_data/' );
        }
    }
    
    public function deleteFee($id) {
        $bind = [ ":id" => $id ];
        DB::inst()->delete( "student_fee", "ID = :id", $bind );
        redirect( $_SERVER['HTTP_REFERER'] );
    }
    
    public function deletePayment($id) {
        $bind = [ ":id" => $id ];
        DB::inst()->delete( "payment", "ID = :id", $bind );
        redirect( $_SERVER['HTTP_REFERER'] );
    }
    
    public function deleteRefund($id) {
        $bind = [ ":id" => $id ];
        DB::inst()->delete( "refund", "ID = :id", $bind );
        redirect( $_SERVER['HTTP_REFERER'] );
    }
    
    public function __destruct() {
        DB::inst()->close();
    }

}