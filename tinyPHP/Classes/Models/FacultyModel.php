<?php namespace tinyPHP\Classes\Models;
/**
 *
 * Faculty Model
 *  
 * PHP 5
 *
 * eduTrac(tm) : Student Information System (http://www.7mediaws.org/)
 * Copyright (C) 2013 Joshua Parker
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
 * @since eduTrac(tm) v 1.0
 * @license GNU General Public License v3 (http://www.gnu.org/licenses/gpl-3.0.html)
 */

if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');

use \tinyPHP\Classes\Core\DB;
class FacultyModel {
	
	public function __construct() {}
	
	public function search() {
		$fac = isPostSet('faculty');
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
                        (CONCAT(fname,' ',lname) LIKE '%".$fac."%' 
                    OR 
                        CONCAT(lname,' ',fname) LIKE '%".$fac."%' 
                    OR 
                        CONCAT(lname,', ',fname) LIKE '%".$fac."%') 
                    OR 
                        a.facID LIKE '%".$fac."%'"
        );
        
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
	}
    
    public function person($id) {
        $bind = array( ":id" => $id );
        $q = DB::inst()->select( "person","personID = :id","","personID",$bind );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function runFaculty($data) {        
        $bind = array( 
            "facID" => $data['facID'],"buildingCode" => $data['buildingCode'],
            "officeCode" => $data['officeCode'],"office_phone" => $data['office_phone'],
            "deptCode" => $data['deptCode'],"addDate" => $data['addDate'],
            "approvedBy" => $data['approvedBy']
        );
        
        $q = DB::inst()->insert( "faculty", $bind );
        
        if(!$q) {
            redirect( BASE_URL . 'error/save_data/' );
        } else {
            redirect( BASE_URL . 'faculty/view/' . $data['facID'] . '/' . bm() );
        }
    
    }
    
    public function runEditFaculty($data) {
        $update = array( 
            "buildingCode" => $data['buildingCode'],
            "officeCode" => $data['officeCode'],"office_phone" => $data['office_phone'],
            "deptCode" => $data['deptCode']
        );
        
        $bind = array( ":facID" => $data['facID'] );
        
        $q = DB::inst()->update( "faculty", $update, "facID = :facID", $bind );
        redirect( BASE_URL . 'faculty/view/' . $data['facID'] . '/' . bm() );
    }
    
    public function faculty($id) {
        $bind = array( ":id" => $id );
        $q = DB::inst()->select( "faculty","facID = :id","","*",$bind );
        
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
	public function __destruct() {
		DB::inst()->close();
	}
	
}