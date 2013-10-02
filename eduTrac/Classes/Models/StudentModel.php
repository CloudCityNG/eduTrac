<?php namespace eduTrac\Classes\Models;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Student Model
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
class StudentModel {
    
    private $_stuProg;
    private $_auth;
    private $_log;
	
	public function __construct() {
	    $this->_stuProg = new \eduTrac\Classes\DBObjects\StuProgram;
        $this->_auth = new \eduTrac\Classes\Libraries\Cookies;
        $this->_log = new \eduTrac\Classes\Libraries\Log;
	}
	
	public function search() {
        $array = [];
		$stu = isPostSet('student');
        $bind = [ ":stu" => "%$stu%" ];
        $q = DB::inst()->query( "SELECT 
                        a.stuID,
                        b.lname,
                        b.fname 
                    FROM 
                        student a 
                    LEFT JOIN 
                        person b 
                    ON 
                        a.stuID = b.personID 
                    LEFT JOIN 
                        graduate c 
                    ON 
                        a.stuID = c.gradID 
                    WHERE 
                        (CONCAT(fname,' ',lname) LIKE :stu 
                    OR 
                        CONCAT(lname,' ',fname) LIKE :stu 
                    OR 
                        CONCAT(lname,', ',fname) LIKE :stu) 
                    OR 
                        a.stuID LIKE :stu",
                    $bind
        );
        
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
	}
    
    public function runStudent($data) {
        $date = date("Y-m-d");
        $bind1 = array( 
            "stuID" => $data['stuID'],"advisorID" => $data['advisorID'],"catYearID" => $data['catYearID'],
            "acadLevelCode" => $data['acadLevelCode'],"status" => $data['status'],
            "addDate" => $data['addDate'],"approvedBy" => $data['approvedBy']
        );
        
        $bind2 = array( 
            "stuID" => $data['stuID'],"progID" => $data['progID'],
            "currStatus" => "A","statusDate" => $data['addDate'],
            "startDate" => $data['startDate'],"approvedBy" => $data['approvedBy'],
            "antGradDate" => $data['antGradDate'],
        );
        
        $q1 = DB::inst()->insert( "student", $bind1 );
        $ID = DB::inst()->lastInsertId('stuID');
        $q2 = DB::inst()->insert( "stu_program", $bind2 );
        
        $bind3 = [ 
                "stuID" => $data['stuID'],"acadProgID" => $data['progID'],
                "acadLevelCode" => $data['acadLevelCode'],"addDate" => $date 
                ];
                
        $q2 = DB::inst()->insert( "stu_acad_level", $bind3 );
        
        if(!$q1 && !$q2 && !$q3) {
            redirect( BASE_URL . 'error/save_data/' );
        } else {
            $this->_log->setLog('New Record','Student',get_name($data['stuID']));
            redirect( BASE_URL . 'student/view/' . $ID . '/' . bm() );
        }
    
    }
    
    public function runEditStudent($data) {
        $update = array( 
            "advisorID" => $data['advisorID'],"catYearID" => $data['catYearID'],
            "acadLevelCode" => $data['acadLevelCode'],"status" => $data['status']
        );
        
        $bind = array( ":stuID" => $data['stuID'] );
        
        $q = DB::inst()->update( "student", $update, "stuID = :stuID", $bind );
        $this->_log->setLog('Update Record','Student',get_name($data['stuID']));
        redirect( BASE_URL . 'student/view/' . $data['stuID'] . '/' . bm() );
    }
    
