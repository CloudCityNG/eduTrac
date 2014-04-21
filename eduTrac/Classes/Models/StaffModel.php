<?php namespace eduTrac\Classes\Models;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Staff Model
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
class StaffModel {
    
    private $_log;
    private $_auth;
    private $_uname;
	
	public function __construct() {
	    $this->_log = new \eduTrac\Classes\Libraries\Log;
        $this->_auth = new \eduTrac\Classes\Libraries\Cookies;
        $this->_uname = $this->_auth->getPersonField('uname');
	}
	
	public function search() {
        $array = [];
		$staff = isPostSet('staff');
        $bind = [ ":staff" => "%$staff%" ];
        $q = DB::inst()->query( "SELECT 
                        a.staffID,
                        b.lname,
                        b.fname 
                    FROM 
                        staff a 
                    LEFT JOIN 
                        person b 
                    ON 
                        a.staffID = b.personID 
                    WHERE 
                        (CONCAT(fname,' ',lname) LIKE :staff 
                    OR 
                        CONCAT(lname,' ',fname) LIKE :staff 
                    OR 
                        CONCAT(lname,', ',fname) LIKE :staff) 
                    OR 
                        a.staffID LIKE :staff",
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
        $q = DB::inst()->query( "SELECT 
                        a.personID,
                        a.personType 
                    FROM 
                        person a 
                    LEFT JOIN 
                        staff b 
                    ON 
                        a.personID = b.staffID 
                    WHERE 
                        a.personID = :id 
                    AND 
                        b.staffID IS NULL",
                    $bind 
        );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function timesheets() {
        $array = [];
        $bind = [ ":id" => $this->_auth->getPersonField('personID') ];
        $q = DB::inst()->query( "SELECT 
                        a.workWeek,
                        SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(a.endDateTime,a.startDateTime)))) AS WorkHours,
                        b.title 
                    FROM 
                        timesheet a 
                    LEFT JOIN 
                        job b 
                    ON 
                        a.jobID = b.ID 
                    WHERE 
                        a.employeeID = :id 
                    GROUP BY 
                        a.workWeek",
                    $bind 
        );
        /*$q = DB::inst()->query( "SELECT 
                        CASE a.status 
                        WHEN 'P' THEN 'Pending' 
                        WHEN 'R' THEN 'Rejected' 
                        ELSE 'Approved' 
                        END AS 'Status',
                        a.ID,
                        a.employeeID,
                        a.jobID,
                        a.workWeek,
                        a.startDateTime,
                        a.endDateTime,
                        a.note,
                        TIMEDIFF(a.endDateTime,a.startDateTime) AS WorkHours,
                        b.title 
                    FROM 
                        timesheet a 
                    LEFT JOIN 
                        job b 
                    ON 
                        a.jobID = b.ID 
                    WHERE 
                        a.employeeID = :id 
                    GROUP BY 
                        a.ID 
                    ORDER BY 
                        a.workWeek",
                    $bind 
        );*/
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function viewTimeSheet($week) {
        $array = [];
        $bind = [ ":week" => $week,":staffID" => $this->_auth->getPersonField('personID') ];
        $q = DB::inst()->query( "SELECT 
                        CASE status 
                        WHEN 'P' THEN 'Pending' 
                        WHEN 'R' THEN 'Rejected' 
                        ELSE 'Approved' 
                        END AS 'Status',
                        ID,
                        employeeID,
                        jobID,
                        workWeek,
                        startDateTime,
                        endDateTime,
                        note,
                        TIMEDIFF(endDateTime,startDateTime) AS WorkHours 
                    FROM 
                        timesheet 
                    WHERE 
                        workWeek = :week 
                    AND
                        employeeID = :staffID 
                    GROUP BY 
                        ID",
                    $bind 
        );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function staff($id) {
        $array = [];
        $bind = array( ":id" => $id );
        $q = DB::inst()->select( "staff","staffID = :id","","*",$bind );
        
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function staffAddr($id) {
        $array = [];
        $bind = array( ":id" => $id );
        $q = DB::inst()->query( "SELECT 
                        * 
                    FROM 
                        address a 
                    LEFT JOIN 
                        staff b 
                    ON 
                        a.personID = b.staffID 
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
    
    public function runStaff($data) {        
        $bind1 = array( 
            "staffID" => $data['staffID'],"schoolCode" => $data['schoolCode'],
            "buildingCode" => $data['buildingCode'],"officeCode" => $data['officeCode'],
            "office_phone" => $data['office_phone'],"deptCode" => $data['deptCode'],
			"status" => $data['status'],"addDate" => $data['addDate'],
			"approvedBy" => $data['approvedBy']
        );
        
        $bind2 = array( 
            "staffID" => $data['staffID'],"supervisorID" => $data['supervisorID'],
            "jobStatusCode" => $data['jobStatusCode'],"jobID" => $data['jobID'],
            "staffType" => $data['staffType'],"hireDate" => $data['hireDate'],
            "startDate" => $data['startDate'],"endDate" => $data['endDate'],
            "addDate" => $data['addDate'],"approvedBy" => $data['approvedBy']
        );
        
        $q1 = DB::inst()->insert( "staff", $bind1 );
        $q2 = DB::inst()->insert( "staff_meta", $bind2 );
        
        if(!$q1 && !$q2) {
            redirect( BASE_URL . 'error/save_data/' );
        } else {
            $this->_log->setLog('New Record','Staff',get_name($data['staffID']),$this->_uname);
            redirect( BASE_URL . 'staff/view/' . $data['staffID'] . '/' . bm() );
        }
    
    }
    
    public function runEditStaff($data) {
        $update = array( 
            "buildingCode" => $data['buildingCode'],
            "officeCode" => $data['officeCode'],"office_phone" => $data['office_phone'],
            "deptCode" => $data['deptCode'],"status" => $data['status'],
            "schoolCode" => $data['schoolCode']
        );
        
        $bind = array( ":staffID" => $data['staffID'] );
        
        $q = DB::inst()->update( "staff", $update, "staffID = :staffID", $bind );
        $this->_log->setLog('Update Record','Staff',get_name($data['staffID']),$this->_uname);
        redirect( BASE_URL . 'staff/view/' . $data['staffID'] . '/' . bm() );
    }
    
    public function runTimeSheets($data) {
        $bind = [ 
                "employeeID" => $data['employeeID'],"jobID" => $data['jobID'],
                "startDateTime" => $data['startDateTime'],"endDateTime" => $data['endDateTime'],
                "note" => $data['note'],"addDate" => $data['addDate'],
                "workWeek" => $data['workWeek'],"addedBy" => $data['addedBy'] 
                ];
        $q = DB::inst()->insert('timesheet',$bind);
        if(!$q) {
            redirect( BASE_URL . 'error/save_data/' );
        } else {
            redirect( BASE_URL . 'staff/view_timesheet/' . $data['workWeek'] . '/' . bm() );
        }
    }
    
	public function __destruct() {
		DB::inst()->close();
	}
	
}