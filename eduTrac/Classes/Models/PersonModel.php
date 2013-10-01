<?php namespace eduTrac\Classes\Models;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Person Model
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
use \eduTrac\Classes\Libraries\Hooks;
use \eduTrac\Classes\Libraries\Cookies;
class PersonModel {
    
    private $_auth;
    private $_email;
    private $_log;
	
	public function __construct() {
		$this->_auth = new Cookies;
		$this->_email = new \eduTrac\Classes\Libraries\Email;
        $this->_log = new \eduTrac\Classes\Libraries\Log;
	}
    
    public function search() {
        $array = [];
        $person = isPostSet('person');
        $bind = [ ":person" => "%$person%" ];
            
        $q = DB::inst()->query( "SELECT personID,fname,lname,uname 
                FROM 
                    person 
                WHERE 
                    (CONCAT(fname,' ',lname) LIKE :person 
                OR 
                    CONCAT(lname,' ',fname) LIKE :person 
                OR 
                    CONCAT(lname,', ',fname) LIKE :person) 
                OR 
                    fname LIKE :person 
                OR 
                    lname LIKE :person 
                OR 
                    uname LIKE :person 
                OR 
                    personID LIKE :person",
                $bind
        );
        
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function person($id) {
        $array = [];
        $bind = array( ":personID" => $id );
        $q = DB::inst()->select( "person", "personID = :personID", "", "*", $bind );
        
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function addAddr($id) {
        $array = [];
        $bind = array( ":id" => $id );
        $q = DB::inst()->query( "SELECT * 
                FROM 
                    person a 
                LEFT JOIN 
                    address b 
                ON 
                    a.personID = b.personID 
                WHERE 
                    a.personID = :id",
                $bind
        );
        
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function addr($id) {
        $array = [];
        $bind = array( ":id" => $id );
        $q = DB::inst()->query( "SELECT * 
                FROM 
                    person a 
                LEFT JOIN 
                    address b 
                ON 
                    a.personID = b.personID 
                WHERE 
                    a.personID = :id 
                AND 
                    b.addressType = 'P' 
                AND 
                    b.endDate = '0000-00-00' 
                AND 
                    b.addressStatus = 'C'",
                $bind
        );
        
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function addrSum($id) {
        $array = [];
        $bind = array( ":personID" => $id );        
        $q = DB::inst()->query( "SELECT * 
                FROM 
                    person a 
                LEFT JOIN 
                    address b 
                ON 
                    a.personID = b.personID 
                WHERE 
                    a.personID = :personID", 
                    
                    $bind 
        );
        
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function editAddr($id) {
        $array = [];
        $bind = array( ":addressID" => $id );
        $q = DB::inst()->query( "SELECT * 
                FROM 
                    address a 
                LEFT JOIN 
                    person b 
                ON 
                    a.personID = b.personID 
                WHERE 
                    a.addressID = :addressID 
                LIMIT 1", 
                    
                    $bind 
        );
        
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function rolePerm($id) {
        $array = [];
        $bind = array( ":id" => $id );
        $q = DB::inst()->select( "person","personID = :id","","personID",$bind );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function runRolePerm($data) {
        $personID = $data['personID'];      
        
        if (isset($_POST['action'])) {
            switch($_POST['action']) {
                case 'saveRoles':
                    foreach ($_POST as $k => $v) {
                        if (substr($k,0,5) == "role_") {
                            $roleID = str_replace("role_","",$k);
                            if ($v == '0' || $v == 'x') {
                                $strSQL = sprintf("DELETE FROM `person_roles` WHERE `personID` = %u AND `roleID` = %u",$personID,$roleID);
                            } else {
                                $strSQL = sprintf("REPLACE INTO `person_roles` SET `personID` = %u, `roleID` = %u, `addDate` = '%s'",$personID,$roleID,date ("Y-m-d H:i:s"));
                            }
                            DB::inst()->query($strSQL);
                        }
                    }
                    
                break;
                case 'savePerms':
                    foreach ($_POST as $k => $v) {
                        if (substr($k,0,5) == "perm_") {
                            $permID = str_replace("perm_","",$k);
                            if ($v == 'x') {
                                $strSQL = sprintf("DELETE FROM `person_perms` WHERE `personID` = %u AND `permID` = %u",$personID,$permID);
                            } else {
                                $strSQL = sprintf("REPLACE INTO `person_perms` SET `personID` = %u, `permID` = %u, `value` = %u, `addDate` = '%s'",$personID,$permID,$v,date ("Y-m-d H:i:s"));
                            }
                            DB::inst()->query($strSQL);
                        }
                    }
                break;
            }
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    public function resetPassword($id) {
        $array = [];
        $bind = [ ":id" => $id ];
        $q1 = DB::inst()->select( "person","personID = :id","","uname,email,fname,lname,dob,ssn",$bind );
        foreach($q1 as $r1) {
            $array[] = $r1;
        }
        
        $dob = str_replace('-','',$r1['dob']);
        
        if($r1['ssn'] > 0) {
            $pass = $r1['ssn'];
        } elseif($data['dob'] != '0000-00-00') {
            $pass = $dob;
        } else {
            $pass = 'myaccount';
        }
        
        $from = Hooks::get_option('site_title');
        $fromEmail = Hooks::get_option('system_email');
        $url = BASE_URL;
        $helpDesk = Hooks::get_option('help_desk');
        $body = Hooks::get_option('reset_password_text');
        $body = str_replace('#url#',$url,$body);
        $body = str_replace('#helpdesk#',$helpDesk,$body);
        $body = str_replace('#adminemail#',$fromEmail,$body);
        $body = str_replace('#uname#',_h($r1['uname']),$body);
        $body = str_replace('#email#',_h($r1['email']),$body);
        $body = str_replace('#fname#',_h($r1['fname']),$body);
        $body = str_replace('#lname#',_h($r1['lname']),$body);
        $body = str_replace('#password#',$pass,$body);
        
        $headers  = "From: $from <auto-reply@$host>\r\n";
		$headers .= "X-Mailer: PHP/" . phpversion();
		$headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        
        $password = et_hash_password($pass);
        $update = [ "password" => $password ];
        $q2 = DB::inst()->update( "person",$update,"personID = :id",$bind );
        
        if(!$q2) {
            redirect( BASE_URL . 'error/reset_password/' );
        } else {
            $this->_email->et_mail($r1['email'],"Reset Password",$body,$headers);
            $this->_log->setLog('Update Record','Reset Password',get_name($id));
            redirect( BASE_URL . 'success/reset_password/' );
        }
    }
    
    public function runPerson($data) {
        $dob = str_replace('-','',$data['dob']);
        
        if($data['ssn'] > 0 ) {
            $password = et_hash_password((int)$data['ssn']);
        } elseif(!empty($data['dob'])) {
            $password = et_hash_password((int)$dob);
        } else {
            $password = et_hash_password('myaccount');
        }
        
        $date = date("Y-m-d");
        $bind1 = array( 
                    "uname" => $data['uname'],"personType" => $data['personType'],
                    "prefix" => $data['prefix'],"fname" => $data['fname'],"lname" => $data['lname'],
                    "mname" => $data['mname'],"email" => $data['email'],"ssn" => (int)$data['ssn'],
                    "dob" => $data['dob'],"veteran" => $data['veteran'],"ethnicity" => $data['ethnicity'],
                    "gender" => $data['gender'],"emergency_contact" => $data['emergency_contact'],
                    "emergency_contact_phone" => $data['emergency_contact_phone'],"email" => $data['email'],
                    "password" => $password,"approvedDate" => $date,"approvedBy" => $this->_auth->getPersonField('personID')
                    );
                    
        $q1 = DB::inst()->insert( "person", $bind1 );
        $ID = DB::inst()->lastInsertId('personID');
                    
        $bind2 = array( 
                    "personID" => $ID, "address1" => $data['address1'],"address2" => $data['address2'],
                    "city" => $data['city'],"state" => $data['state'],"addressType" => "P",
                    "zip" => $data['zip'],"country" => $data['country'],
                    "startDate" => $date,"addressStatus" => "C",
                    "addDate" => $date,"addedBy" => $this->_auth->getPersonField('personID'),"phone1" => $data['phone'],
                    "email1" => $data['email'] 
                    );
                    
        $q2 = DB::inst()->insert( "address", $bind2 );
        
        if(!$q1) {
            redirect( BASE_URL . 'error/save_data/' );
        } else {
            $this->_log->setLog('New Record','Person',get_name($ID));
            redirect( BASE_URL . 'person/view/' . $ID . '/' . bm() );
        }
    }
    
    public function runAddAddress($data) {
        $bind = array( 
                    "address1" => $data['address1'],"address2" => $data['address2'],
                    "city" => $data['city'],"state" => $data['state'],
                    "zip" => $data['zip'],"country" => $data['country'],
                    "addressType" => $data['addressType'],"startDate" => $data['startDate'],
                    "endDate" => $data['endDate'],"addressStatus" => $data['addressStatus'],
                    "addDate" => $data['addDate'],"addedBy" => $data['addedBy'],"phone1" => $data['phone1'],
                    "phone2" => $data['phone2'],"ext1" => $data['ext1'],"ext2" => $data['ext2'],
                    "phoneType1" => $data['phoneType1'],"phoneType2" => $data['phoneType2'],
                    "email2" => $data['email2'],"personID" => $data['personID'] 
                    );
                    
        $q = DB::inst()->insert( "address", $bind );
        
        if(!$q) {
            redirect( BASE_URL . 'error/save_data/' );
        } else {
            $this->_log->setLog('New Record','Address',get_name($data['personID']));
            redirect( BASE_URL . 'person/addr_sum/' . $data['personID'] . bm() );
        }
    }
    
    public function runEditAddress($data) {
        $update = array( 
                    "address1" => $data['address1'],"address2" => $data['address2'],
                    "city" => $data['city'],"state" => $data['state'],
                    "zip" => $data['zip'],"country" => $data['country'],
                    "addressType" => $data['addressType'],"startDate" => $data['startDate'],"endDate" => $data['endDate'],
                    "addressStatus" => $data['addressStatus'],"phone1" => $data['phone1'],
                    "phone2" => $data['phone2'],"ext1" => $data['ext1'],"ext2" => $data['ext2'],
                    "phoneType1" => $data['phoneType1'],"phoneType2" => $data['phoneType2'],
                    "email2" => $data['email2'] 
                    );
                    
        $bind = array( ":addressID" => $data['addressID'] );
        $q = DB::inst()->update( "address", $update, "addressID = :addressID", $bind );
        $this->_log->setLog('Update Record','Address',$data['addressID']);
        redirect( BASE_URL . 'person/edit_addr/' . $data['addressID'] . bm() );
    }
    
    public function runEditPerson($data) {
        $update1 = array( 
                    "prefix" => $data['prefix'],"fname" => $data['fname'],"lname" => $data['lname'],
                    "mname" => $data['mname'],"email" => $data['email'],"ssn" => (int)$data['ssn'],
                    "dob" => $data['dob'],"veteran" => $data['veteran'],"ethnicity" => $data['ethnicity'],
                    "gender" => $data['gender'],"emergency_contact" => $data['emergency_contact'],
                    "emergency_contact_phone" => $data['emergency_contact_phone'],"email" => $data['email'] 
                    );
                    
        $update2 = array( "email1" => $data['email'] );
        
        $bind = array( ":personID" => $data['personID'] );
        $q = DB::inst()->update( "person", $update1, "personID = :personID", $bind );
        
        if($q) {
            DB::inst()->update( "address", $update2, "personID = :personID", $bind );
        }
        $this->_log->setLog('Update Record','Person',get_name($data['personID']));
        redirect( BASE_URL . 'person/view/' . $data['personID'] . bm() );
    }
	
	public function runUsernameCheck($data) {
	    $uname = $data['uname'];
        $bind = array( ":uname" => $uname );
	    $q = DB::inst()->select( "person", "uname = :uname", "", "uname", $bind );
	    foreach($q as $k => $v) :
	       if($v['uname'] == $uname) :
                echo '1';
            endif;
        endforeach;
	}
	
	public function __destruct() {
		DB::inst()->close();
	}
	
}