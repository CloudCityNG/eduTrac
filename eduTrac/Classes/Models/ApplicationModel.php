<?php namespace eduTrac\Classes\Models;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Application Model
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
 * @since       1.0.0
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */

use \eduTrac\Classes\Core\DB;
class ApplicationModel {
    
    private $_auth;
    private $_log;
	
	public function __construct() {
        $this->_auth = new \eduTrac\Classes\Libraries\Cookies; 
        $this->_log = new \eduTrac\Classes\Libraries\Log;  
	}
    
    public function search() {
        $array = [];
        $post = isPostSet('appl');
        $bind = [ ":appl" => "%$post%" ];
        
        $q = DB::inst()->query( "SELECT a.applID,a.personID,b.termName,c.fname,c.lname,c.uname 
                FROM 
                    application a 
                LEFT JOIN 
                    term b 
                ON 
                    a.startTerm = b.termID 
                LEFT JOIN 
                    person c
                ON 
                    a.personID = c.personID 
                WHERE 
                    (CONCAT(c.fname,' ',c.lname) LIKE :appl
                OR 
                    CONCAT(c.lname,' ',c.fname) LIKE :appl 
                OR 
                    CONCAT(c.lname,', ',c.fname) LIKE :appl) 
                OR 
                    c.fname LIKE :appl 
                OR 
                    c.lname LIKE :appl 
                OR 
                    c.uname LIKE :appl 
                OR 
                    a.personID LIKE :appl",
                $bind
        );
        
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
        
        redirect( BASE_URL . 'application/' );
    }
    
    public function person($id) {
        $array = [];
        $bind = [ ":id" => $id ];
        $q = DB::inst()->select( "person","personID = :id","","personID",$bind );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function address($id) {
        $array = [];
        $bind = [ ":id" => $id ];
        $q = DB::inst()->select( "address","personID = :id AND addressType = 'P'","","*",$bind );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function appl($id) {
        $array = [];
        $bind = [ ":id" => $id ];
        $q = DB::inst()->select( "application","applID = :id","expires_at","*",$bind );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function applAddr($id) {
        $array = [];
        $bind = [ ":id" => $id ];
        $q = DB::inst()->query( "SELECT * 
                FROM 
                    address a 
                LEFT JOIN 
                    application b 
                ON 
                    a.personID = b.personID 
                WHERE 
                    b.applID = :id 
                AND 
                    a.addressType = 'P'",
                $bind 
        );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function inst($id) {
        $array = [];
        $bind = [ ":id" => $id ];
        $q = DB::inst()->query( "SELECT * 
                FROM 
                    institution_attended a 
                LEFT JOIN 
                    application b 
                ON 
                    a.personID = b.personID 
                WHERE 
                    b.applID = :id",
                $bind 
        );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function runApplication($data) {
        $date = date("Y-m-d");
        $addedBy = $this->_auth->getPersonField('personID');
        $bind1 = [ 
                "acadProgID" => $data['acadProgID'],"startTerm" => $data['startTerm'],
                "PSAT_Verbal" => $data['PSAT_Verbal'],"PSAT_Math" => $data['PSAT_Math'],
                "SAT_Verbal" => $data['SAT_Verbal'],"SAT_Math" => $data['SAT_Math'],
                "ACT_English" => $data['ACT_English'],"ACT_Math" => $data['ACT_Math'],
                "personID" => $data['personID'],"addDate" => $date,
                "addedBy" => $addedBy,"admitStatus" => $data['admitStatus']
                ];
                
        $q1 = DB::inst()->insert( "application", $bind1 );
        $ID = DB::inst()->lastInsertId('applID');
        
        if($q1) {
            $bind2 = [ 
                    "instID" => $data['instID'],"fromDate" => $data['fromDate'],
                    "toDate" => $data['toDate'],"GPA" => $data['GPA'],
                    "personID" => $data['personID'],"addDate" => $date,
                    "addedBy" => $addedBy
                    ];
            $q2 = DB::inst()->insert( "institution_attended", $bind2 );
        }
        
        if(!$q2) {
            redirect( BASE_URL . 'error/save_data/' );
        } else {
            $this->_log->setLog('New Record','Application',get_name($data['personID']));
            redirect( BASE_URL . 'application/view/' . $ID . '/' . bm() );
        }
    }
    
    public function runEditApplication($data) {
        $bind1 = [ ":applID" => $data['applID'],":personID" => $data['personID'] ];
        $update1 = [ 
                "acadProgID" => $data['acadProgID'],"startTerm" => $data['startTerm'],
                "PSAT_Verbal" => $data['PSAT_Verbal'],"PSAT_Math" => $data['PSAT_Math'],
                "SAT_Verbal" => $data['SAT_Verbal'],"SAT_Math" => $data['SAT_Math'],
                "ACT_English" => $data['ACT_English'],"ACT_Math" => $data['ACT_Math'],
                "admitStatus" => $data['admitStatus']
                ];
                
        $q1 = DB::inst()->update("application",$update1,"applID = :applID AND personID = :personID",$bind1);
        
        $size = count($data['instID']);
        $i = 0;
        while($i < $size) {
            $bind2 = [ ":instAttID" => $data['instAttID'][$i],":personID" => $data['personID'] ];
            $update2 = [ 
                    "instID" => $data['instID'][$i],"fromDate" => $data['fromDate'][$i],
                    "toDate" => $data['toDate'][$i],"GPA" => $data['GPA'][$i]
                    ];
            $q2 = DB::inst()->update("institution_attended",$update2,"instAttID = :instAttID AND personID = :personID",$bind2);
            ++$i;
        }
        $this->_log->setLog('Update Record','Application',get_name($data['personID']));
        redirect( BASE_URL . 'application/view/' . $data['applID'] . '/' . bm() );
    }
    
    public function __destruct() {
        DB::inst()->close();
    }

}