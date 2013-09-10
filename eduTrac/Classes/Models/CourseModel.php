<?php namespace eduTrac\Classes\Models;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Course Model
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
use \eduTrac\Classes\DBObjects\Subject;
class CourseModel {
    
    private $_subj;
	
	public function __construct() {
        $this->_subj = new Subject;
	}
	
	public function search() {
		$crse = isGetSet('crse');
        $bind = array( ":crse" => "%$crse%" );
        $q = DB::inst()->select( "course",
                    "courseCode LIKE :crse",
                    "courseID",
                    "courseID,
                    courseCode,
                    courseShortTitle,
                    currStatus,
                    startDate,
                    endDate",
                    $bind 
        );
        
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
	}
    
    public function runCourse($data) {
        $this->_subj->Load_from_key($data['subjectID']);
        $cc = $this->_subj->getSubjCode().'-'.$data['courseNumber'];
        
        $bind = array( 
            "courseNumber" => $data['courseNumber'],"courseCode" => $cc,"subjectID" => $data['subjectID'],
            "deptID" => $data['deptID'],"courseDesc" => $data['courseDesc'],
            "minCredit" => $data['minCredit'],"courseLevelCode" => $data['courseLevelCode'],
            "acadLevelCode" => $data['acadLevelCode'],"courseShortTitle" => $data['courseShortTitle'],"courseLongTitle" => $data['courseLongTitle'],
            "startDate" => $data['startDate'],"endDate" => $data['endDate'],"currStatus" => $data['currStatus'],"statusDate" => $data['statusDate'],
            "approvedDate" => $data['approvedDate'],"approvedBy" => $data['approvedBy']
        );
        
        $q = DB::inst()->insert( "course", $bind );
           
        $ID = DB::inst()->lastInsertId('courseID');
        
        if(!$q) {
            redirect( BASE_URL . 'error/save_data/' );
        } else {
            redirect( BASE_URL . 'course/view/' . $ID . '/' . bm() );
        }
    
    }
    
    public function runEditCourse($data) {
        $this->_subj->Load_from_key($data['subjectID']);
        $bind = array( ":id" => $data['courseID'] );
        $sql = DB::inst()->select( "course","courseID = :id","","currStatus",$bind );
        foreach($sql as $r) {
            $array[] = $r;
        }
        
        $cc = $this->_subj->getSubjCode().'-'.$data['courseNumber'];
        $bind = array( ":courseID" => $data['courseID'] );
        $statusDate = date("Y-m-d");
        
        $update1 = array( 
            "courseNumber" => $data['courseNumber'],"courseCode" => $cc,"subjectID" => $data['subjectID'],
            "deptID" => $data['deptID'],"courseDesc" => $data['courseDesc'],
            "minCredit" => $data['minCredit'],"courseLevelCode" => $data['courseLevelCode'],
            "acadLevelCode" => $data['acadLevelCode'],"courseShortTitle" => $data['courseShortTitle'],"courseLongTitle" => $data['courseLongTitle'],
            "startDate" => $data['startDate'],"endDate" => $data['endDate'],"currStatus" => $data['currStatus']
        );
        
        $update2 = array( "statusDate" => $statusDate );
        
        $q = DB::inst()->update( "course", $update1, "courseID = :courseID", $bind );
        
        if($r['currStatus'] != $data['currStatus']) {
            DB::inst()->update( "course", $update2, "courseID = :courseID", $bind );
        }
        redirect( BASE_URL . 'course/view/' . $data['courseID'] . '/' . bm() );
    }
    
    public function runAddnl($data) {        
        $update = array( 
            "preReq" => $data['preReq'],"allowAudit" => $data['allowAudit'],"allowWaitlist" => $data['allowWaitlist'],
            "minEnroll" => $data['minEnroll'],"seatCap" => $data['seatCap']
        );
        
        $bind = array( ":courseID" => $data['courseID'] );
        
        $q = DB::inst()->update( "course", $update, "courseID = :courseID", $bind );
        redirect( BASE_URL . 'course/addnl_info/' . $data['courseID'] . '/' . bm() );
    }
    
    public function crse($id) {
        $bind = array( ":id" => $id );
        $q = DB::inst()->query( "SELECT 
                a.courseID,a.courseNumber,a.courseCode,a.subjectID,a.deptID,a.courseDesc,a.minCredit,
                a.courseLevelCode,a.acadLevelCode,a.courseShortTitle,a.courseLongTitle,a.preReq,a.allowAudit,a.allowWaitlist,
                a.minEnroll,a.seatCap,a.startDate,a.endDate,a.currStatus,a.statusDate,a.approvedDate,a.LastUpdate,b.fname,
                b.lname,c.subjectID 
            FROM 
                course a 
            LEFT JOIN 
                person b 
            ON 
                a.approvedBy = b.personID
            LEFT JOIN 
                subject c 
            ON 
                a.subjectID = c.subjectID 
            WHERE 
                courseID = :id",
            $bind
        );
        
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
        $bind = array( ":id" => $id );
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
    
    public function deleteCourse($id) {
        $q = DB::inst()->delete( "course", "courseID = '$id'" );
        
        if($q) {
            redirect( BASE_URL . 'success/delete_record/' );
        } else {
            redirect( BASE_URL . 'error/delete_record/');
        }
    }
    
	public function __destruct() {
		DB::inst()->close();
	}
	
}