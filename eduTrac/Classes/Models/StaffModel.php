<?php namespace eduTrac\Classes\Models;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Staff Model
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
class StaffModel {
    
    private $_log;
    private $_auth;
    private $_uname;
	
	public function __construct() {
	    $this->_log = new \eduTrac\Classes\Libraries\Log;
        $this->_auth = new \eduTrac\Classes\Libraries\Cookies;
        $this->_uname = $this->_auth->getPersonField('uname');
	}
	
	public function search() {
        $array = [];
		$staff = isPostSet('staff');
        $bind = [ ":staff" => "%$staff%" ];
        $q = DB::inst()->query( "SELECT 
                        a.staffID,
                        b.lname,
                        b.fname 
                    FROM 
                        staff a 
                    LEFT JOIN 
                        person b 
                    ON 
                        a.staffID = b.personID 
                    WHERE 
                        (CONCAT(fname,' ',lname) LIKE :staff 
                    OR 
                        CONCAT(lname,' ',fname) LIKE :staff 
                    OR 
                        CONCAT(lname,', ',fname) LIKE :staff) 
                    OR 
                        a.staffID LIKE :staff",
                    $bind
        );
        
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
	}
    
    public function person($id) {
        $array = [];
        $bind = array( ":id" => $id );
        $q = DB::inst()->select( "person","personID = :id","","personID",$bind );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function runStaff($data) {        
        $bind = array( 
            "staffID" => $data['staffID'],"buildingID" => $data['buildingID'],
            "officeID" => $data['officeID'],"office_phone" => $data['office_phone'],
            "deptID" => $data['deptID'],"addDate" => $data['addDate'],
            "approvedBy" => $data['approvedBy'],"status" => $data['status'],
            "schoolID" => $data['schoolID']
        );
        
        $q = DB::inst()->insert( "staff", $bind );
        
        if(!$q) {
            redirect( BASE_URL . 'error/save_data/' );
        } else {
            $this->_log->setLog('New Record','Staff',get_name($data['staffID']),$this->_uname);
            redirect( BASE_URL . 'staff/view/' . $data['staffID'] . '/' . bm() );
        }
    
    }
    
    public function runEditStaff($data) {
        $update = array( 
            "buildingID" => $data['buildingID'],
            "officeID" => $data['officeID'],"office_phone" => $data['office_phone'],
            "deptID" => $data['deptID'],"status" => $data['status'],
            "schoolID" => $data['schoolID']
        );
        
        $bind = array( ":staffID" => $data['staffID'] );
        
        $q = DB::inst()->update( "staff", $update, "staffID = :staffID", $bind );
        $this->_log->setLog('Update Record','Staff',get_name($data['staffID']),$this->_uname);
        redirect( BASE_URL . 'staff/view/' . $data['staffID'] . '/' . bm() );
    }
    
    public function staff($id) {
        $array = [];
        $bind = array( ":id" => $id );
        $q = DB::inst()->select( "staff","staffID = :id","","*",$bind );
        
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function staffAddr($id) {
        $array = [];
        $bind = array( ":id" => $id );
        $q = DB::inst()->query( "SELECT 
                        * 
                    FROM 
                        address a 
                    LEFT JOIN 
                        staff b 
                    ON 
                        a.personID = b.staffID 
                    WHERE 
                        a.addressType = 'P' 
                    AND 
                        a.addressStatus = 'C' 
                    AND 
                        a.personID = :id",
                    $bind 
        );
        
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
	public function __destruct() {
		DB::inst()->close();
	}
	
}