<?php namespace tinyPHP\Classes\Models;
/**
 *
 * Student Model
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
 * @since eduTrac(tm) v 1.0.0
 * @package Model
 */

if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');

use \tinyPHP\Classes\Core\DB;
class StudentModel {
    
    private $_stuProg;
	
	public function __construct() {
	    $this->_stuProg = new \tinyPHP\Classes\DBObjects\StuProgram;
	}
	
	public function search() {
		$stu = isPostSet('student');
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
                        (CONCAT(fname,' ',lname) LIKE '%".$stu."%' 
                    OR 
                        CONCAT(lname,' ',fname) LIKE '%".$stu."%' 
                    OR 
                        CONCAT(lname,', ',fname) LIKE '%".$stu."%') 
                    OR 
                        a.stuID LIKE '%".$stu."%'"
        );
        
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
	}
    
    public function runStudent($data) {        
        $bind1 = array( 
            "stuID" => $data['stuID'],"advisorID" => $data['advisorID'],"catYear" => $data['catYear'],
            "antGradDate" => $data['antGradDate'],"acadLevelCode" => $data['acadLevelCode'],
            "addDate" => $data['addDate'],"approvedBy" => $data['approvedBy']
        );
        
        $bind2 = array( 
            "stuID" => $data['stuID'],"progCode" => $data['progCode'],
            "currStatus" => "A","statusDate" => $data['addDate'],
            "startDate" => $data['startDate'],"approvedBy" => $data['approvedBy']
        );
        
        $q1 = DB::inst()->insert( "student", $bind1 );
        $q2 = DB::inst()->insert( "stu_program", $bind2 );
        $ID = DB::inst()->lastInsertId('stuID');
        
        if(!$q1 && !$q2) {
            redirect( BASE_URL . 'error/save_data/' );
        } else {
            redirect( BASE_URL . 'student/view/' . $ID . '/' . bm() );
        }
    
    }
    
    public function runEditStudent($data) {
        $update = array( 
            "advisorID" => $data['advisorID'],"catYear" => $data['catYear'],
            "antGradDate" => $data['antGradDate'],"acadLevelCode" => $data['acadLevelCode']
        );
        
        $bind = array( ":stuID" => $data['stuID'] );
        
        $q = DB::inst()->update( "student", $update, "stuID = :stuID", $bind );
        redirect( BASE_URL . 'student/view/' . $data['stuID'] . '/' . bm() );
    }
    
    public function getPerson($id) {
        $bind = array( ":id" => $id );
        $q = DB::inst()->select( "person","personID = :id","","*",$bind );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function getStudent($id) {
        $bind = array( ":id" => $id );
        $q = DB::inst()->select( "student","stuID = :id","","*",$bind );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function student($id) {
        $bind = array( ":id" => $id );
        $q = DB::inst()->query( "SELECT 
                a.stuID,
                a.advisorID,
                a.catYear,
                a.antGradDate,
                a.acadLevelCode,
                b.address1,
                b.address2,
                b.city,
                b.state,
                b.zip 
            FROM 
                student a 
            LEFT JOIN 
                address b 
            ON 
                a.stuID = b.personID
            WHERE 
                a.stuID = :id 
            AND 
                addressStatus = 'C' 
            AND 
                (b.endDate = '' OR b.endDate = '0000-00-00')",
            $bind
        );
        
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function prog($id) {
        $bind = array( ":id" => $id );
        $q = DB::inst()->query( "SELECT 
                    a.stuProgID,
                    a.stuID,
                    a.progCode,
                    a.currStatus,
                    a.statusDate,
                    a.startDate,
                    a.approvedBy,
                    b.acadLevelCode AS progAcadLevel,
                    b.locationCode 
                FROM 
                    stu_program a 
                LEFT JOIN 
                    acad_program b 
                ON 
                    a.progCode = b.acadProgCode 
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
        $bind = array( ":id" => $id );
        $q = DB::inst()->query( "SELECT 
                    b.stuProgID,
                    b.stuID,
                    b.progCode,
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
                    a.acadProgCode = b.progCode 
                LEFT JOIN 
                    school c 
                ON 
                    a.schoolCode = c.schoolCode 
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
        $bind = array( ":id" => $id );
        $q = DB::inst()->query( "SELECT 
                        a.id,
                        a.stuID,
                        a.courseSecCode,
                        a.termCode,
                        a.courseCredits,
                        a.ceu,
                        a.grade,
                        a.status,
                        b.secShortTitle 
                    FROM 
                        stu_course_sec a 
                    LEFT JOIN 
                        course_sec b 
                    ON 
                        a.courseSecCode = b.courseSecCode 
                    WHERE 
                        a.stuID = :id",
                    $bind 
        );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function viewAcadCred($id) {
        $bind = array( ":id" => $id );
        $q = DB::inst()->query( "SELECT 
                        a.courseSecID,
                        a.sectionNumber,
                        a.secShortTitle,
                        a.startDate,
                        a.endDate,
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
                        d.grade 
                    FROM 
                        course_sec a 
                    LEFT JOIN 
                        course b 
                    ON 
                        a.courseID = b.courseID 
                    LEFT JOIN 
                        term c 
                    ON 
                        a.termCode = c.termCode 
                    LEFT JOIN 
                        stu_course_sec d 
                    ON 
                        a.courseSecCode = d.courseSecCode 
                    WHERE 
                        d.id = :id",
                    $bind 
        );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function runProgLookup($data) {
        $bind = array(":code" => $data['progCode']);
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
                    a.majorCode = b.majorCode 
                LEFT JOIN 
                    location c 
                ON 
                    a.locationCode = c.locationCode 
                LEFT JOIN 
                    school d 
                ON 
                    a.schoolCode = d.schoolCode 
                WHERE 
                    a.acadProgCode = :code 
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
                        "#majorName" => $v['majorName'],"#schoolName" => $v['schoolCode'].' '.$v['schoolName'] 
                        );
        }
        echo json_encode($json);
    }
    
    public function runStuProg($data) {
        $bind = array( "stuID" => $data['stuID'],"progCode" => $data['progCode'],
                       "currStatus" => $data['currStatus'],"statusDate" => $data['startDate'],
                       "startDate" => $data['startDate'],"endDate" => $data['endDate'],
                       "approvedBy" => $data['approvedBy'] 
        );
        
        $q = DB::inst()->insert( "stu_program", $bind );
        redirect( BASE_URL . 'student/view/' . $data['stuID'] . '/' . bm() );
    }
    
    public function runEditStuProg($data) {
        $this->_stuProg->Load_from_key($data['stuProgID']);
        $status = $this->_stuProg->getCurrStatus();
        $date = date("Y-m-d");
        
        $update1 = array( "currStatus" => $data['currStatus'],"startDate" => $data['startDate'],
                        "endDate" => $data['endDate'] 
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
            redirect( BASE_URL . 'error/save_data/' );
        }
    }
    
    public function runAcadCred($data) {
        $update = array( "status" => $data['status'],"statusDate" => $data['statusDate'],
                        "statusTime" => $data['statusTime'],"grade" => $data['grade'] 
        );
        
        $bind = array( ":id" => $data['id'], ":stuID" => $data['stuID'] );
        $q = DB::inst()->update( "stu_course_sec", $update, "id = :id AND stuID = :stuID", $bind );
        redirect( BASE_URL . 'student/view_academic_credits/' . $data['id'] . '/' . bm() );
    }
    
	public function __destruct() {
		DB::inst()->close();
	}
	
}