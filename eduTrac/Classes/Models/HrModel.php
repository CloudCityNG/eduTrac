<?php namespace eduTrac\Classes\Models;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Human Resources Model
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
 * @since       3.0.2
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */

use \eduTrac\Classes\Core\DB;
use \eduTrac\Classes\Libraries\Util;
class HrModel {
	
	private $_auth;

	public function __construct() {
		$this->_auth = new \eduTrac\Classes\Libraries\Cookies;
	}
    
    public function search() {
        $array = [];
        $staff = isPostSet('employee');
        $bind = [ ":empl" => "%$staff%" ];
        $q = DB::inst()->query( "SELECT 
                        a.staffID,
                        a.office_phone,
                        c.deptName 
                    FROM 
                        staff a 
                    LEFT JOIN 
                        person b 
                    ON 
                        a.staffID = b.personID 
                    LEFT JOIN 
                        department c 
                    ON 
                        a.deptCode = c.deptCode 
                    WHERE 
                        (CONCAT(b.fname,' ',b.lname) LIKE :empl 
                    OR 
                        CONCAT(b.lname,' ',b.fname) LIKE :empl 
                    OR 
                        CONCAT(b.lname,', ',b.fname) LIKE :empl) 
                    OR 
                        a.staffID LIKE :empl",
                    $bind
        );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function employee($id) {
        $array = [];
        $bind = [ ":id" => $id ];
        $q = DB::inst()->query( "SELECT 
                        a.*,
                        b.sMetaID,
                        b.jobStatusCode,
                        b.jobID,
                        b.supervisorID,
                        b.staffType,
                        b.hireDate,
                        b.startDate,
                        b.endDate,
                        c.title,
                        c.hourly_wage,
                        c.weekly_hours,
                        SUM(c.hourly_wage*c.weekly_hours*4) AS Monthly,
                        d.prefix 
                    FROM 
                        staff a 
                    LEFT JOIN 
                        staff_meta b 
                    ON 
                        a.staffID = b.staffID 
                    LEFT JOIN 
                        job c 
                    ON 
                        b.jobID = c.ID 
                    LEFT JOIN 
                    	person d 
                	ON 
                		a.staffID = d.personID 
                    WHERE 
                        a.staffID = :id 
                    AND 
                        b.hireDate = (SELECT MAX(hireDate) FROM staff_meta WHERE staffID = :id)",
                    $bind
        );
        
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
	
	public function grades() {
		$array = [];
		$q = DB::inst()->select('pay_grade');
		foreach($q as $r) {
			$array[] = $r;
		}
		return $array;
	}
	
	public function jobs() {
		$array = [];
		$q = DB::inst()->query( "SELECT 
						a.*,
						b.grade 
					FROM 
						job a 
					LEFT JOIN 
						pay_grade b 
					ON 
						a.pay_grade = b.ID" 
		);
		foreach($q as $r) {
			$array[] = $r;
		}
		return $array;
	}
	
	public function timesheets() {
        $array = [];
        $q = DB::inst()->query( "SELECT 
                        a.employeeID,
                        a.workWeek,
                        SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(a.endDateTime,a.startDateTime)))) AS WorkHours,
                        b.title,
                        b.hourly_wage 
                    FROM 
                        timesheet a 
                    LEFT JOIN 
                        job b 
                    ON 
                        a.jobID = b.ID 
                    GROUP BY 
                        a.employeeID,a.workWeek 
                    ORDER BY 
                        a.workWeek 
                    DESC",
                    $bind 
        );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function viewTimeSheet() {
        $array = [];
        $bind = [ ":week" => isGetSet('week'),":staffID" => isGetSet('staffID') ];
        $q = DB::inst()->query( "SELECT 
                        a.ID,
                        a.employeeID,
                        a.jobID,
                        a.workWeek,
                        a.startDateTime,
                        a.endDateTime,
                        a.note,
                        TIMEDIFF(a.endDateTime,a.startDateTime) AS WorkHours,
                        a.status,
                        b.title 
                    FROM 
                        timesheet a 
                    LEFT JOIN 
                        job b 
                    ON 
                        a.jobID = b.ID 
                    WHERE 
                        a.workWeek = :week 
                    AND 
                        a.employeeID = :staffID 
                    ORDER BY 
                        a.startDateTime",
                    $bind 
        );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function editTSRecord() {
        $array = [];
        $bind = [ ":id" => isGetSet('ID'),":staffID" => isGetSet('staffID') ];
        $q = DB::inst()->query( "SELECT 
                        a.ID,
                        a.employeeID,
                        a.jobID,
                        a.workWeek,
                        a.startDateTime,
                        a.endDateTime,
                        a.note,
                        a.status,
                        b.title 
                    FROM 
                        timesheet a 
                    LEFT JOIN 
                        job b 
                    ON 
                        a.jobID = b.ID 
                    WHERE 
                        a.ID = :id 
                    AND 
                        a.employeeID = :staffID",
                    $bind 
        );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
	
	public function addPosition($id) {
		$array = [];
		$bind = [ ":id" => $id ];
		$q = DB::inst()->select('staff','staffID=:id','','*',$bind);
		foreach($q as $r) {
			$array[] = $r;
		}
		return $array;
	}
	
	public function positions($id) {
		$array = [];
		$bind = [ ":id" => $id ];
		$q = DB::inst()->query( "SELECT 
						a.*,
						b.title,
						b.hourly_wage,
						b.weekly_hours,
						c.grade 
					FROM 
						staff_meta a 
					LEFT JOIN 
						job b 
					ON 
						a.jobID = b.ID 
					LEFT JOIN 
						pay_grade = c 
					ON 
						b.pay_grade = c.ID 
					WHERE 
						a.staffID = :id",
					$bind 
		);
		foreach($q as $r) {
			$array[] = $r;
		}
		return $array;
	}
	
	public function runPayGrade($data) {
		$bind = [ 
				"grade" => $data['grade'],
				"minimum_salary" => $data['minimum_salary'],
				"maximum_salary" => $data['maximum_salary'],
				"addDate" => $data['addDate'],
				"addedBy" => $data['addedBy'] 
				];
		$q = DB::inst()->insert('pay_grade',$bind);
		if(!$q) {
			redirect( BASE_URL . 'error/save_data/' );
		} else {
			redirect( BASE_URL . 'hr/grades/' );
		}
	}
	
	public function runEditPayGrade($data) {
		$update = [ 
				"grade" => Util::_trim($data['grade']),
				"minimum_salary" => $data['minimum_salary'],
				"maximum_salary" => $data['maximum_salary']
				];
		$bind = [ ":id" => $data['ID'] ];
		$q = DB::inst()->update('pay_grade',$update,"ID=:id",$bind);
		if(!$q) {
			redirect( BASE_URL . 'error/save_data/' );
		} else {
			redirect( BASE_URL . 'hr/grades/' );
		}
	}
	
	public function runJobTitle($data) {
		$bind = [ 
				"pay_grade" => Util::_trim($data['pay_grade']),"title" => $data['title'],
				"hourly_wage" => Util::_trim($data['hourly_wage']),"weekly_hours" => $data['weekly_hours'],
				"addDate" => $data['addDate'],"addedBy" => $data['addedBy'] 
				];
		$q = DB::inst()->insert('job',$bind);
		if(!$q) {
			redirect( BASE_URL . 'error/save_data/' );
		} else {
			redirect( BASE_URL . 'hr/jobs/' );
		}
	}
	
	public function runEditJobTitle($data) {
		$update = [ 
				"pay_grade" => Util::_trim($data['pay_grade']),"title" => $data['title'],
				"hourly_wage" => Util::_trim($data['hourly_wage']),"weekly_hours" => $data['weekly_hours']
				];
		$bind = [ ":id" => $data['ID'] ];
		$q = DB::inst()->update("job",$update,"ID=:id",$bind);
		if(!$q) {
			redirect( BASE_URL . 'error/save_data/' );
		} else {
			redirect( BASE_URL . 'hr/jobs/' );
		}
	}
	
	public function runEditEmployee($data) {
		$update1 = [ 
					"schoolCode" => Util::_trim($data['school']),"buildingCode" => Util::_trim($data['building']),
					"officeCode" => Util::_trim($data['office']),"office_phone" => $data['phone'],
					"deptCode" => Util::_trim($data['dept']),"status" => $data['status'] 
					];
		$bind1 = [ ":staff" => $data['staffID'] ];
		$q1 = DB::inst()->update( 'staff',$update1,'staffID=:staff',$bind1 );
		
		$update2 = [ 
					"jobStatusCode" => Util::_trim($data['jobStatus']),"jobID" => $data['job'],
					"supervisorID" => $data['supervisor'],"staffType" => $data['type'],
					"hireDate" => $data['hire'],"startDate" => $data['start'],
					"endDate" => $data['end'] 
					];
		$bind2 = [ ":id" => $data['meta'],":staff" => $data['staffID'] ];
		$q2 = DB::inst()->update( 'staff_meta',$update2,'sMetaID=:id AND staffID=:staff',$bind2 );
		
		if(!$q1 && !$q2) {
			redirect( BASE_URL . 'error/save_data/' );
		} else {
			redirect( BASE_URL . 'hr/view/' . $data['staffID'] . '/' . bm() );
		}
	}
	
	public function runPosition($data) {
		$bind = [ 
				"jobStatusCode" => Util::_trim($data['jobStatus']),"jobID" => $data['job'],
				"supervisorID" => $data['supervisor'],"staffType" => $data['type'],
				"hireDate" => $data['hire'],"startDate" => $data['start'],
				"endDate" => $data['end'],"addDate" => $data['addDate'],
				"approvedBy" => $data['approvedBy'],"staffID" => $data['staffID']
				];
		$q = DB::inst()->insert('staff_meta',$bind);
		if(!$q) {
			redirect( BASE_URL . 'error/save_data/' );
		} else {
			redirect( BASE_URL . 'hr/view/' . $data['staffID'] . '/' . bm() );
		}
	}
	
	public function runEditPosition($data) {
		$update = [ 
				"jobStatusCode" => $data['jobStatus'],"jobID" => $data['job'],
				"supervisorID" => $data['supervisor'],"staffType" => $data['type'],
				"hireDate" => $data['hire'],"startDate" => $data['start'],
				"endDate" => $data['end']
				];
		$bind = [ ":id" => $data['meta'],":staff" => $data['staffID'] ];
		$q = DB::inst()->update('staff_meta',$update,'sMetaID=:id AND staffID=:staff',$bind);
		if(!$q) {
			redirect( BASE_URL . 'error/save_data/' );
		} else {
			redirect( BASE_URL . 'hr/positions/' . $data['staffID'] . '/' . bm() );
		}
	}
    
    public function runTimeSheet($data) {        
        $size = count($data['ID']);
        $i = 0;
        while($i < $size) {
            $array = [];
            $bind1 = [ ":id" => $data['ID'][$i] ];
            $q = DB::inst()->select( "timesheet","ID=:id","","*",$bind1 );
            foreach($q as $r) {
                $array[] = $r;
            }
        
            $update1 = [ "status" => $data['status'][$i],"approvedBy" => $this->_auth->getPersonField('personID') ];
            $update2 = [ "status" => $data['status'][$i] ];
            $bind2 = [ ":id" => $data['ID'][$i],":staff" => $data['employeeID'] ];
            if($r['approvedBy'][$i] == '00000000' && $data['status'][$i] == 'A') {
                $q = DB::inst()->update("timesheet",$update1,"ID=:id AND employeeID=:staff",$bind2);
            } else {
                $q = DB::inst()->update("timesheet",$update2,"ID=:id AND employeeID=:staff",$bind2);
            }
            ++$i;
        }
        if(!$q) {
            redirect( BASE_URL . 'error/save_data/' );
        } else {
            redirect( $_SERVER['HTTP_REFERER'] );
        }
    }
    
    public function runEditTimeSheet($data) {
        $update = [ 
                    "workWeek" => $data['workWeek'],"startDateTime" => $data['startDateTime'],
                    "endDateTime" => $data['endDateTime'],"note" => $data['note'] 
                  ];
        $bind = [ ":id" => $data['ID'] ];
        $q = DB::inst()->update( "timesheet",$update,"ID=:id",$bind );
        if(!$q) {
            redirect( BASE_URL . 'error/save_data/' );
        } else {
            redirect( $_SERVER['HTTP_REFERER'] );
        }
    }
    
    public function __destruct() {
        DB::inst()->close();
    }

}