    public function getAppl($id) {
        $array = [];
        $bind = array( ":id" => $id );
        $q = DB::inst()->query( "SELECT 
                    a.acadProgID,
                    a.acadProgCode,
                    a.acadProgTitle,
                    a.acadLevelCode,
                    b.majorName,
                    c.locationName,
                    d.schoolName,
                    e.personID 
                FROM 
                    acad_program a 
                LEFT JOIN 
                    major b 
                ON 
                    a.majorID = b.majorID 
                LEFT JOIN 
                    location c 
                ON 
                    a.locationID = c.locationID 
                LEFT JOIN 
                    school d 
                ON 
                    a.schoolID = d.schoolID 
                LEFT JOIN 
                    application e 
                ON 
                    a.acadProgID = e.acadProgID 
                WHERE 
                    e.personID = :id",
                $bind 
        );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function getStudent($id) {
        $array = [];
        $bind = array( ":id" => $id );
        $q = DB::inst()->select( "student","stuID = :id","","*",$bind );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function student($id) {
        $array = [];
        $bind = array( ":id" => $id );
        $q = DB::inst()->query( "SELECT 
                stuID,
                advisorID,
                catYearID,
                acadLevelCode,
                status 
            FROM 
                student 
            WHERE 
                stuID = :id",
            $bind
        );
        
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function admit($id) {
        $array = [];
        $bind = [ ":id" => $id ];
        
        $q = DB::inst()->select( "application","personID = :id","","admitStatus",$bind );
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
    
    public function prog($id) {
        $array = [];
        $bind = array( ":id" => $id );
        $q = DB::inst()->query( "SELECT 
                    a.stuProgID,
                    a.stuID,
                    a.progID,
                    a.currStatus,
                    a.statusDate,
                    a.startDate,
                    a.approvedBy,
                    b.acadProgCode,
                    b.acadLevelCode AS progAcadLevel,
                    b.locationID 
                FROM 
                    stu_program a 
                LEFT JOIN 
                    acad_program b 
                ON 
                    a.progID = b.acadProgID 
                WHERE 
                    a.stuID = :id 
                ORDER BY 
                    statusDate",
                $bind 
        );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function stuProg($id) {
        $array = [];
        $bind = array( ":id" => $id );
        $q = DB::inst()->query( "SELECT 
                    a.acadProgCode,
                    b.stuProgID,
                    b.eligible_to_graduate,
                    b.graduationDate,
                    b.antGradDate,
                    b.stuID,
                    b.currStatus,
                    b.statusDate,
                    b.startDate,
                    b.endDate,
                    b.approvedBy,
                    c.schoolCode,
                    c.schoolName 
                FROM 
                    acad_program a 
                LEFT JOIN 
                    stu_program b 
                ON 
                    a.acadProgID = b.progID 
                LEFT JOIN 
                    school c 
                ON 
                    a.schoolID = c.schoolID 
                WHERE 
                    b.stuProgID = :id",
                $bind 
        );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function acadCred($id) {
        $array = [];
        $bind = array( ":id" => $id );
        $q = DB::inst()->query( "SELECT 
                        a.id,
                        a.stuID,
                        a.courseCredits,
                        a.ceu,
                        a.status,
                        b.grade,
                        c.courseSecCode,
                        c.secShortTitle,
                        d.termCode 
                    FROM 
                        stu_course_sec a 
                    LEFT JOIN 
                        stu_acad_cred b 
                    ON 
                        a.courseSecID = b.courseSecID 
                    LEFT JOIN 
                        course_sec c 
                    ON 
                        a.courseSecID = c.courseSecID 
                    LEFT JOIN 
                        term d 
                    ON 
                        a.termID = d.termID 
                    WHERE 
                        a.stuID = :id 
                    AND 
                        a.termID = b.termID",
                    $bind 
        );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function viewAcadCred($id) {
        $array = [];
        $bind = array( ":id" => $id );
        $q = DB::inst()->query( "SELECT 
                        a.courseSecID,
                        a.sectionNumber,
                        a.secShortTitle,
                        a.startDate,
                        a.endDate,
                        a.termID,
                        b.courseID,
                        b.courseCode,
                        b.acadLevelCode,
                        c.termCode,
                        c.reportingTerm,
                        d.id,
                        d.stuID,
                        d.status,
                        d.statusDate,
                        d.statusTime,
                        e.grade,
                        f.deptCode,
                        g.subjCode 
                    FROM 
                        course_sec a 
                    LEFT JOIN 
                        course b 
                    ON 
                        a.courseID = b.courseID 
                    LEFT JOIN 
                        term c 
                    ON 
                        a.termID = c.termID 
                    LEFT JOIN 
                        stu_course_sec d 
                    ON 
                        a.courseSecID = d.courseSecID 
                    LEFT JOIN 
                        stu_acad_cred e 
                    ON 
                        a.courseSecID = e.courseSecID 
                    LEFT JOIN 
                        department f 
                    ON 
                        a.deptID = f.deptID 
                    LEFT JOIN 
                        subject g 
                    ON 
                        b.subjectID = g.subjectID 
                    WHERE 
                        d.id = :id 
                    AND 
                        a.termID = e.termID",
                    $bind 
        );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function courseSec() {
        $array = [];
        $bind = [ ":term" => Hooks::get_option('current_term_id') ];
        $q = DB::inst()->query( "SELECT 
                    a.courseSecID,
                    a.courseSecCode,
                    a.secShortTitle,
                    a.dotw,
                    a.startTime,
                    a.endTime,
                    a.minCredit,
                    a.termID,
                    a.minCredit,
                    b.locationName 
                FROM 
                    course_sec a 
                LEFT JOIN 
                    location b 
                ON 
                    a.locationID = b.locationID 
                WHERE 
                    a.currStatus = 'A' 
                AND 
                    a.stuReg = '1' 
                AND 
                    a.termID = :term",
                $bind 
        );
                    
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function schedule() {
        $array = [];
        $bind = [ 
                ":term" => Hooks::get_option('current_term_id'),
                ":stuID" => $this->_auth->getPersonField('personID')
                ];
                
        $q = DB::inst()->query( "SELECT 
                    a.courseSecCode,
                    a.secShortTitle,
                    a.startTime,
                    a.endTime,
                    a.dotw,
                    a.facID,
                    b.buildingName,
                    c.roomNumber,
                    d.stuID 
                FROM 
                    course_sec a 
                LEFT JOIN 
                    building b 
                ON 
                    a.buildingID = b.buildingID 
                LEFT JOIN 
                    room c 
                ON 
                    a.roomID = c.roomID 
                LEFT JOIN 
                    stu_course_sec d 
                ON 
                    a.courseSecID = d.courseSecID 
                WHERE 
                    a.termID = :term 
                AND 
                    d.stuID = :stuID",
                $bind
        );
        
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function grades() {
        $array = [];
        $bind = [ ":stuID" => $this->_auth->getPersonField('personID') ];
        $q = DB::inst()->query( "SELECT 
                        a.stuID,
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
                        a.stuID = :stuID",
                    $bind
        );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function runProgLookup($data) {
        $bind = array(":id" => $data['progID']);
        $q = DB::inst()->query( "SELECT 
                    a.acadProgTitle,
                    b.majorName,
                    c.locationName,
                    d.schoolCode,
                    d.schoolName 
                FROM 
                    acad_program a 
                LEFT JOIN 
                    major b 
                ON 
                    a.majorID = b.majorID 
                LEFT JOIN 
                    location c 
                ON 
                    a.locationID = c.locationID 
                LEFT JOIN 
                    school d 
                ON 
                    a.schoolID = d.schoolID 
                WHERE 
                    a.acadProgID = :id 
                AND 
                    a.currStatus = 'A' 
                AND 
                    (a.endDate = '' 
                OR 
                    a.endDate = '0000-00-00')",
                $bind
        );
        foreach($q as $k => $v) {
            $json = array( 
                        '#acadProgTitle' => $v['acadProgTitle'],'#locationName' => $v['locationName'],
                        "#majorName" => $v['majorName'],"#schoolName" => $v['schoolID'].' '.$v['schoolName'] 
                        );
        }
        echo json_encode($json);
    }
    
    public function runStuProg($data) {
        $bind = array( "stuID" => $data['stuID'],"progID" => $data['progID'],
                       "currStatus" => $data['currStatus'],"statusDate" => $data['startDate'],
                       "startDate" => $data['startDate'],"endDate" => $data['endDate'],
                       "approvedBy" => $data['approvedBy'],"antGradDate" => $data['antGradDate']
        );
        
        $q = DB::inst()->insert( "stu_program", $bind );
        $this->_log->setLog('New Record','Student Academic Program',get_name($data['stuID']));
        redirect( BASE_URL . 'student/view/' . $data['stuID'] . '/' . bm() );
    }
    
    public function runEditStuProg($data) {
        $this->_stuProg->Load_from_key($data['stuProgID']);
        $status = $this->_stuProg->getCurrStatus();
        $date = date("Y-m-d");
        
        $update1 = array( "currStatus" => $data['currStatus'],"startDate" => $data['startDate'],
                        "endDate" => $data['endDate'],"eligible_to_graduate" => $data['eligible_to_graduate'],
                        "antGradDate" => $data['antGradDate']
        );
        
        $update2 = array( "statusDate" => $date );
        
        $bind = array( ":stuID" => $data['stuID'], ":stuProgID" => $data['stuProgID'] );
        $q = DB::inst()->update( "stu_program", $update1, "stuID = :stuID AND stuProgID = :stuProgID", $bind );
        if($q) {
            if($status != $data['currStatus']) {
                DB::inst()->update( "stu_program", $update2, "stuID = :stuID AND stuProgID = :stuProgID", $bind );
            }
            redirect( BASE_URL . 'student/view_prog/' . $data['stuProgID'] . '/' . bm() );
        } else {
            $this->_log->setLog('Update Record','Student Academic Program',get_name($data['stuID']));
            redirect( BASE_URL . 'error/save_data/' );
        }
    }
    
    public function runAcadCred($data) {
        $date = date("Y-m-d");
        $time = date("h:m A");
        
        $update1 = [ "status" => $data['status'],"statusDate" => $data['statusDate'],
                        "statusTime" => $data['statusTime']
        ];
        $update2 = [ "gradePoints" => calculateGradePoints($data['grade']),"grade" => $data['grade']  ];
        $update3 = array( "status" => $data['status'],"statusDate" => $date,"statusTime" => $time );
        $update4 = array( "grade" => 'W', "compCred" => '0.0' );
        
        $bind1 = array( ":id" => $data['id'], ":stuID" => $data['stuID'] );
        $bind2 = [ 
                ":stuID" => $data['stuID'], ":courseSecID" => $data['courseSecID'],
                ":termID" => $data['termID']
                ]; 
        $bind3 = [ ":termID" => Hooks::get_option('current_term_id') ];
        
        $sql = DB::inst()->select( "term","termID = :termID","","termStartDate,dropAddEndDate",$bind3 );
        foreach($sql as $r) {
            $array[] = $r;
        }
        
        /**
         * If the posted status is 'W' or 'D' and today's date is less than the 
         * primary term start date, then delete all student course sec as well as 
         * student acad cred records.
         */
        if(($data['currStatus'] == 'W' || $data['currStatus'] == 'D') && $date < $r['termStartDate']) {
            DB::inst()->delete('stu_course_sec','stuID = :stuID AND courseSecID = :courseSecID AND termID = :termID',$bind2);
            DB::inst()->delete('stu_acad_cred','stuID = :stuID AND courseSecID = :courseSecID AND termID = :termID',$bind2);
        }
        /**
         * If posted status is 'W' or 'D' and today's date is greater than equal to the 
         * primary term start date, and today's date is less than the term's drop/add 
         * end date, then delete all student course sec as well as student acad cred 
         * records.
         */
        elseif(($data['currStatus'] == 'W' || $data['currStatus'] == 'D') && $date >= $r['termStartDate'] && $date < $r['dropAddEndDate']) {
            DB::inst()->delete('stu_course_sec','stuID = :stuID AND courseSecID = :courseSecID AND termID = :termID',$bind2);
            DB::inst()->delete('stu_acad_cred','stuID = :stuID AND courseSecID = :courseSecID AND termID = :termID',$bind2);
        }
        /**
         * If posted status is 'W' or 'D' and today's date is greater than equal to the 
         * primary term start date, and today's date is greater than the term's drop/add 
         * end date, then update student course sec record with a 'W' status and update  
         * student acad record with a 'W' grade and 0.0 completed credits.
         */
        elseif(($data['currStatus'] == 'W' || $data['currStatus'] == 'D') && $date >= $r['termStartDate'] && $date > $r['dropAddEndDate']) {
            DB::inst()->update('stu_course_sec',$update3,'stuID = :stuID AND courseSecID = :courseSecID AND termID = :termID',$bind2);
            DB::inst()->update('stu_acad_cred',$update4,'stuID = :stuID AND courseSecID = :courseSecID AND termID = :termID',$bind2);
        }
        /**
         * If the status is different from 'W', update the status and status date.
         */
        else {
            DB::inst()->update( "stu_course_sec", $update1, "id = :id AND stuID = :stuID", $bind1 );  
            DB::inst()->update("stu_acad_cred",$update2,"stuID = :stuID AND courseSecID = :courseSecID AND termID = :termID",$bind2);
        }
        $this->_log->setLog('Update Record','Academic Credits',get_name($data['stuID']));    
        redirect( BASE_URL . 'student/view_academic_credits/' . $data['id'] . '/' . bm() );
    }
    
    public function runRegister($data) {
        $size = count($data['courseSecID']);
        $i = 0;
        while($i < $size) {
            $date = date("Y-m-d");
            $time = date("h:m A");
            $bind1 = [ 
                    "stuID" => $this->_auth->getPersonField('personID'),
                    "courseSecID" => $data['courseSecID'][$i],"termID" => $data['termID'][$i],
                    "courseCredits" => $data['courseCredits'][$i],"status" => 'N',
                    "statusDate" => $date,"statusTime" => $time,
                    "addedBy" => $this->_auth->getPersonField('personID')
                    ];
                    
            $q1 = DB::inst()->insert( "stu_course_sec", $bind1 );
            
            $bind2 = [ 
                    "stuID" => $this->_auth->getPersonField('personID'),
                    "courseSecID" => $data['courseSecID'][$i],"termID" => $data['termID'][$i],
                    "attCred" => $data['courseCredits'][$i],
                    "acadLevelCode" => $this->_stuProg->getAcadLevelCode($this->_auth->getPersonField('personID'))
                    ];
                    
            $q2 = DB::inst()->insert( "stu_acad_cred", $bind2 );
            ++$i;
        }
        
        if(!$q1 && !$q2) {
            redirect( BASE_URL . 'error/course_registration/' );
        } else {
            redirect( BASE_URL . 'success/course_registration/' );
        }
    }
    
    public function runGraduation($data) {
        if(!empty($data['studentID'])) {
            $date = date("Y-m-d");
            $update = [ 
                        "statusDate" => $date,"endDate" => $date,"currStatus" => 'G',
                        "graduationDate" => $data['gradDate']
                      ];
            $bind = [ ":stuID" => $data['studentID'],":etg" => '1' ];
            $q = DB::inst()->update("stu_program",$update,"stuID = :stuID AND eligible_to_graduate = :etg",$bind);
            if(!$q) {
                redirect( BASE_URL . 'error/update_record/' );
            } else {
                redirect( BASE_URL . 'success/update_record/' );
            }
        } else {
            $bind = [ "queryID" => $data['queryID'],"gradDate" => $data['gradDate'] ];
            $q = DB::inst()->insert( "graduation_hold", $bind );
            if(!$q) {
                redirect( BASE_URL . 'error/save_data/' );
            } else {
                $this->_log->setLog('Update Record','Graduation',get_name($data['stuID']));
                redirect( BASE_URL . 'success/save_data/' );
            }
        }
    }
    
    public function tranStuInfo() {
        $array = [];
        $stuID = isGetSet('studentID');
        $tranType = isGetSet('acadLevelCode');
        $bind = [ ":stuID" => $stuID,":acadLevelCode" => $tranType ];
        $q = DB::inst()->query( "SELECT 
                        CASE a.acadLevelCode 
                        WHEN 'UG' THEN 'Undergraduate' 
                        WHEN 'GR' THEN 'Graduate' 
                        ELSE 'Continuing Education' 
                        END AS 'Level',
                        a.stuID,
                        b.address1,
                        b.address2,
                        b.city,
                        b.state,
                        b.zip,
                        c.ssn,
                        c.dob 
                    FROM 
                        stu_acad_cred a 
                    LEFT JOIN 
                        address b 
                    ON 
                        a.stuID = b.personID 
                    LEFT JOIN 
                        person c 
                    ON 
                        a.stuID = c.personID 
                    WHERE 
                        a.stuID = :stuID 
                    AND
                       a.acadLevelCode = :acadLevelCode 
                    AND 
                        b.addressStatus = 'C' 
                    AND 
                        b.addressType = 'P'",
                    $bind
        );
        foreach($q as $r) {
            $array[] = $r;
        }

        return $array;    }
    
    public function tranCourse() {
        $array = [];
        $stuID = isGetSet('studentID');
        $tranType = isGetSet('acadLevelCode');
        $bind = [ ":stuID" => $stuID, ":acadLevelCode" => $tranType ];
        $q = DB::inst()->query( "SELECT 
                        a.compCred AS acadCompCred,
                        a.attCred AS acadAttCred,
                        a.grade,
                        a.gradePoints AS acadGradePoints,
                        b.secShortTitle,
                        b.courseSecCode,
                        b.startDate,
                        b.endDate,
                        c.attCred AS termAttCred,
                        c.compCred AS termCompCred,
                        c.gradePoints AS termGradePoints,
                        c.termID,
                        c.termGPA,
                        d.termCode 
                    FROM 
                        stu_acad_cred a 
                    LEFT JOIN 
                        course_sec b 
                    ON 
                        a.courseSecID = b.courseSecID 
                    LEFT JOIN 
                        stu_term_gpa c
                    ON 
                        a.termID = c.termID 
                    LEFT JOIN 
                        term d 
                    ON 
                        a.termID = d.termID 
                    WHERE 
                        a.stuID = :stuID 
                    AND 
                        a.acadLevelCode = :acadLevelCode 
                    GROUP BY 
                        c.termID",
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