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
 * @since       3.0.0
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */

use \eduTrac\Classes\Core\DB;
use \eduTrac\Classes\Libraries\Util;
class ApplicationModel {
    
    private $_auth;
    private $_log;
    private $_uname;
	private $_message;
	
	public function __construct() {
        $this->_auth = new \eduTrac\Classes\Libraries\Cookies; 
        $this->_log = new \eduTrac\Classes\Libraries\Log;
		$this->_message = new \eduTrac\Classes\Libraries\Messages;
        $this->_uname = $this->_auth->getPersonField('uname');
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
                    a.startTerm = b.termCode 
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
        $q = DB::inst()->select( "person","personID = :id","","*",$bind );
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
        $q = DB::inst()->query( "SELECT 
        				a.*,
        				b.fname,
        				b.mname,
        				b.lname,
        				b.dob,
        				b.email,
        				b.gender 
    				FROM 
    					application a 
					LEFT JOIN 
						person b 
					ON 
						a.personID = b.personID 
					WHERE 
						a.applID = :id",
					$bind 
		);
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
        $bind = [ 
                "acadProgCode" => Util::_trim($data['acadProgCode']),"startTerm" => $data['startTerm'],
                "PSAT_Verbal" => $data['PSAT_Verbal'],"PSAT_Math" => $data['PSAT_Math'],
                "SAT_Verbal" => $data['SAT_Verbal'],"SAT_Math" => $data['SAT_Math'],
                "ACT_English" => $data['ACT_English'],"ACT_Math" => $data['ACT_Math'],
                "personID" => $data['personID'],"addDate" => $date,"applDate" => $data['applDate'],
                "addedBy" => $data['addedBy'],"admitStatus" => $data['admitStatus']
                ];
                
        $q = DB::inst()->insert( "application", $bind );
        $ID = DB::inst()->lastInsertId('applID');
        
        if(!$q) {
            redirect( BASE_URL . 'error/save_data/' );
        } else {
            $this->_log->setLog('New Record','Application',get_name($data['personID']),$this->_uname);
            redirect( BASE_URL . 'application/view/' . $ID . '/' . bm() );
        }
    }
    
    public function runEditApplication($data) {
        $bind1 = [ ":applID" => $data['applID'],":personID" => $data['personID'] ];
        $update1 = [ 
                "acadProgCode" => Util::_trim($data['acadProgCode']),"startTerm" => $data['startTerm'],
                "PSAT_Verbal" => $data['PSAT_Verbal'],"PSAT_Math" => $data['PSAT_Math'],
                "SAT_Verbal" => $data['SAT_Verbal'],"SAT_Math" => $data['SAT_Math'],
                "ACT_English" => $data['ACT_English'],"ACT_Math" => $data['ACT_Math'],
                "admitStatus" => $data['admitStatus'],"applDate" => $data['applDate']
                ];
                
        $q1 = DB::inst()->update("application",$update1,"applID = :applID AND personID = :personID",$bind1);
        
        $size = count($data['fice_ceeb']);
        $i = 0;
        while($i < $size) {
            $bind2 = [ ":id" => $data['instAttID'][$i],":personID" => $data['personID'] ];
            $update2 = [ 
                    "fice_ceeb" => Util::_trim($data['fice_ceeb'][$i]),"fromDate" => $data['fromDate'][$i],
	                "toDate" => $data['toDate'][$i],"GPA" => $data['GPA'][$i],
	                "major" => $data['major'][$i],"degree_awarded" => $data['degree_awarded'][$i],
	                "degree_conferred_date" => $data['degree_conferred_date'][$i]
                    ];
            $q2 = DB::inst()->update("institution_attended",$update2,"instAttID = :id AND personID = :personID",$bind2);
            ++$i;
        }
        
		// Flash messages for success or error
		if($q1) {
			$this->_message->init('success_message', $this->_message->notice(3));
		} else {
			$this->_message->init('error_message', $this->_message->notice(4));
		}
		// Sets audit trail logs
        $this->_log->setLog('Update Record','Application',get_name($data['personID']),$this->_uname);
        redirect( BASE_URL . 'application/view/' . $data['applID'] . '/' . bm() );
    }
	
	public function runInstAttended($data) {        
        $bind = [ 
                "fice_ceeb" => Util::_trim($data['fice_ceeb']),"fromDate" => $data['fromDate'],
                "toDate" => $data['toDate'],"GPA" => $data['GPA'],
                "personID" => $data['personID'],
                "major" => $data['major'],"degree_awarded" => $data['degree_awarded'],
                "degree_conferred_date" => $data['degree_conferred_date'],
                "addDate" => $data['addDate'],"addedBy" => $data['addedBy']
                ];
        $q = DB::inst()->insert("institution_attended",$bind);
		if(!$q) {
			redirect( BASE_URL . 'error/save_data/' );
		} else {
        	$this->_log->setLog('New Record','Institution Attended',get_name($data['personID']),$this->_uname);
        	redirect( BASE_URL . 'success/save_data/' );
		}
    }
	
	public function runApplicantLookup($data) {
        $bind = [ ":id" => $data['personID'] ];
		$q = DB::inst()->query( "SELECT 
						b.personID,
						b.fname,
						b.lname 
					FROM 
						application a 
					LEFT JOIN 
						person b 
					ON 
						a.personID = b.personID 
					WHERE 
						a.personID = :id",
					$bind
		);
        foreach($q as $k => $v) {
            $json = [ 'input#person' => $v['lname'].', '.$v['fname'] ];
        }
        echo json_encode($json);
    }
    
    public function deleteInstAttend($id) {
    	$bind = [ ":id" => $id ];
        $q = DB::inst()->query( "DELETE FROM institution_attended WHERE instAttID = :id", $bind );
        
        if($q) {
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            redirect( BASE_URL . 'error/delete_record/');
        }
    }
    
    public function __destruct() {
        DB::inst()->close();
    }

}