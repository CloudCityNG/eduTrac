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
 * @since       3.0.0
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */

use \eduTrac\Classes\Core\DB;
use \eduTrac\Classes\Libraries\Hooks;
class SectionModel {
    
    private $_sec;
    private $_auth;
    private $_stuProg;
    private $_log;
    private $_email;
    private $_uname;
	
	public function __construct() {
	    $this->_sec = new \eduTrac\Classes\DBObjects\CourseSec;
        $this->_auth = new \eduTrac\Classes\Libraries\Cookies;
        $this->_stuProg = new \eduTrac\Classes\DBObjects\StuProgram;
        $this->_log = new \eduTrac\Classes\Libraries\Log;
        $this->_email = new \eduTrac\Classes\Libraries\Email;
        $this->_uname = $this->_auth->getPersonField('uname');
	}
	
	public function search() {
        $array = [];
	    $sec = isPostSet('sec');
	    $bind = array(":sec" => "%$sec%");
        $q = DB::inst()->query( "SELECT 
                    CASE a.currStatus 
                    WHEN 'A' THEN 'Active' 
                    WHEN 'I' THEN 'Inactive' 
                    WHEN 'P' THEN 'Pending' 
                    WHEN 'C' THEN 'Cancelled' 
                    ELSE 'Obsolete'
                    END AS 'Status', 
                        a.courseSecCode,
                        a.secShortTitle,
                        a.courseSecID,
                        a.termCode 
                    FROM 
                        course_sec a 
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
    
    public function catalog() {
        $array = [];
        $q = DB::inst()->query( "SELECT 
                        a.termCode,
                        COUNT(a.courseSecCode) as Courses,
                        b.termName 
                    FROM 
                        course_sec a 
                    LEFT JOIN 
                        term b 
                    ON 
                        a.termCode = b.termCode 
                    WHERE 
                        a.currStatus = 'A' 
                    GROUP BY 
                        a.termCode 
                    ORDER BY 
                        a.termCode 
                    DESC",
                    $bind 
        );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function pdf() {
        $array = [];
        $bind = [ ":term" => isGetSet('term') ];
        $q = DB::inst()->query( "SELECT 
                        courseSecCode,
                        termCode,
                        secShortTitle,
                        facID,
                        dotw,
                        startTime,
                        endTime,
                        roomCode 
                    FROM 
                        course_sec 
                    WHERE 
                        termCode = :term 
                    ORDER BY 
                        courseSecCode",
                    $bind 
        );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function section($id) {
        $array = [];
        $bind  = array( ":id" => $id );
        $q = DB::inst()->query( "SELECT 
        				a.*,
        				b.preReq 
    				FROM 
    					course_sec a 
					LEFT JOIN 
						course b 
					ON 
						a.courseCode = b.courseCode 
					WHERE 
						a.courseSecID = :id",
					$bind 
		);
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
                    buildingCode,
                    roomCode,
                    termCode,
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
    
    public function binfo($id) {
        $array = [];
        $bind = [ ":id" => $id ];
        $q = DB::inst()->query( "SELECT 
                    courseSecID,
                    courseSecCode,
                    termCode,
                    courseFee,
                    labFee,
                    materialFee 
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
    
    public function bookInfo($id) {
        $array = [];
        $bind = [ ":id" => $id ];
        $q = DB::inst()->query( "SELECT 
                    a.courseSecID,
                    a.courseSecCode,
                    a.termCode,
                    a.roomCode,
                    a.dotw,
                    a.startTime,
                    a.endTime,
                    b.termStartDate,
                    b.termEndDate 
                FROM 
                    course_sec a 
                LEFT JOIN 
                	term b 
            	ON 
            		a.termCode = b.termCode 
                WHERE 
                    a.courseSecID = :id",
                $bind
        );
        
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function booking($id) {
        $array = [];
        $bind = [ ":id" => $id ];
        $q = DB::inst()->query( "SELECT 
                    a.*,
                    b.weekDay 
                FROM 
                    event_meta a 
                LEFT JOIN 
                    event b 
                ON 
                    a.eventID = b.eventID 
                LEFT JOIN 
                    course_sec c 
                ON 
                    b.title = c.courseSecCode 
                WHERE 
                    b.termCode = c.termCode 
                AND 
                    c.courseSecID = :id 
                ORDER BY 
                    a.start",
                $bind
        );
        
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function courseSec() {
        $array = [];
        $facID = $this->_auth->getPersonField('personID');
        $bind = [ ":facID" => $facID ];
        $q = DB::inst()->query( "SELECT 
                    courseSecID,
                    courseSecCode,
                    secShortTitle,
                    termCode  
                FROM 
                    course_sec a 
                WHERE 
                    facID = :facID 
                GROUP BY 
                    termCode,courseSecCode 
                ORDER BY 
                	termCode 
            	DESC",
                $bind
        );
        
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function attendance($code) {
        /**
         * Checks to see if attendance data for current date is present.
         */
        $array1 = [];
        $date = date('Y-m-d');
        $bind1 = [ ":code" => $code,":term" => isGetSet('term'),":date" => $date ];
        $bind2 = [ ":code" => $code, ":term" => isGetSet('term') ];
        $q1 = DB::inst()->query( "SELECT 
                    * 
                FROM 
                    attendance 
                WHERE 
                    courseSecCode = :code 
                AND 
                	termCode = :term 
            	AND 
            	   facID = 
            	AND 
            		date = :date",
                $bind1 
        );
        
        /**
         * If there is no attendance data for the current date, then create default date 
         * to be updated by professor/teacher/faculty.
         */
        if($q1 == NULL) {
            $q2 = DB::inst()->select( "stu_acad_cred","courseSecCode = :code AND termCode = :term","","*",$bind2);
            foreach($q2 as $r2) {
                $array1 = $r2;
            }
            
            if($q2 != NULL) {
                $bind2 = [ "termCode" => isGetSet('term'), "courseSecCode" => $code,"stuID" => $r2['stuID'],"date" => $date ];
                $size = count($r2['stuID']);
                $i = 0;
                while($i < $size) {
                   $q = DB::inst()->insert( "attendance", $bind2 );
                    ++$i;
                }
            }
        }
        
        /**
         * Display the current day's attendance data.
         */
        $array = [];
        $facID = $this->_auth->getPersonField('personID');
        $bind = [ ":facID" => $facID, ":code" => $code, ":term" => isGetSet('term'), ":date" => $date ];
        $q = DB::inst()->query( "SELECT 
                    a.*,
                    c.termCode
                FROM 
                    attendance a 
                LEFT JOIN 
                    course_sec b 
                ON 
                    a.courseSecCode = b.courseSecCode 
                LEFT JOIN 
                    term c 
                ON 
                    b.termCode = c.termCode 
                WHERE 
                    b.facID = :facID 
                AND 
                    a.courseSecCode = :code 
                AND 
                	c.termCode = :term 
                AND 
                    a.date = :date",
                $bind
        );
        
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function attendanceReport($code) {
        $array = [];
        $bind = [ ":code" => $code,":stuID" => isGetSet('stuID'),":term" => isGetSet('term'),":fac" => $this->_auth->getPersonField('personID') ];
        $q = DB::inst()->query( "SELECT 
                    CASE 
                        a.status 
                    WHEN 
                        'A' 
                    THEN 
                        'Absent' 
                    ELSE 
                        'Present' 
                    END AS 
                        'Status',
                        a.stuID,
                        a.date,
                        a.courseSecCode,
                        a.termCode 
                    FROM 
                        attendance a 
                    LEFT JOIN 
                        course_sec b 
                    ON 
                        a.courseSecCode = b.courseSecCode 
                    AND 
                    	a.termCode = b.termCode 
                    WHERE 
                        a.courseSecCode = :code 
                    AND 
                    	a.termCode = :term 
                    AND 
                        a.stuID = :stuID 
                    AND 
                        a.status <> 'NULL' 
                    AND 
                        b.facID = :fac 
                    GROUP BY 
                    	a.stuID 
                    ORDER BY 
                        a.date",
                    $bind 
        );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function finalGrade($code) {
        $array = [];
        $bind = [ ":code" => $code, ":term" => isGetSet('term'), ":fac" => $this->_auth->getPersonField('personID') ];
        $q = DB::inst()->query( "SELECT 
                a.stuID,
                a.courseSecCode,
                a.termCode,
                a.grade,
                b.secShortTitle,
                b.minCredit 
            FROM 
                stu_acad_cred a 
            LEFT JOIN 
                course_sec b 
            ON 
                a.courseSecCode = b.courseSecCode 
            WHERE 
                a.courseSecCode = :code 
            AND 
                a.termCode = b.termCode 
            AND 
                a.termCode = :term 
            AND 
                b.facID = :fac",
            $bind 
        );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
	
	public function grades($id) {
		$array = [];
		$bind = [ ":id" => $id, ":fac" => $this->_auth->getPersonField('personID') ];
		$q = DB::inst()->query( "SELECT 
						a.stuID,
						a.courseSecCode,
						b.secShortTitle,
						c.assignID,
						c.termCode,
						c.facID,
						c.title,
						d.grade 
					FROM 
						stu_course_sec a 
					LEFT JOIN 
						course_sec b 
					ON 
						a.courseSecCode = b.courseSecCode 
					LEFT JOIN 
						assignment c 
					ON 
						a.courseSecCode = c.courseSecCode 
					LEFT JOIN 
						gradebook d 
					ON 
						c.assignID = d.assignID 
					LEFT JOIN 
						person e 
					ON 
						a.stuID = e.personID 
					WHERE 
						c.assignID = :id 
					AND 
					   a.termCode = c.termCode 
					AND 
					   c.facID = :fac 
					GROUP BY 
						a.stuID 
					ORDER BY 
						e.lname",
					$bind 
		);
		foreach($q as $r) {
			$array[] = $r;
		}
		return $array;
	}
	
	public function gradebookAssign($code) {
		$array = [];
		$bind = [ ":code" => $code, ":term" => isGetSet('term'), ":fac" => $this->_auth->getPersonField('personID') ];
		$q = DB::inst()->query( "SELECT 
						a.*,
						b.courseSecID,
						b.secShortTitle 
					FROM 
						assignment a 
					LEFT JOIN 
						course_sec b 
					ON 
						a.courseSecCode = b.courseSecCode 
					WHERE 
						a.courseSecCode = :code 
					AND 
					    a.termCode = :term 
				    AND 
				    	b.termCode = :term 
				    AND 
				        a.facID = :fac 
					GROUP BY 
						a.title",
					$bind 
		);
		foreach($q as $r) {
			$array[] = $r;
		}
		return $array;
	}
	
	public function gradebookStu($code) {
		$array = [];
		$bind = [ ":code" => $code, ":term" => isGetSet('term'), ":fac" => $this->_auth->getPersonField('personID') ];
		$q = DB::inst()->query( "SELECT 
						a.* 
					FROM 
						gradebook a 
					LEFT JOIN 
						person b 
					ON 
						a.stuID = b.personID 
					WHERE 
						a.courseSecCode = :code 
					AND 
					   a.termCode = :term 
				    AND 
				        a.facID = :fac 
					GROUP BY 
						a.stuID 
					ORDER BY 
						b.lname",
					$bind 
		);
		foreach($q as $r) {
			$array[] = $r;
		}
		return $array;
	}
    
    public function addAssign($code) {
    	$array = [];
		$bind = [ ":code" => $code, ":term" => isGetSet('term'), ":fac" => $this->_auth->getPersonField('personID') ];
		$q = DB::inst()->select( "course_sec","courseSecCode = :code AND termCode = :term AND facID = :fac","","courseSecID,secShortTitle,facID,termCode,courseSecCode",$bind );
		foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function viewAssign($id) {
    	$array = [];
		$bind = [ ":id" => $id, ":fac" => $this->_auth->getPersonField('personID') ];
		$q = DB::inst()->query( "SELECT 
						a.*,
						b.courseSecID,
						b.secShortTitle 
					FROM 
						assignment a 
					LEFT JOIN 
						course_sec b 
					ON 
						a.courseSecCode = b.courseSecCode 
					AND 
					   a.facID = :fac 
					WHERE 
						a.assignID = :id",
					$bind 
		);
		foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function assignments($code) {
    	$array = [];
		$bind = [ ":code" => $code, ":term" => isGetSet('term'), ":fac" => $this->_auth->getPersonField('personID') ];
		$q = DB::inst()->query( "SELECT 
						a.*,
						b.secShortTitle 
					FROM 
						assignment a 
					LEFT JOIN 
						course_sec b 
					ON 
						a.courseSecCode = b.courseSecCode 
					WHERE 
						a.courseSecCode = :code 
					AND 
						a.termCode = :term 
					AND 
					   a.facID = :fac 
					GROUP BY 
						a.title",
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
    
    public function roster() {
    	$array = [];
    	$bind = [ ":term" => isGetSet('termCode'),":section" => isGetSet('sectionCode') ];
		$q = DB::inst()->query( "SELECT 
						a.stuID,
						a.courseSecCode,
						a.termCode,
						a.courseCredits,
					CASE a.status 
					WHEN 'A' THEN 'Add' 
					WHEN 'N' THEN 'New'
					ELSE 'Drop' 
					END AS 'Status',
						b.acadProgCode,
						b.acadLevelCode,
						c.facID,
						c.roomCode,
						c.secShortTitle,
						c.startDate,
						c.endDate,
						c.startTime,
						c.endTime,
						c.dotw,
						c.instructorMethod 
					FROM 
						stu_course_sec a 
					LEFT JOIN 
						stu_acad_level b 
					ON 
						a.stuID = b.stuID 
					LEFT JOIN 
						course_sec c 
					ON 
						a.courseSecCode = c.courseSecCode 
					WHERE 
						a.courseSecCode = :section 
					AND 
						a.termCode = :term 
					AND 
						c.courseSecCode = :section 
					AND 
						c.termCode = :term 
					AND 
						a.status IN('A','N','D') 
					AND 
						b.addDate = (SELECT MAX(addDate) FROM stu_program WHERE stuID = a.stuID)",
					$bind 
		);
		foreach($q as $r) {
			$array[] = $r;
		}
		return $array;
    }
	
	public function rosterCount() {
    	$array = [];
    	$bind = [ ":term" => isGetSet('termCode'),":section" => isGetSet('sectionCode') ];
		$q = DB::inst()->query( "SELECT 
						COUNT(stuID) AS StuCount 
					FROM 
						stu_course_sec 
					WHERE 
						courseSecCode = :section 
					AND 
						termCode = :term 
					AND 
						status IN('A','N','D')",
					$bind 
		);
		foreach($q as $r) {
			$array[] = $r;
		}
		return $array;
    }
    
    public function runSection($data) {
        $sc = $data['courseCode'].'-'.$data['sectionNumber'];
        
        $bind = array( 
            "sectionNumber" => $data['sectionNumber'],"courseSecCode" => $sc,
            "courseID" => $data['courseID'],"locationCode" => $data['locationCode'],
            "termCode" => $data['termCode'],"courseCode" => $data['courseCode'],"secShortTitle" => $data['secShortTitle'],
            "startDate" => $data['startDate'],"endDate" => $data['endDate'],"deptCode" => $data['deptCode'],
            "minCredit" => $data['minCredit'],"ceu" => $data['ceu'],
            "courseLevelCode" => $data['courseLevelCode'],"acadLevelCode" => $data['acadLevelCode'],
            "currStatus" => $data['currStatus'],"statusDate" => $data['statusDate'],"comment" => $data['comment'],
            "approvedDate" => $data['approvedDate'],"approvedBy" => $data['approvedBy']
        );
        
        $q = DB::inst()->insert( "course_sec", $bind );
           
        $ID = DB::inst()->lastInsertId('courseSecID');
        
        if(!$q) {
            redirect( BASE_URL . 'error/save_data/' );
        } else {
            $this->_log->setLog('New Record','Course Section',$data['secShortTitle'],$this->_uname);
            redirect( BASE_URL . 'section/view/' . $ID . '/' . bm() );
        }
    
    }
    
    public function runEditSection($data) {
        $date = date("Y-m-d");
        $time = date("h:m A");
        $this->_sec->Load_from_key($data['courseSecID']);
        $bind = [ ":courseSecID" => $data['courseSecID'] ];
        $param = [ ":courseSecCode" => $this->_sec->getCourseSecCode(),":term" => $this->_sec->getTermCode() ];
        
        $update1 = array( 
            "locationCode" => $data['locationCode'],"termCode" => $data['termCode'],"secShortTitle" => $data['secShortTitle'],
            "startDate" => $data['startDate'],"endDate" => $data['endDate'],"deptCode" => $data['deptCode'],
            "minCredit" => $data['minCredit'],"comment" => $data['comment'],
            "ceu" => $data['ceu'],"courseLevelCode" => $data['courseLevelCode'],"acadLevelCode" => $data['acadLevelCode']
        );
        
        $q = DB::inst()->update( "course_sec", $update1, "courseSecID = :courseSecID", $bind );
        
        $update2 = array( "status" => $data['currStatus'],"statusDate" => $date,"statusTime" => $time );
        $update3 = array( "currStatus" => $data['currStatus'], "statusDate" => $date );
        
        if($this->_sec->getCurrStatus() != $data['currStatus']) {
            /**
             * If the posted status is 'C' and today's date is less than the 
             * primary term start date, then delete all student course sec as well as 
             * student acad cred records.
             */
            if($data['currStatus'] == 'C' && $date < $r['termStartDate']) {
                DB::inst()->update( "course_sec", $update3, "courseSecID = :courseSecID", $bind );
                DB::inst()->delete('stu_course_sec','courseSecCode = :courseSecCode AND termCode = :term',$param);
                DB::inst()->delete('stu_acad_cred','courseSecCode = :courseSecCode AND termCode = :term',$param);
            }
            /**
             * If posted status is 'C' and today's date is greater than equal to the 
             * primary term start date, then update student course sec records with 
             * a 'C' status and delete student acad cred records.
             */
            elseif($data['currStatus'] == 'C' && $date >= $r['termStartDate']) {
                DB::inst()->update( "course_sec", $update3, "courseSecID = :courseSecID", $bind );
                DB::inst()->update('stu_course_sec',$update2,'courseSecCode = :courseSecCode AND termCode = :term',$param);
                DB::inst()->delete('stu_acad_cred','courseSecCode = :courseSecCode AND termCode = :term',$param);
            }
            /**
             * If the status is different from 'C', update the status and status date.
             */
            else {
                DB::inst()->update( "course_sec", $update3, "courseSecID = :courseSecID", $bind );
            }
        }
        $this->_log->setLog('Update Record','Course Section',$data['secShortTitle'],$this->_uname);
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
                    "buildingCode" => $data['buildingCode'],"roomCode" => $data['roomCode'],
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
    
    public function runBINFO($data) {
        $update = [
                    "courseFee" => $data['courseFee'],"labFee" => $data['labFee'],
                    "materialFee" => $data['materialFee']
                  ];
                  
        $bind = [ ":id" => $data['courseSecID'] ];
        $q = DB::inst()->update("course_sec",$update,"courseSecID = :id",$bind);
        
        if(!$q) {
            redirect( BASE_URL . 'error/update_record/' );
        } else {
            redirect( BASE_URL . 'section/billing_info/' . $data['courseSecID'] . '/' . bm() );
        }
    }
    
    public function runTermLookup() {
		$q = DB::inst()->query( "SELECT termCode,termName FROM term WHERE termCode <> 'NULL' AND active ='1'" );
		$items = [];
		if($q->rowCount() > 0) {
	        while($r = $q->fetch(\PDO::FETCH_ASSOC)) {
	            $option = array( 'id' => $r['termCode'], 'value' => $r['termName'] );
				$items[] = $option;
	        }
		}
        $data = json_encode($items);
		$response = isset($_GET['callback'])?$_GET['callback']."(".$data.")":$data;
    	echo($response);
    }
	
	public function runSecTermLookup($data) {
		$bind = array(":code" => $data['termCode']);
        $q = DB::inst()->select( "term","termCode = :code AND active = '1'","termCode","termCode,termStartDate,termEndDate",$bind );
        foreach($q as $k => $v) {
            $json = array( 'input#startDate' => $v['termStartDate'], 'input#endDate' => $v['termEndDate'] );
        }
        echo json_encode($json);
    }
    
    public function runStuLookup($data) {
        $bind = [ ":id" => $data['stuID'] ];
        $q = DB::inst()->query( "SELECT 
        				a.stuID,
        				b.personID,
        				b.fname,
        				b.lname 
    				FROM 
    					student a 
					LEFT JOIN 
						person b 
					ON 
						a.stuID = b.personID 
					WHERE 
						a.stuID = :id",
					$bind
		);
        foreach($q as $k => $v) {
            $json = [ 'input#stuName' => $v['lname'].', '.$v['fname'] ];
        }
        echo json_encode($json);
    }
    
    public function runSecLookup() {
    	// Get parameters from Array
	    $id = !empty($_GET['id'])
	              ?intval($_GET['id']):0;
	    $q = DB::inst()->query( "SELECT courseSecID,courseSecCode,termCode FROM course_sec WHERE termCode = $id AND currStatus = 'A'" );
		if($q->rowCount() > 0) {
	        while($r = $q->fetch(\PDO::FETCH_ASSOC)) {
	        	$option = array( 'id' => $r['courseSecID'], 'value' => $r['termCode'].'-'.$r['courseSecCode'] );
				$items[] = $option;
	        }
		}
        $data = json_encode($items);
		$response = isset($_GET['callback'])?$_GET['callback']."(".$data.")":$data;
    	echo($response);
    }
	
	public function runSecRosterLookup() {
    	// Get parameters from Array
	    $id = !empty($_GET['id'])
	              ?intval($_GET['id']):0;
	    $q = DB::inst()->query( "SELECT courseSecCode,termCode FROM course_sec WHERE termCode = $id AND currStatus = 'A'" );
		if($q->rowCount() > 0) {
	        while($r = $q->fetch(\PDO::FETCH_ASSOC)) {
	        	$option = array( 'id' => $r['courseSecCode'], 'value' => $r['termCode'].'-'.$r['courseSecCode'] );
				$items[] = $option;
	        }
		}
        $data = json_encode($items);
		$response = isset($_GET['callback'])?$_GET['callback']."(".$data.")":$data;
    	echo($response);
    }
    
    public function runReg($data) {
        $this->_sec->Load_from_key($data['courseSecID']);
        $date = date("Y-m-d");
        $time = date("h:m A");
        $bind1 = array( "stuID" => $data['stuID'],"courseSecCode" => $this->_sec->getCourseSecCode(),
                       "termCode" => $this->_sec->getTermCode(),"courseCredits" => $this->_sec->getMinCredit(),
                       "ceu" => $this->_sec->getCEU(),"courseFee" => $this->_sec->getCourseFee(),
                       "labFee" => $this->_sec->getLabFee(),"materialFee" => $this->_sec->getMaterialFee(),
                       "status" => "A","statusDate" => $date,
                       "statusTime" => $time,"addedBy" => $this->_auth->getPersonField('personID') );
       
        $q1 = DB::inst()->insert( "stu_course_sec", $bind1 );
       
        $bind2 = [ 
                "stuID" => $data['stuID'],
                "courseSecCode" => $this->_sec->getCourseSecCode(),"termCode" => $this->_sec->getTermCode(),
                "attCred" => $this->_sec->getMinCredit(),
                "acadLevelCode" => $this->_stuProg->getAcadLevelCode($data['stuID'])
                ];
                    
        $q2 = DB::inst()->insert( "stu_acad_cred", $bind2 );
       
        if(!$q1 && !$q2) {
           redirect( BASE_URL . 'error/save_data/' );
        } else {
           $this->_log->setLog('New Record','Course Registration',$this->_sec->getSecShortTitle(),$this->_uname);
           redirect( BASE_URL . 'success/save_data/' );
        }
    }

    public function runBatchReg($data) {
        $this->_sec->Load_from_key($data['courseSecID']);
        $date = date("Y-m-d");
        $time = date("h:m A");
        
        $bind = [ ":id" => $data['queryID'] ];
        $sql1 = DB::inst()->select("saved_query","savedQueryID = :id","","savedQuery",$bind);
        foreach($sql1 as $row1) {
            $query = $row1['savedQuery'];
        }
        
        $sql2 = DB::inst()->query("$query");
        
        foreach($sql2 as $row2) {
            $bind1 = array( "stuID" => $row2['stuID'],"courseSecCode" => $this->_sec->getCourseSecCode(),
                           	"termCode" => $this->_sec->getTermCode(),"courseCredits" => $this->_sec->getMinCredit(),
                           	"ceu" => $this->_sec->getCEU(),"courseFee" => $this->_sec->getCourseFee(),
                       		"labFee" => $this->_sec->getLabFee(),"materialFee" => $this->_sec->getMaterialFee(),
                       		"status" => "A","statusDate" => $date,
                           	"statusTime" => $time,"addedBy" => $this->_auth->getPersonField('personID') );
           
            $q1 = DB::inst()->insert( "stu_course_sec", $bind1 );
           
            $bind2 = [ 
                    "stuID" => $row2['stuID'],
                    "courseSecCode" => $this->_sec->getCourseSecCode(),"termCode" => $this->_sec->getTermCode(),
                    "attCred" => $this->_sec->getMinCredit(),
                    "acadLevelCode" => $this->_stuProg->getAcadLevelCode($row2['stuID'])
                    ];
                        
            $q2 = DB::inst()->insert( "stu_acad_cred", $bind2 );
        }
        if(!$q1 && !$q2) {
           redirect( BASE_URL . 'error/save_data/' );
        } else {
           $this->_log->setLog('New Record','Batch Course Registration',$this->_sec->getSecShortTitle(),$this->_uname);
           redirect( BASE_URL . 'success/save_data/' );
        }
    }
	
	public function runGrades($data) {
		$stuSize = count($data['stuID']);
		$t = 0;
		while($t < $stuSize) {
			$vars = [ 
					":id" => $data['assignID'],"termCode" => $data['termCode'],
					":SecCode" => $data['courseSecCode'],":facID" => $data['facID'],
					":stuID" => $data['stuID'][$t] 
					];
			$sql = DB::inst()->select("gradebook","assignID = :id AND courseSecCode = :SecCode AND facID = :facID AND stuID = :stuID AND termCode = :termCode","","*",$vars);
			++$t;
		}
		
		if(count($sql) > 0) {
			$size = count($data['stuID']);
			$i = 0;
			while($i < $size) {
				$update = [ "grade" => $data['grade'][$i] ];
				$bind = [ 
						":assignID" => $data['assignID'],":termCode" => $data['termCode'],
                        ":SecCode" => $data['courseSecCode'],":facID" => $data['facID'],
                        ":stuID" => $data['stuID'][$i]
						];
				$q = DB::inst()->update( "gradebook",$update,"assignID = :assignID AND courseSecCode = :SecCode AND facID = :facID AND stuID = :stuID AND termCode = :termCode",$bind );
				++$i;
			}
		} else {
			$size = count($data['stuID']);
			$i = 0;
			while($i < $size) {
				$bind = [ 
						"assignID" => $data['assignID'],"termCode" => $data['termCode'],
						"courseSecCode" => $data['courseSecCode'],"facID" => $data['facID'],
						"stuID" => $data['stuID'][$i],"grade" => $data['grade'][$i],
						"addDate" => $data['addDate'],"addedBy" => $data['addedBy']
						];
				$q = DB::inst()->insert( "gradebook", $bind );
				++$i;
			}
		}
		if(!$q) {
            redirect( BASE_URL . 'error/update_record/' );
        } else {
            $this->_log->setLog('Update Record','Assignment Grades',$data['courseSecID'],$this->_uname);
            redirect( BASE_URL . 'section/grading/' . $data['assignID'] . '/' . bm() );
        }
	}
    
    public function runFinalGrade($data) {
        $size = count($data['stuID']);
        $i = 0;
            while($i < $size) {
                $update = [ 
                            "grade" => $data['grade'][$i],"compCred" => $data['cmplCredit'],
                            "gradePoints" => calculateGradePoints($data['grade'][$i])
                        ];
                
                $bind = [ 
                        ":stuID" => $data['stuID'][$i],":courseSecCode" => $data['courseSecCode'],
                        ":termCode" => $data['termCode']
                        ];
                        
                $q = DB::inst()->update( "stu_acad_cred",
                                $update,
                                "stuID = :stuID 
                            AND 
                                courseSecCode = :courseSecCode 
                            AND 
                                termCode = :termCode",
                            $bind 
                );
            ++$i;
            }
        
        $this->_log->setLog('Update Record','Final Grade',$data['courseSecID'],$this->_uname);
        redirect( $_SERVER['HTTP_REFERER'] );
    }

    public function runAttendance($data) {
        $size = count($data['stuID']);
        $i = 0;
            while($i < $size) {
                $update = [ "status" => $data['status'][$i] ];
                
                $bind = [ 
                        ":stuID" => $data['stuID'][$i],":term" => $data['termCode'],":courseSecCode" => $data['courseSecCode'],
                        ":date" => $data['date']
                        ];
                        
                $q = DB::inst()->update( "attendance",
                                $update,
                                "stuID = :stuID 
                            AND 
                                courseSecCode = :courseSecCode 
                            AND 
                            	termCode = :term 
                            AND 
                                date = :date",
                            $bind 
                );
            ++$i;
            }
        
        if(!$q) {
            redirect( BASE_URL . 'error/update_record/' );
        } else {
            $this->_log->setLog('Update Record','Course Section Attendance',$data['courseSecCode'],$this->_uname);
            redirect( BASE_URL . 'section/attendance/' . $data['courseSecCode'] . '&term=' . $data['termCode'] . '&date=' . $data['date'] );
        }
    }
    
    public function runProgress($data) {
        $bind1 = [ ":id" => $data['stuID'] ];
        $sql = DB::inst()->query( "SELECT 
                        a.email 
                    FROM 
                        person a 
                    LEFT JOIN 
                        parent_child b 
                    ON 
                        a.personID = b.parentID 
                    WHERE 
                        b.childID = :id",
                    $bind1 
        );
        foreach($sql as $r) {
            $array[] = $r;
        }
        
        $date = date("Y-m-d");
        $bind = [ 
                "stuID" => $data['stuID'],"facID" => $this->_auth->getPersonField('personID'),
                "grade" => $data['grade'],"subject" => $data['subject'],"semester" => $data['semester'],
                "behavior" => $data['behavior'],"assignments" => $data['assignments'],
                "notes" => $data['notes'],"courseTitle" => $data['courseTitle'],
                "date" => $date 
                ];
                
        $q = DB::inst()->insert( "progress_report", $bind );
        if(!$q) {
            redirect( BASE_URL . 'error/save_data/' );
        } else {
            $this->_email->et_progress_report($r['email'], $this->_auth->getPersonField('personID'), BASE_URL);
            redirect( BASE_URL . 'success/progress_report/' );
        }
    }
    
    public function runAssignment($data) {
    	$bind = [ 
    			"termCode" => $data['termCode'],
    			"courseSecCode" => $data['courseSecCode'],"facID" => $data['facID'],
    			"shortName" => $data['shortName'],"title" => $data['title'],
    			"dueDate" => $data['dueDate'],"addDate" => $data['addDate'],
    			"addedBy" => $data['addedBy'] 
    			];
		$q = DB::inst()->insert( "assignment", $bind );
		$ID = DB::inst()->lastInsertId('assignID');
		if(!$q) {
            redirect( BASE_URL . 'error/save_data/' );
        } else {
            $this->_log->setLog('New Record','Course Section Assignment',$data['title'],$this->_uname);
            redirect( BASE_URL . 'section/view_assignment/'.$ID.'/'.bm() );
        }
    }
    
    public function runEditAssignment($data) {
    	$update = [ "title" => $data['title'],"dueDate" => $data['dueDate'] ];
		$bind = [ ":id" => $data['ID'] ];
		$q = DB::inst()->update( "assignment", $update, "assignID = :id", $bind );
		redirect( BASE_URL . 'section/view_assignment/'.$data['ID'].'/'.bm() );
    }
    
    public function runBookingInfo($data) {
        $title = $data['title'];
        $text = $data['description'];
        $pID = $this->_auth->getPersonField('personID');
        $roomCode = $data['roomCode'];
        $sDate = $data['startDate'];
        $endDate = $data['endDate'];
        $weekday = date('N',strtotime($sDate));
        $sTime = $data['startTime'];
        $eTime = $data['endTime'];
        $start = $sDate . " " . $sTime;
        $end = $sDate . " " . $eTime;
        $repeats = $data['repeats'];
        $repeatFreq = $data['repeatFreq'];
                
        if(empty($repeats)) {
            $repeat = 0;
            $freq = 0;
            $bind1 = [ 
                    "eventType" => 'Course',"personID" => $pID,
                    "roomCode" => $roomCode,"termCode" => $data['termCode'],
                    "title" => $title,"description" => $text,
                    "weekday" => $weekday,"startDate" => $sDate,
                    "startTime" => $sTime,"endTime" => $eTime,
                    "repeats" => $repeat,"repeatFreq" => $freq,
                    "status" => 'A' 
            ];
            
            $q = DB::inst()->insert( 'event', $bind1 );
            $ID = DB::inst()->lastInsertId('eventID');
            
            $bind2 = [ 
                    "eventID" => $ID,"roomCode" => $roomCode,
                    "personID" => $pID,"start" => $start,
                    "end" => $end,"title" => $title,
                    "description" => $text,
            ];
            
            $q = DB::inst()->insert( 'event_meta', $bind2 );
        } else {
            $startDate = new \DateTime("$sDate");
            $lastDate = new \DateTime("$endDate");
            $days = $lastDate->diff($startDate)->format("%a");
            $limit = $days+1;
            $until = ($limit/$repeatFreq);
            if ($repeatFreq == 1){
                $weekday = 0;
            }
            
            $bind3 = [ 
                    "eventType" => 'Course',"personID" => $pID,
                    "roomCode" => $roomCode,"termCode" => $data['termCode'],
                    "title" => $title,"description" => $text,
                    "weekday" => $weekday,"startDate" => $sDate,
                    "startTime" => $sTime,"endTime" => $eTime,
                    "repeats" => $repeats,"repeatFreq" => $repeatFreq,
                    "status" => 'A'
            ];
            $q = DB::inst()->insert( 'event', $bind3 );
            $ID = DB::inst()->lastInsertId('eventID');
            
            for($x = 0; $x < $until; $x++) {
                $bind4 = [ 
                    "eventID" => $ID,"roomCode" => $roomCode,
                    "personID" => $pID,"start" => $start,
                    "end" => $end,"title" => $title,
                    "description" => $text,
                ];
            $q = DB::inst()->insert( 'event_meta', $bind4 );
            $sDate = strtotime($start . '+' . $repeatFreq . 'DAYS');
            $eDate = strtotime($end . '+' . $repeatFreq . 'DAYS');
            $start = date("Y-m-d H:i", $sDate);
            $end = date("Y-m-d H:i", $eDate);
            }
        }
        redirect( BASE_URL . 'section/booking_info/' . $data['courseSecID'] . '/' . bm() );
    }
    
	public function __destruct() {
		DB::inst()->close();
	}
	
}