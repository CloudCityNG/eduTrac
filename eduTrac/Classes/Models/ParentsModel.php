<?php namespace eduTrac\Classes\Models;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Parents Model
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
 * @since       1.0.2
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */

use \eduTrac\Classes\Core\DB;
use \eduTrac\Classes\Libraries\Hooks;
class ParentsModel {
    
    private $_auth;
    private $_log;
	
	public function __construct() {
        $this->_auth = new \eduTrac\Classes\Libraries\Cookies;
        $this->_log = new \eduTrac\Classes\Libraries\Log;
	}
	
	public function search() {
        $array = [];
		$parent = isPostSet('parent');
        $bind = [ ":parent" => "%$parent%" ];
        $q = DB::inst()->query( "SELECT 
                        a.parentID,
                        b.lname,
                        b.fname 
                    FROM 
                        parent a 
                    LEFT JOIN 
                        person b 
                    ON 
                        a.parentID = b.personID  
                    WHERE 
                        (CONCAT(fname,' ',lname) LIKE :parent 
                    OR 
                        CONCAT(lname,' ',fname) LIKE :parent 
                    OR 
                        CONCAT(lname,', ',fname) LIKE :parent) 
                    OR 
                        a.parentID LIKE :parent",
                    $bind
        );
        
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
	}
    
    public function runParent($id) {
        $date = date("Y-m-d h:m:s");
        $bind = array( 
            "parentID" => $id,"status" => 'A',
            "addDate" => $date,"addedBy" => $this->_auth->getPersonField('personID')
        );
        
        $q = DB::inst()->insert( "parent", $bind );
        
        if(!$q) {
            redirect( BASE_URL . 'error/save_data/' );
        } else {
            $this->_log->setLog('New Record','Parent',get_name($id));
            redirect( BASE_URL . 'parents/view/' . $id . '/' . bm() );
        }
    
    }
    
    public function runEditParent($data) {
        $update = array( 
            "status" => $data['status']
        );
        
        $bind = array( ":parentID" => $data['parentID'] );
        
        $q = DB::inst()->update( "parent", $update, "parentID = :parentID", $bind );
        $this->_log->setLog('Update Record','Parent',get_name($data['parentID']));
        redirect( BASE_URL . 'parents/view/' . $data['parentID'] . '/' . bm() );
    }
    
    public function Parent($id) {
        $array = [];
        $bind = array( ":id" => $id );
        $q = DB::inst()->query( "SELECT 
                parentID,
                status 
            FROM 
                parent 
            WHERE 
                parentID = :id",
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
    
    public function children($id) {
        $array = [];
        $bind = [ ":id" => $id ];
        
        $q = DB::inst()->query( "SELECT 
                    a.stuID,
                    b.lname,
                    b.fname,
                    c.ID 
                FROM 
                    student a 
                LEFT JOIN 
                    person b 
                ON 
                    a.stuID = b.personID 
                LEFT JOIN 
                    parent_child c 
                ON 
                    a.stuID = c.childID 
                WHERE 
                    c.parentID = :id",
                $bind 
        );
        
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function childPortal() {
        $array = [];
        $bind = [ ":id" => $this->_auth->getPersonField('personID') ];
        
        $q = DB::inst()->query( "SELECT 
                    a.ID,
                    a.childID,
                    b.lname,
                    b.fname 
                FROM 
                    parent_child a 
                LEFT JOIN 
                    person b 
                ON 
                    a.childID = b.personID 
                WHERE 
                    a.parentID = :id",
                $bind 
        );
        
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function grades($id) {
        $array = [];
        $bind = [ ":id" => $id ];
        $q = DB::inst()->query( "SELECT 
                        a.stuID,
                        a.acadLevelCode,
                        a.grade,
                        b.courseSecCode,
                        b.secShortTitle,
                        c.termCode 
                    FROM 
                        stu_acad_cred a 
                    LEFT JOIN 
                        course_sec b 
                    ON 
                        a.courseSecID = b.courseSecID 
                    LEFT JOIN 
                        term c 
                    ON 
                        a.termID = c.termID 
                    WHERE 
                        a.stuID = :id 
                    ORDER BY 
                        a.termID",
                    $bind 
        );
        
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function progress($id) {
        $array = [];
        $bind = [ ":id" => $id, ":parentID" => $this->_auth->getPersonField('personID') ];
        $q = DB::inst()->query( "SELECT 
                        a.* 
                    FROM 
                        progress_report a 
                    LEFT JOIN 
                        parent_child b 
                    ON 
                        a.stuID = b.childID 
                    WHERE 
                        a.stuID = :id 
                    AND 
                        b.parentID = :parentID",
                    $bind 
        );
        
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function viewProgress($id) {
        $array = [];
        $bind = [ ":id" => $id ];
        $q = DB::inst()->query( "SELECT 
                        * 
                    FROM 
                        progress_report 
                    WHERE 
                        stuID = :id",
                    $bind 
        );
        
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function runParLookup($data) {
        $bind = [ ":id" => $data['parentID'] ];
        $q = DB::inst()->query( "SELECT 
                    a.personID,
                    a.lname,
                    a.fname 
                FROM 
                    person a 
                LEFT JOIN 
                    parent b 
                ON 
                    a.personID = b.parentID 
                WHERE 
                    b.parentID = :id",
                $bind 
        );
        foreach($q as $k => $v) {
            $json = [ 'input#parentName' => $v['lname'].', '.$v['fname'] ];
        }
        echo json_encode($json);
    }
    
    public function runChildLookup($data) {
        $bind = [ ":id" => $data['childID'] ];
        $q = DB::inst()->query( "SELECT 
                    a.personID,
                    a.lname,
                    a.fname 
                FROM 
                    person a 
                LEFT JOIN 
                    student b 
                ON 
                    a.personID = b.stuID 
                WHERE 
                    b.stuID = :id",
                $bind 
        );
        foreach($q as $k => $v) {
            $json = [ 'input#childName' => $v['lname'].', '.$v['fname'] ];
        }
        echo json_encode($json);
    }
    
    public function runConnection($data) {
        $bind = [ "parentID" => $data['parentID'], "childID" => $data['childID'] ];
        $q = DB::inst()->insert( "parent_child", $bind );
        if(!$q) {
            redirect( BASE_URL . 'error/save_data' );
        } else {
            $this->_log->setLog('New Record','Parent/Child Connection',get_name($data['parentID']).' & '.get_name($data['childID']));
            redirect( BASE_URL . 'success/save_data' );
        }
    }
    
    public function deleteConnection($id) {
        $bind = [ ":id" => $id ];
        $q = DB::inst()->delete( "parent_child", "ID = :id", $bind );
        redirect( $_SERVER['HTTP_REFERER'] );
    }
    
	public function __destruct() {
		DB::inst()->close();
	}
	
}