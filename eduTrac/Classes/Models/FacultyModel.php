<?php namespace eduTrac\Classes\Models;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Faculty Model
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
class FacultyModel {
    
    private $_log;
	
	public function __construct() {
	    $this->_log = new \eduTrac\Classes\Libraries\Log;
	}
	
	public function search() {
        $array = [];
		$fac = isPostSet('faculty');
        $bind = [ ":fac" => "%$fac%" ];
        $q = DB::inst()->query( "SELECT 
                        a.facID,
                        b.lname,
                        b.fname 
                    FROM 
                        faculty a 
                    LEFT JOIN 
                        person b 
                    ON 
                        a.facID = b.personID 
                    WHERE 
                        (CONCAT(fname,' ',lname) LIKE :fac 
                    OR 
                        CONCAT(lname,' ',fname) LIKE :fac 
                    OR 
                        CONCAT(lname,', ',fname) LIKE :fac) 
                    OR 
                        a.facID LIKE :fac",
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
    
    public function runFaculty($data) {        
        $bind = array( 
            "facID" => $data['facID'],"buildingID" => $data['buildingID'],
            "officeID" => $data['officeID'],"office_phone" => $data['office_phone'],
            "deptID" => $data['deptID'],"addDate" => $data['addDate'],
            "approvedBy" => $data['approvedBy'],"status" => $data['status'],
            "schoolID" => $data['schoolID']
        );
        
        $q = DB::inst()->insert( "faculty", $bind );
        
        if(!$q) {
            redirect( BASE_URL . 'error/save_data/' );
        } else {
            $this->_log->setLog('New Record','Faculty',get_name($data['facID']));
            redirect( BASE_URL . 'faculty/view/' . $data['facID'] . '/' . bm() );
        }
    
    }
    
    public function runEditFaculty($data) {
        $update = array( 
            "buildingID" => $data['buildingID'],
            "officeID" => $data['officeID'],"office_phone" => $data['office_phone'],
            "deptID" => $data['deptID'],"status" => $data['status'],
            "schoolID" => $data['schoolID']
        );
        
        $bind = array( ":facID" => $data['facID'] );
        
        $q = DB::inst()->update( "faculty", $update, "facID = :facID", $bind );
        $this->_log->setLog('Update Record','Faculty',get_name($data['facID']));
        redirect( BASE_URL . 'faculty/view/' . $data['facID'] . '/' . bm() );
    }
    
    public function faculty($id) {
        $array = [];
        $bind = array( ":id" => $id );
        $q = DB::inst()->select( "faculty","facID = :id","","*",$bind );
        
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function facAddr($id) {
        $array = [];
        $bind = array( ":id" => $id );
        $q = DB::inst()->query( "SELECT 
                        * 
                    FROM 
                        address a 
                    LEFT JOIN 
                        faculty b 
                    ON 
                        a.personID = b.facID 
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