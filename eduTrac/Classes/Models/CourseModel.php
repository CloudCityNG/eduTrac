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
 * @since       3.0.0
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */

use \eduTrac\Classes\Core\DB;
use \eduTrac\Classes\DBObjects\Subject;
use \eduTrac\Classes\Libraries\Util;
class CourseModel {
    
    private $_subj;
    private $_log;
    private $_auth;
    private $_uname;
	
	public function __construct() {
        $this->_subj = new Subject;
        $this->_log = new \eduTrac\Classes\Libraries\Log;
        $this->_auth = new \eduTrac\Classes\Libraries\Cookies;
        $this->_uname = $this->_auth->getPersonField('uname');
	}
	
	public function search() {
        $array = [];
		$crse = isPostSet('crse');
        $bind = array( ":crse" => "%$crse%" );
        $q = DB::inst()->select( "course",
                    "courseCode LIKE :crse",
                    "courseCode",
                    "CASE currStatus 
                    WHEN 'A' THEN 'Active' 
                    WHEN 'I' THEN 'Inactive' 
                    WHEN 'P' THEN 'Pending' 
                    ELSE 'Obsolete' 
                    END AS 'Status',
                    currStatus,
                    courseID,
                    courseCode,
                    courseShortTitle,
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
        $cc = $data['subjectCode'].'-'.$data['courseNumber'];
        
        $bind = array( 
            "courseNumber" => Util::_trim($data['courseNumber']),"courseCode" => Util::_trim($cc),"subjectCode" => Util::_trim($data['subjectCode']),
            "deptCode" => Util::_trim($data['deptCode']),"courseDesc" => $data['courseDesc'],
            "minCredit" => $data['minCredit'],"courseLevelCode" => Util::_trim($data['courseLevelCode']),
            "acadLevelCode" => Util::_trim($data['acadLevelCode']),"courseShortTitle" => $data['courseShortTitle'],"courseLongTitle" => $data['courseLongTitle'],
            "startDate" => $data['startDate'],"endDate" => $data['endDate'],"currStatus" => $data['currStatus'],"statusDate" => $data['statusDate'],
            "approvedDate" => $data['approvedDate'],"approvedBy" => $data['approvedBy']
        );
        
        $q = DB::inst()->insert( "course", $bind );
           
        $ID = DB::inst()->lastInsertId('courseID');
        
        if(!$q) {
            redirect( BASE_URL . 'error/save_data/' );
        } else {
            $this->_log->setLog('New Record','Course',$data['courseShortTitle'],$this->_uname);
            redirect( BASE_URL . 'course/view/' . $ID . '/' . bm() );
        }
    
    }
    
    public function runEditCourse($data) {
        $array = [];
        $bind = array( ":id" => $data['courseID'] );
        $sql = DB::inst()->select( "course","courseID = :id","","currStatus",$bind );
        foreach($sql as $r) {
            $array[] = $r;
        }
        
        $cc = $data['subjectCode'].'-'.$data['courseNumber'];
        $bind = array( ":courseID" => $data['courseID'] );
        $statusDate = date("Y-m-d");
        
        $update1 = array( 
            "courseNumber" => Util::_trim($data['courseNumber']),"courseCode" => Util::_trim($cc),"subjectCode" => Util::_trim($data['subjectCode']),
            "deptCode" => Util::_trim($data['deptCode']),"courseDesc" => $data['courseDesc'],
            "minCredit" => $data['minCredit'],"courseLevelCode" => Util::_trim($data['courseLevelCode']),
            "acadLevelCode" => Util::_trim($data['acadLevelCode']),"courseShortTitle" => $data['courseShortTitle'],"courseLongTitle" => $data['courseLongTitle'],
            "startDate" => $data['startDate'],"endDate" => $data['endDate'],"currStatus" => $data['currStatus']
        );
        
        $update2 = array( "statusDate" => $statusDate );
        
        $q = DB::inst()->update( "course", $update1, "courseID = :courseID", $bind );
        
        if($r['currStatus'] != $data['currStatus']) {
            DB::inst()->update( "course", $update2, "courseID = :courseID", $bind );
        }
        $this->_log->setLog('Update Record','Course',$data['courseShortTitle'],$this->_uname);
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
        $array = [];
        $bind = array( ":id" => $id );
        $q = DB::inst()->query( "SELECT 
                a.courseID,a.courseNumber,a.courseCode,a.subjectCode,a.deptCode,a.courseDesc,a.minCredit,
                a.courseLevelCode,a.acadLevelCode,a.courseShortTitle,a.courseLongTitle,a.preReq,a.allowAudit,a.allowWaitlist,
                a.minEnroll,a.seatCap,a.startDate,a.endDate,a.currStatus,a.statusDate,a.approvedDate,a.approvedBy,a.LastUpdate,b.fname,
                b.lname 
            FROM 
                course a 
            LEFT JOIN 
                person b 
            ON 
                a.approvedBy = b.personID
            LEFT JOIN 
                subject c 
            ON 
                a.subjectCode = c.subjectCode 
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