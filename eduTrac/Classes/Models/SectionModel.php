<?php namespace eduTrac\Classes\Models;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Section Model
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
class SectionModel {
    
    private $_sec;
    private $_auth;
    private $_stuProg;
	
	public function __construct() {
	    $this->_sec = new \eduTrac\Classes\DBObjects\CourseSec;
        $this->_auth = new \eduTrac\Classes\Libraries\Cookies;
        $this->_stuProg = new \eduTrac\Classes\DBObjects\StuProgram;
	}
	
	public function search() {
        $array = [];
	    $sec = isPostSet('sec');
	    $bind = array(":sec" => "%$sec%");
        $q = DB::inst()->query( "SELECT 
                    a.courseSecCode,
                    a.secShortTitle,
                    a.currStatus,
                    a.courseSecID,
                    b.termCode 
                FROM 
                    course_sec a 
                LEFT JOIN 
                    term b 
                ON 
                    a.termID = b.termID 
                WHERE 
                    courseSecCode LIKE :sec",
                $bind
        );
        
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
	}
    
    public function crse($id) {
        $array = [];
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
            "sectionNumber" => $data['sectionNumber'],"courseSecCode" => $sc,"locationID" => $data['locationID'],
            "termID" => $data['termID'],"courseID" => $data['courseID'],"secShortTitle" => $data['secShortTitle'],
            "startDate" => $data['startDate'],"endDate" => $data['endDate'],"deptID" => $data['deptID'],
            "minCredit" => $data['minCredit'],
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
            "locationID" => $data['locationID'],"termID" => $data['termID'],"secShortTitle" => $data['secShortTitle'],
            "startDate" => $data['startDate'],"endDate" => $data['endDate'],"deptID" => $data['deptID'],
            "minCredit" => $data['minCredit'],
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
    
    public function runSOFF($data) {
        $dotw = '';
      	// Combine the days of the week to be entered into the database //
  		$days = $data['dotw'];
  		for($i = 0; $i < sizeof($days); $i++) {
   			$dotw .= $days[$i];
  		}
        
        $update = [
                    "buildingID" => $data['buildingID'],"roomID" => $data['roomID'],
                    "dotw" => $dotw,"startTime" => $data['startTime'],
                    "endTime" => $data['endTime'],"stuReg" => $data['stuReg'] 
                  ];
                  
        $bind = [ ":id" => $data['courseSecID'] ];
        
        $q = DB::inst()->update("course_sec",$update,"courseSecID = :id",$bind);
        
        if(!$q) {
            redirect( BASE_URL . 'error/update_record/' );
        } else {
            redirect( BASE_URL . 'section/offering_info/' . $data['courseSecID'] . '/' . bm() );
        }
    }
    
    public function section($id) {
        $array = [];
        $bind  = array( ":id" => $id );
        $q = DB::inst()->select( "course_sec","courseSecID = :id","","*",$bind );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function crseList() {
        $array = [];
        $q = DB::inst()->query( "SELECT courseCode FROM course" );
        if($q->rowCount() > 0) {
            while($r = $q->fetch(\PDO::FETCH_ASSOC)) {
                $array[] = $r;
            }
            return $array;
        }
    }
    
    public function addntl($id) {
        $array = [];
        $bind = [ ":id" => $id ];
        $q = DB::inst()->query( "SELECT 
                courseID,preReq,allowAudit,allowWaitlist,minEnroll,seatCap 
            FROM 
                course 
            WHERE 
                courseID = :id",
            $bind
        );
        
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function soff($id) {
        $array = [];
        $bind = [ ":id" => $id ];
        $q = DB::inst()->query( "SELECT 
                    courseSecID,
                    courseSecCode,
                    buildingID,
                    roomID,
                    dotw,
                    startTime,
                    endTime,
                    stuReg 
                FROM 
                    course_sec 
                WHERE 
                    courseSecID = :id",
                $bind
        );
        
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    /*public function deleteCourse($id) {
        $q = DB::inst()->delete( "course", "courseID = '$id'" );
        
        if($q) {
            redirect( BASE_URL . 'success/delete_record/' );
        } else {
            redirect( BASE_URL . 'error/delete_record/');
        }
    }*/
    
    public function runTermLookup($data) {
        $bind = array(":id" => $data['termID']);
        $q = DB::inst()->select( "term","termID = :id AND active = '1'","termID","termID,termCode,termStartDate,termEndDate",$bind );
        foreach($q as $k => $v) {
            $json = array( 'input#startDate' => $v['termStartDate'], 'input#endDate' => $v['termEndDate'] );
        }
        echo json_encode($json);
    }
    
    public function runStuLookup($data) {
        $bind = [ ":id" => $data['stuID'] ];
        $q = DB::inst()->select( "person","personID = :id","","personID,fname,lname",$bind );
        foreach($q as $k => $v) {
            $json = [ 'input#stuName' => $v['lname'].', '.$v['fname'] ];
        }
        echo json_encode($json);
    }
    
    public function runSecLookup($data) {
        $bind = [ ":id" => $data['courseSecID'] ];
        $q = DB::inst()->query( "SELECT 
                    a.courseSecID,
                    a.courseSecCode,
                    a.secShortTitle,
                    b.termCode,
                    b.termName 
                FROM 
                    course_sec a 
                LEFT JOIN 
                    term b 
                ON 
                    a.termID = b.termID 
                WHERE 
                    a.courseSecID = :id",
                $bind 
        );
        foreach($q as $k => $v) {
            $json = [ 
                    'input#courseSecCode' => $v['courseSecCode'],
                    'input#secShortTitle' => $v['secShortTitle'],
                    'input#term' => $v['termCode'].' '.$v['termName']
                    ];
        }
        echo json_encode($json);
    }
    
    public function runReg($data) {
        $this->_sec->Load_from_key($data['courseSecID']);
        $date = date("Y-m-d");
        $time = date("h:m A");
        $bind1 = array( "stuID" => $data['stuID'],"courseSecID" => $this->_sec->getCourseSecID(),
                       "termID" => $this->_sec->getTermID(),"courseCredits" => $this->_sec->getMinCredit(),
                       "ceu" => $this->_sec->getCEU(),"status" => "A","statusDate" => $date,
                       "statusTime" => $time,"addedBy" => $this->_auth->getPersonField('personID') );
       
        $q1 = DB::inst()->insert( "stu_course_sec", $bind1 );
       
        $bind2 = [ 
                "stuID" => $data['stuID'],
                "courseSecID" => $this->_sec->getCourseSecID(),"termID" => $this->_sec->getTermID(),
                "attCred" => $this->_sec->getMinCredit(),
                "acadLevelCode" => $this->_stuProg->getAcadLevelCode($data['stuID'])
                ];
                    
        $q2 = DB::inst()->insert( "stu_acad_cred", $bind2 );
       
        if(!$q1 && !$q2) {
           redirect( BASE_URL . 'error/save_data/' );
        } else {
           redirect( BASE_URL . 'success/save_data/' );
        }
    }
    
    public function courseSec() {
        $array = [];
        $id = Hooks::get_option('current_term_id');
        $facID = $this->_auth->getPersonField('personID');
        $bind = [ ":termID" => $id, ":facID" => $facID ];
        $q = DB::inst()->query( "SELECT 
                    a.courseSecID,
                    a.courseSecCode,
                    a.secShortTitle,
                    b.termName 
                FROM 
                    course_sec a 
                LEFT JOIN 
                    term b 
                ON 
                    a.termID = b.termID 
                WHERE 
                    a.termID = :termID 
                AND 
                    a.facID = :facID",
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
                a.courseSecID,
                a.termID,
                a.grade,
                b.courseSecCode,
                b.minCredit,
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
                a.courseSecID = :id 
            AND 
                a.termID = b.termID",
            $bind 
        );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function runGrades($data) {
        $size = count($data['stuID']);
        $i = 0;
            while($i < $size) {
                $update = [ 
                            "grade" => $data['grade'][$i],"compCred" => $data['cmplCredit'],
                            "gradePoints" => calculateGradePoints($data['grade'][$i])
                        ];
                
                $bind = [ 
                        ":stuID" => $data['stuID'][$i],":courseSecID" => $data['courseSecID'],
                        ":termID" => $data['termID']
                        ];
                        
                $q = DB::inst()->update( "stu_acad_cred",
                                $update,
                                "stuID = :stuID 
                            AND 
                                courseSecID = :courseSecID 
                            AND 
                                termID = :termID",
                            $bind 
                );
            ++$i;
            }
        
        if(!$q) {
            redirect( BASE_URL . 'error/update_record/' );
        } else {
            redirect( BASE_URL . 'section/grading/' . $data['courseSecID'] . '/' . bm() );
        }
    }
    
	public function __destruct() {
		DB::inst()->close();
	}
	
}