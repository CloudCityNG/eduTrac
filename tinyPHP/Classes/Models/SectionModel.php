<?php namespace tinyPHP\Classes\Models;
/**
 *
 * Section Model
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
 * @license GNU General Public License v3 (http://www.gnu.org/licenses/gpl-3.0.html)
 * @since   eduTrac(tm) v 1.0.0
 * @package Model
 * @author  Joshua Parker <josh@7mediaws.org>
 */

if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');

use \tinyPHP\Classes\Core\DB;
class SectionModel {
    
    private $_sec;
    private $_auth;
	
	public function __construct() {
	    $this->_sec = new \tinyPHP\Classes\DBObjects\CourseSec;
        $this->_auth = new \tinyPHP\Classes\Libraries\Cookies;
	}
	
	public function search() {
	    $sec = isPostSet('sec');
	    $bind = array(":sec" => "%$sec%");
        $q = DB::inst()->select( "course_sec",
                "courseSecCode LIKE :sec",
                "",
                "courseSecCode,
                secShortTitle,
                currStatus,
                termCode,
                courseSecID",
                $bind
        );
        
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
	}
    
    public function crse($id) {
        $bind = array( ":id" => $id );
        $q = DB::inst()->select( "course", "courseID = :id", "", "courseID,courseCode", $bind );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function runSection($data) {
        $sc = $data['courseCode'].'-'.$data['sectionNumber'];
        
        $bind = array( 
            "sectionNumber" => $data['sectionNumber'],"courseSecCode" => $sc,"locationCode" => $data['locationCode'],
            "termCode" => $data['termCode'],"courseID" => $data['courseID'],"secShortTitle" => $data['secShortTitle'],
            "startDate" => $data['startDate'],"endDate" => $data['endDate'],"deptCode" => $data['deptCode'],
            "minCredit" => $data['minCredit'],"maxCredit" => $data['maxCredit'],"increCredit" => $data['increCredit'],
            "ceu" => $data['ceu'],"courseLevelCode" => $data['courseLevelCode'],"acadLevelCode" => $data['acadLevelCode'],
            "currStatus" => $data['currStatus'],"statusDate" => $data['statusDate'],
            "approvedDate" => $data['approvedDate'],"approvedBy" => $data['approvedBy']
        );
        
        $q = DB::inst()->insert( "course_sec", $bind );
           
        $ID = DB::inst()->lastInsertId('courseSecID');
        
        if(!$q) {
            redirect( BASE_URL . 'error/save_data/' );
        } else {
            redirect( BASE_URL . 'section/view/' . $ID . '/' . bm() );
        }
    
    }
    
    public function runEditSection($data) {
        $date = date("Y-m-d");
        $this->_sec->Load_from_key($data['courseSecID']);
        $bind = array( ":courseSecID" => $data['courseSecID'] );
        
        $update1 = array( 
            "locationCode" => $data['locationCode'],"termCode" => $data['termCode'],"secShortTitle" => $data['secShortTitle'],
            "startDate" => $data['startDate'],"endDate" => $data['endDate'],"deptCode" => $data['deptCode'],
            "minCredit" => $data['minCredit'],"maxCredit" => $data['maxCredit'],"increCredit" => $data['increCredit'],
            "ceu" => $data['ceu'],"courseLevelCode" => $data['courseLevelCode'],"acadLevelCode" => $data['acadLevelCode'],
            "currStatus" => $data['currStatus']
        );
        
        $update2 = array( "statusDate" => $date );
        
        $q = DB::inst()->update( "course_sec", $update1, "courseSecID = :courseSecID", $bind );
        
        if($this->_sec->getcurrStatus() != $data['currStatus']) {
            DB::inst()->update( "course_sec", $update2, "courseSecID = :courseSecID", $bind );
        }
        redirect( BASE_URL . 'section/view/' . $data['courseSecID'] . '/' . bm() );
    }
    
    public function runAddnl($data) {        
        $update = array( 
            "facID" => $data['facID'],"secType" => $data['secType'],"instructorMethod" => $data['instructorMethod'],
            "contactHours" => $data['contactHours'],"instructorLoad" => $data['instructorLoad']
        );
        
        $bind = array( ":courseSecID" => $data['courseSecID'] );
        
        $q = DB::inst()->update( "course_sec", $update, "courseSecID = :courseSecID", $bind );
        redirect( BASE_URL . 'section/addnl_info/' . $data['courseSecID'] . '/' . bm() );
    }
    
    public function section($id) {
        $bind  = array( ":id" => $id );
        $q = DB::inst()->select( "course_sec","courseSecID = :id","","*",$bind );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function crseList() {
        $q = DB::inst()->query( "SELECT courseCode FROM course" );
        if($q->rowCount() > 0) {
            while($r = $q->fetch(\PDO::FETCH_ASSOC)) {
                $array[] = $r;
            }
            return $array;
        }
    }
    
    public function addntl($id) {
        $q = DB::inst()->query( "SELECT 
                courseID,preReq,allowAudit,allowWaitlist,minEnroll,seatCap 
            FROM 
                course 
            WHERE 
                courseID = '$id'" 
        );
        
        if($q->rowCount() > 0) {
            while($r = $q->fetch(\PDO::FETCH_ASSOC)) {
                $array[] = $r;
            }
            return $array;
        }
    }
    
    /*public function deleteCourse($id) {
        $q = DB::inst()->delete( "course", "courseID = '$id'" );
        
        if($q) {
            redirect( BASE_URL . 'success/delete_course/' );
        } else {
            redirect( BASE_URL . 'error/delete_course/');
        }
    }*/
    
    public function runTermLookup($data) {
        $bind = array(":code" => $data['termCode']);
        $q = DB::inst()->select( "term","termCode = :code AND active = '1'","termID","termStartDate,termEndDate",$bind );
        foreach($q as $k => $v) {
            $json = array( 'input#startDate' => $v['termStartDate'], 'input#endDate' => $v['termEndDate'] );
        }
        echo json_encode($json);
    }
    
    public function runReg($data) {
        $this->_sec->Load_from_key($data['courseSecID']);
        $date = date("Y-m-d");
        $time = date("hh:mm A");
        $bind = array( "stuID" => $data['stuID'],"courseSecCode" => $this->_sec->getCourseSecCode(),
                       "termCode" => $this->_sec->getTermCode(),"courseCredits" => $this->_sec->getMinCredit(),
                       "ceu" => $this->_sec->getCEU(),"status" => "A","statusDate" => $date,
                       "statusTime" => $time,"addedBy" => $this->_auth->getPersonField('personID') );
       
       $q = DB::inst()->insert( "stu_course_sec", $bind );
       if(!$q) {
           redirect( BASE_URL . 'error/save_data/' );
       } else {
           redirect( BASE_URL . 'success/save_data/' );
       }
    }
    
	public function __destruct() {
		DB::inst()->close();
	}
	
}