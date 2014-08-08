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
 * @since       3.0.0
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */

use \eduTrac\Classes\Core\DB;
use \eduTrac\Classes\Libraries\Hooks;
use \eduTrac\Classes\Libraries\Util;
class StudentModel {
    
    private $_stuProg;
    private $_auth;
    private $_log;
    private $_acadProg;
    private $_uname;
    private $_email;
	
	public function __construct() {
	    $this->_stuProg = new \eduTrac\Classes\DBObjects\StuProgram;
        $this->_auth = new \eduTrac\Classes\Libraries\Cookies;
        $this->_log = new \eduTrac\Classes\Libraries\Log;
        $this->_acadProg = new \eduTrac\Classes\DBObjects\AcadProgram;
        $this->_uname = $this->_auth->getPersonField('uname');
        $this->_email = new \eduTrac\Classes\Libraries\Email;
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
            "stuID" => $data['stuID'],"status" => $data['status'],
            "addDate" => $data['addDate'],"approvedBy" => $data['approvedBy']
        );
        
        $bind2 = array( 
            "stuID" => $data['stuID'],"advisorID" => $data['advisorID'],
            "catYearCode" => Util::_trim($data['catYearCode']),"acadProgCode" => Util::_trim($data['acadProgCode']),
            "currStatus" => "A","statusDate" => $data['addDate'],
            "startDate" => $data['startDate'],"approvedBy" => $data['approvedBy'],
            "antGradDate" => $data['antGradDate'],
        );
        
        $q1 = DB::inst()->insert( "student", $bind1 );
        $q2 = DB::inst()->insert( "stu_program", $bind2 );
        
        $bind3 = [ 
                "stuID" => $data['stuID'],"acadProgCode" => Util::_trim($data['acadProgCode']),
                "acadLevelCode" => Util::_trim($data['acadLevelCode']),"addDate" => $date 
                ];
                
        $q3 = DB::inst()->insert( "stu_acad_level", $bind3 );
        
        if(!$q1 && !$q2 && !$q3) {
            redirect( BASE_URL . 'error/save_data/' );
        } else {
            $this->_log->setLog('New Record','Student',get_name($data['stuID']),$this->_uname);
            redirect( BASE_URL . 'student/view/' . $data['stuID'] . '/' . bm() );
        }
    
    }
    
    public function runEditStudent($data) {
        $update = array( 
            "advisorID" => $data['advisorID'],"catYearCode" => Util::_trim($data['catYearCode']),
            "acadLevelCode" => Util::_trim($data['acadLevelCode']),"status" => $data['status']
        );
        
        $bind = array( ":stuID" => $data['stuID'] );
        
        $q = DB::inst()->update( "student", $update, "stuID = :stuID", $bind );
        $this->_log->setLog('Update Record','Student',get_name($data['stuID']),$this->_uname);
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
                    e.personID,
                    e.startTerm 
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
                LEFT JOIN 
                    application e 
                ON 
                    a.acadProgCode = e.acadProgCode 
                LEFT JOIN 
                    student f 
                ON 
                    e.personID = f.stuID 
                WHERE 
                    e.personID = :id 
                AND 
                    f.stuID IS NULL",
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
    
    public function rstr($id) {
        $array = [];
        $bind = [ ":id" => $id ];
        $q = DB::inst()->query( "SELECT 
                        a.*,
                        b.deptCode 
                    FROM 
                        restriction a 
                    LEFT JOIN 
                        restriction_code b 
                    ON 
                        a.rstrCode = b.rstrCode 
                    WHERE 
                        a.stuID = :id 
                    ORDER BY 
                        a.rstrID",
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
                    a.acadProgCode,
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
                    a.acadProgCode = b.acadProgCode 
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
                    a.schoolCode,
                    a.acadLevelCode,
                    b.stuProgID,
                    b.eligible_to_graduate,
                    b.graduationDate,
                    b.antGradDate,
                    b.stuID,
                    b.advisorID,
                    b.catYearCode,
                    b.currStatus,
                    b.statusDate,
                    b.startDate,
                    b.endDate,
                    b.approvedBy,
                    b.LastUpdate,
                    c.schoolName 
                FROM 
                    acad_program a 
                LEFT JOIN 
                    stu_program b 
                ON 
                    a.acadProgCode = b.acadProgCode 
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
        $array = [];
        $bind = array( ":id" => $id );
        $q = DB::inst()->query( "SELECT 
                        a.id,
                        a.stuID,
                        a.courseCredits,
                        a.ceu,
                        a.status,
                        a.termCode,
                        a.courseSecCode,
                        b.grade,
                        c.secShortTitle 
                    FROM 
                        stu_course_sec a 
                    LEFT JOIN 
                        stu_acad_cred b 
                    ON 
                        a.courseSecCode = b.courseSecCode 
                    LEFT JOIN 
                        course_sec c 
                    ON 
                        a.courseSecCode = c.courseSecCode 
                    WHERE 
                        a.stuID = :id 
                    AND 
                    	a.stuID = b.stuID 
                    AND 
                        a.termCode = b.termCode 
                    AND 
                    	a.termCode = c.termCode 
                    GROUP BY 
                    	a.stuID,a.courseSecCode,a.termCode",
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
                        a.termCode,
                        a.courseCode,
                        a.deptCode,
                        b.courseID,
                        b.acadLevelCode,
                        b.subjectCode,
                        c.reportingTerm,
                        d.id,
                        d.stuID,
                        d.courseSecCode,
                        d.status,
                        d.statusDate,
                        d.statusTime,
                        e.grade 
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
                    LEFT JOIN 
                        stu_acad_cred e 
                    ON 
                        a.courseSecCode = e.courseSecCode 
                    WHERE 
                        d.id = :id 
                    AND 
                        a.termCode = d.termCode 
                    AND 
                    	a.termCode = e.termCode 
                    AND 
                    	d.stuID = e.stuID",
                    $bind 
        );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function courseSec() {
        $array = [];
        $terms = Hooks::{'get_option'}('open_terms');
        $q = DB::inst()->query( "SELECT 
                    a.courseSecID,
                    a.courseSecCode,
                    a.secShortTitle,
                    a.dotw,
                    a.startTime,
                    a.endTime,
                    a.minCredit,
                    a.termCode,
                    a.courseFee,
                    a.labFee,
                    a.materialFee,
                    a.facID,
                    a.comment,
                    b.locationName,
                    c.courseDesc 
                FROM 
                    course_sec a 
                LEFT JOIN 
                    location b 
                ON 
                    a.locationCode = b.locationCode 
                LEFT JOIN 
                	course c 
            	ON 
            		a.courseID = c.courseID 
                WHERE 
                    a.currStatus = 'A' 
                AND 
                    a.stuReg = '1' 
                AND 
                    a.termCode IN (".$terms.")"
        );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function term() {
        $array = [];
        $bind = [ ":stuID" => $this->_auth->getPersonField('personID') ];
                
        $q = DB::inst()->query( "SELECT 
                    stuID,
                    termCode,
                    COUNT(termCode) AS Courses 
                FROM 
                    stu_acad_cred  
                WHERE 
                    stuID = :stuID 
                GROUP BY 
                    termCode",
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
                ":term" => isGetSet('term'),
                ":stuID" => $this->_auth->getPersonField('personID')
                ];
                
        $q = DB::inst()->query( "SELECT 
                    a.courseSecID,
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
                    a.buildingCode = b.buildingCode 
                LEFT JOIN 
                    room c 
                ON 
                    a.roomCode = c.roomCode 
                LEFT JOIN 
                    stu_course_sec d 
                ON 
                    a.courseSecCode = d.courseSecCode 
                WHERE 
                    a.termCode = :term 
                AND 
                    d.stuID = :stuID 
                AND 
                	d.termCode = :term 
            	AND 
            		d.status IN('A','N') 
                GROUP BY 
                    d.stuID,d.termCode,d.courseSecCode",
                $bind
        );
        
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function gradesAssign($code) {
    	$array = [];
    	$bind = [ ":code" => $code, "term" => isGetSet('term') ];
    	$q = DB::inst()->query( "SELECT 
    					a.*,
    					b.courseSecID,
    					b.secShortTitle,
    					c.termCode 
					FROM  
						assignment a 
					LEFT JOIN 
						course_sec b 
					ON 
						a.courseSecCode = b.courseSecCode 
					LEFT JOIN 
						term c 
					ON 
						b.termCode = c.termCode 
					WHERE 
						a.courseSecCode = :code 
					AND 
					   a.termCode = :term 
					GROUP BY 
						a.title",
					$bind 
		);
    	foreach($q as $r) {
    		$array[] = $r;
    	}
    	return $array;
    }
    
    public function gradesStu($code) {
		$array = [];
		$bind = [ ":code" => $code,":user" => $this->_auth->getPersonField('personID'), "term" => isGetSet('term') ];
		$q = DB::inst()->query( "SELECT 
						* 
					FROM 
						gradebook 
					WHERE 
						courseSecCode = :code 
					AND 
						stuID = :user 
					AND 
					   termCode = :term 
					GROUP BY 
						stuID",
					$bind 
		);
		foreach($q as $r) {
			$array[] = $r;
		}
		return $array;
	}
    
    public function finalGrades() {
        $array = [];
        $bind = [ ":stuID" => $this->_auth->getPersonField('personID') ];
        $q = DB::inst()->query( "SELECT 
                        a.stuID,
                        a.grade,
                        a.termCode,
                        b.courseSecCode,
                        b.secShortTitle 
                    FROM 
                        stu_acad_cred a 
                    LEFT JOIN 
                        course_sec b 
                    ON 
                        a.courseSecCode = b.courseSecCode 
                    WHERE 
                        a.stuID = :stuID 
                    AND 
                    	a.termCode = b.termCode 
                    GROUP BY 
                    	a.termCode,a.courseSecCode",
                    $bind
        );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function myBill() {
        $array = [];
        $bind = [ ":stuID" => $this->_auth->getPersonField('personID') ];
        
        $q = DB::inst()->query( "SELECT ID,stuID,termCode 
                FROM 
                    bill 
                WHERE 
                    stuID = :stuID 
                GROUP BY 
                    stuID,termCode",
                $bind
        );
        
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function bill($id) {
        $array = [];
        $bind = [ ":stuID" => $id,":termCode" => isGetSet('termCode'), ":user" => $this->_auth->getPersonField('personID') ];
        $q = DB::inst()->query( "SELECT 
                        a.ID AS 'FeeID',
                        a.stuID,
                        b.name,
                        b.amount,
                        c.ID AS 'BillID',
                        c.termCode,
                        c.comment,
                        c.dateTime,
                        d.termName 
                    FROM 
                        student_fee a 
                    LEFT JOIN 
                        billing_table b 
                    ON 
                        a.feeID = b.ID 
                    LEFT JOIN 
                        bill c 
                    ON 
                        a.stuID = c.stuID 
                    LEFT JOIN 
                        term d 
                    ON 
                        c.termCode = d.termCode 
                    WHERE 
                        a.stuID = :stuID 
                    AND 
                        c.termCode = :termCode 
                    AND 
                        a.billID = c.ID 
                    AND 
                        a.stuID = :user",
                    $bind 
        );
        
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function beginBalance($id) {
        $array = [];
        $bind = [ ":stuID" => $id, ":termCode" => isGetSet('termCode') ];
        $q = DB::inst()->query( "SELECT 
                        SUM(b.amount) 
                    FROM 
                        student_fee a 
                    LEFT JOIN 
                        billing_table b 
                    ON 
                        a.feeID = b.ID 
                    LEFT JOIN 
                        bill c 
                    ON 
                        a.billID = c.ID 
                    WHERE 
                        a.stuID = c.stuID 
                    AND 
                        c.stuID = :stuID 
                    AND 
                        c.termCode = :termCode 
                    GROUP BY 
                        c.stuID,c.termCode",
                    $bind 
        );
        foreach($q as $r) {
            $array[] = money_format('-%n', $r['SUM(b.amount)']);
        }
        
        return $array;
    }
    
    public function courseFees($id) {
        $array = [];
        $bind = [ ":stuID" => $id, ":termCode" => isGetSet('termCode') ];
        
        $q = DB::inst()->query( "SELECT 
                        COALESCE(SUM(courseFee+labFee+materialFee),0) AS 'CourseFees' 
                    FROM 
                        stu_course_sec 
                    WHERE 
                        stuID = :stuID 
                    AND 
                        termCode = :termCode 
                    AND 
                    	status <> 'C'",
                    $bind 
        );
        
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function sumPayments($id) {
        $array = [];
        $bind = [ ":stuID" => $id, ":termCode" => isGetSet('termCode') ];
        
        $q = DB::inst()->query( "SELECT 
                        SUM(amount) 
                    FROM 
                        payment 
                    WHERE 
                        stuID = :stuID 
                    AND 
                        termCode = :termCode 
                    GROUP BY 
                        stuID,termCode",
                    $bind 
        );
        
        foreach($q as $r) {
            $array[] = $r['SUM(amount)'];
        }
        
        return $array;
    }
    
    public function sumRefund($id) {
        $array = [];
        $bind = [ ":stuID" => $id, ":termCode" => isGetSet('termCode') ];
        
        $q = DB::inst()->query( "SELECT 
                        SUM(amount) 
                    FROM 
                        refund 
                    WHERE 
                        stuID = :stuID 
                    AND 
                        termCode = :termCode 
                    GROUP BY 
                        stuID,termCode",
                    $bind 
        );
        
        foreach($q as $r) {
            $array[] = $r['SUM(amount)'];
        }
        
        return $array;
    }
    
    public function payment($id) {
        $array = [];
        $bind = [ ":stuID" => $id,":termCode" => isGetSet('termCode') ];
        $q = DB::inst()->query( "SELECT 
                        a.ID AS 'paymentID',
                        a.amount,
                        a.comment,
                        a.dateTime,
                        c.type 
                    FROM 
                        payment a 
                    LEFT JOIN 
                        bill b 
                    ON 
                        a.stuID = b.stuID 
                    LEFT JOIN 
                        payment_type c 
                    ON 
                        a.paymentTypeID = c.ptID 
                    WHERE 
                        a.termCode = b.termCode 
                    AND 
                        a.stuID = :stuID 
                    AND 
                        a.termCode = :termCode",
                    $bind 
        );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function refund($id) {
        $array = [];
        $bind = [ ":stuID" => $id,":termCode" => isGetSet('termCode') ];
        $q = DB::inst()->query( "SELECT 
                        a.ID AS 'refundID',
                        a.amount,
                        a.comment,
                        a.dateTime 
                    FROM 
                        refund a 
                    LEFT JOIN 
                        bill b 
                    ON 
                        a.stuID = b.stuID 
                    WHERE 
                        a.termCode = b.termCode 
                    AND 
                        a.stuID = :stuID 
                    AND 
                        a.termCode = :termCode",
                    $bind 
        );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function runProgLookup($data) {
        $bind = array(":id" => $data['acadProgCode']);
        $q = DB::inst()->query( "SELECT 
                    a.acadProgTitle,
                    a.acadLevelCode,
                    a.schoolCode,
                    b.majorName,
                    c.locationName,
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
                    a.acadProgCode = :id 
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
                        "#majorName" => $v['majorName'],"#schoolName" => $v['schoolCode'].' '.$v['schoolName'],
                        "#acadLevelCode" => $v['acadLevelCode'] 
                        );
        }
        echo json_encode($json);
    }
    
    public function runStuProg($data) {
        $this->_acadProg->Load_from_key($data['acadProgCode']);
        $date = date('Y-m-d');
        $bind1 = array( "stuID" => $data['stuID'],"acadProgCode" => Util::_trim($data['acadProgCode']),
                       "currStatus" => $data['currStatus'],"statusDate" => $data['startDate'],
                       "startDate" => $data['startDate'],"endDate" => $data['endDate'],
                       "approvedBy" => $data['approvedBy'],"antGradDate" => $data['antGradDate'],
                       "advisorID" => $data['advisorID'],"catYearCode" => Util::_trim($data['catYearCode'])
        );
        
        $bind2 = [ ":stuID" => $data['stuID'],":acadProgCode" => $data['acadProgCode'] ];
        
        $bind3 = [ 
                "stuID" => $data['stuID'],"acadProgCode" => Util::_trim($data['acadProgCode']),
                "acadLevelCode" => $this->_acadProg->getAcadLevelCode(),"addDate" => $date 
                ];
        
        $q1 = DB::inst()->insert( "stu_program", $bind1 );
        $q2 = DB::inst()->select( "stu_acad_level","stuID = :stuID AND acadProgCode = :acadProgCode","","*",$bind2 );
        if(count($q2) <= 0) {
            $q3 = DB::inst()->insert( "stu_acad_level", $bind3 );
        }
        
        $this->_log->setLog('New Record','Student Academic Program',get_name($data['stuID']),$this->_uname);
        redirect( BASE_URL . 'student/view/' . $data['stuID'] . '/' . bm() );
    }
    
    public function runEditStuProg($data) {
        $this->_stuProg->Load_from_key($data['stuProgID']);
        $status = $this->_stuProg->getCurrStatus();
        $date = date("Y-m-d");
        
        $update1 = array( "currStatus" => $data['currStatus'],"startDate" => $data['startDate'],
                        "endDate" => $data['endDate'],"eligible_to_graduate" => $data['eligible_to_graduate'],
                        "antGradDate" => $data['antGradDate'],"advisorID" => $data['advisorID'],
                        "catYearCode" => Util::_trim($data['catYearCode'])
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
            $this->_log->setLog('Update Record','Student Academic Program',get_name($data['stuID']),$this->_uname);
            redirect( BASE_URL . 'error/save_data/' );
        }
    }
    
    public function runAcadCred($data) {
    	$array = [];
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
                ":stuID" => $data['stuID'], ":courseSecCode" => Util::_trim($data['courseSecCode']),
                ":termCode" => Util::_trim($data['termCode'])
                ]; 
        $bind3 = [ ":termCode" => Util::_trim($data['termCode']) ];
        
        $sql = DB::inst()->select( "term","termCode = :termCode","","termStartDate,dropAddEndDate",$bind3 );
        foreach($sql as $r) {
            $array[] = $r;
        }
        
        /**
         * If the posted status is 'W' or 'D' and today's date is less than the 
         * primary term start date, then delete all student course sec as well as 
         * student acad cred records.
         */
        if(($data['status'] == 'W' || $data['status'] == 'D') && $date < $r['termStartDate']) {
            DB::inst()->delete('stu_course_sec','stuID = :stuID AND courseSecCode = :courseSecCode AND termCode = :termCode',$bind2);
            DB::inst()->delete('stu_acad_cred','stuID = :stuID AND courseSecCode = :courseSecCode AND termCode = :termCode',$bind2);
        }
        /**
         * If posted status is 'W' or 'D' and today's date is greater than equal to the 
         * primary term start date, and today's date is less than the term's drop/add 
         * end date, then delete all student course sec as well as student acad cred 
         * records.
         */
        elseif(($data['status'] == 'W' || $data['status'] == 'D') && $date >= $r['termStartDate'] && $date < $r['dropAddEndDate']) {
            DB::inst()->delete('stu_course_sec','stuID = :stuID AND courseSecCode = :courseSecCode AND termCode = :termCode',$bind2);
            DB::inst()->delete('stu_acad_cred','stuID = :stuID AND courseSecCode = :courseSecCode AND termCode = :termCode',$bind2);
        }
        /**
         * If posted status is 'W' or 'D' and today's date is greater than equal to the 
         * primary term start date, and today's date is greater than the term's drop/add 
         * end date, then update student course sec record with a 'W' status and update  
         * student acad record with a 'W' grade and 0.0 completed credits.
         */
        elseif(($data['status'] == 'W' || $data['status'] == 'D') && $date >= $r['termStartDate'] && $date > $r['dropAddEndDate']) {
            DB::inst()->update('stu_course_sec',$update3,'stuID = :stuID AND courseSecCode = :courseSecCode AND termCode = :termCode',$bind2);
            DB::inst()->update('stu_acad_cred',$update4,'stuID = :stuID AND courseSecCode = :courseSecCode AND termCode = :termCode',$bind2);
        }
        /**
         * If the status is different from 'W', update the status and status date.
         */
        else {
            DB::inst()->update( "stu_course_sec", $update1, "id = :id AND stuID = :stuID", $bind1 );  
            DB::inst()->update("stu_acad_cred",$update2,"stuID = :stuID AND courseSecCode = :courseSecCode AND termCode = :termCode",$bind2);
        }
        $this->_log->setLog('Update Record','Academic Credits',get_name($data['stuID']),$this->_uname);  
        redirect( BASE_URL . 'student/academic_credits/' . $data['stuID'] . '/' . bm() );
    }
    
    public function runRegister($data) {
        /**
         * Checks to see how many courses the student has already registered 
         * for the requested semester. If the student has already registered for 
         * courses, then count them and add it to the number they are trying to 
         * register for. If that number is greater than the number_of_courses 
         * restriction, then redirect the student to a error page, otherwise 
         * let the registration go through.
         */
        $params = [ ":stuID" => $this->_auth->getPersonField('personID'),":term" => Util::_trim($data['termCode']) ];
        $q = DB::inst()->select('stu_course_sec','stuID=:stuID AND termCode=:term AND status IN("A","N")','','*',$params);
        if(bcadd(count($q),count($data['courseSecCode'])) > Hooks::{'get_option'}('number_of_courses')) {
            redirect( BASE_URL . 'error/registration/' );
            exit();
        }
        $size = count($data['courseSecCode']);
        $i = 0;
        while($i < $size) {
            $date = date("Y-m-d");
            $time = date("h:m A");
            $bind1 = [ 
                    "stuID" => $this->_auth->getPersonField('personID'),
                    "courseSecCode" => Util::_trim($data['courseSecCode'][$i]),"termCode" => Util::_trim($data['termCode'][$i]),
                    "courseCredits" => Util::_trim($data['courseCredits'][$i]),"status" => 'N',
                    "courseFee" => $data['courseFee'][$i],
                   	"labFee" => $data['labFee'][$i],"materialFee" => $data['materialFee'][$i],
                    "statusDate" => $date,"statusTime" => $time,
                    "addedBy" => $this->_auth->getPersonField('personID')
                    ];
                    
            $q1 = DB::inst()->insert( "stu_course_sec", $bind1 );
            
            $bind2 = [ 
                    "stuID" => $this->_auth->getPersonField('personID'),
                    "courseSecCode" => Util::_trim($data['courseSecCode'][$i]),"termCode" => Util::_trim($data['termCode'][$i]),
                    "attCred" => Util::_trim($data['courseCredits'][$i]),
                    "acadLevelCode" => $this->_stuProg->getAcadLevelCode($this->_auth->getPersonField('personID'))
                    ];
                    
            $q2 = DB::inst()->insert( "stu_acad_cred", $bind2 );
            ++$i;
        }
        
        if(!$q1 && !$q2) {
            redirect( BASE_URL . 'error/course_registration/' );
        } else {
        	if(Hooks::{'get_option'}('registrar_email_address') != '') {
            	$this->_email->course_registration(Hooks::{'get_option'}('registrar_email_address'),$this->_auth->getPersonField('personID'),$data['courseSecCode'],BASE_URL);
            }
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
                $this->_log->setLog('Update Record','Graduation',get_name($data['stuID']),$this->_uname);
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
                        WHEN 'Phd' THEN 'Doctorate'
                        ELSE 'Continuing Education' 
                        END AS 'Level',
                        a.stuID,
                        b.address1,
                        b.address2,
                        b.city,
                        b.state,
                        b.zip,
                        c.ssn,
                        c.dob,
                        d.graduationDate,
                        f.degreeCode,
                        f.degreeName,
                        g.majorCode,
                        g.majorName,
                        h.minorCode,
                        h.minorName,
                        i.specCode,
                        i.specName,
                        j.ccdCode,
                        j.ccdName 
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
                    LEFT JOIN 
                    	stu_program d 
                	ON 
                		a.stuID = d.stuID 
            		LEFT JOIN 
            			acad_program e 
        			ON 
        				d.acadProgCode = e.acadProgCode 
    				LEFT JOIN 
    				    degree f 
				    ON 
				        e.degreeCode = f.degreeCode 
			        LEFT JOIN 
			            major g 
		            ON 
		                e.majorCode = g.majorCode 
	                LEFT JOIN 
	                    minor h 
                    ON 
                        e.minorCode = h.minorCode 
                    LEFT JOIN 
                        specialization i 
                    ON 
                        e.specCode = i.specCode 
                    LEFT JOIN 
                        ccd j 
                    ON 
                        e.ccdCode = j.ccdCode 
                    WHERE 
                        a.stuID = :stuID 
                    AND
                       a.acadLevelCode = :acadLevelCode 
                    AND 
                        b.addressStatus = 'C' 
                    AND 
                        b.addressType = 'P' 
                    AND 
                    	e.acadLevelCode = :acadLevelCode",
                    $bind
        );
        foreach($q as $r) {
            $array[] = $r;
        }

        return $array;
    }
    
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
                        a.attCred*a.gradePoints AS Points,
                        b.secShortTitle,
                        b.courseCode,
                        b.courseSecCode,
                        b.startDate,
                        b.endDate,
                        c.attCred AS termAttCred,
                        c.compCred AS termCompCred,
                        c.gradePoints AS termGradePoints,
                        c.termCode,
                        c.termGPA 
                    FROM 
                        stu_acad_cred a 
                    LEFT JOIN 
                        course_sec b 
                    ON 
                        a.courseSecCode = b.courseSecCode AND a.termCode = b.termCode
                    LEFT JOIN 
                        stu_term_gpa c
                    ON 
                        a.termCode = c.termCode 
                    WHERE 
                        a.stuID = :stuID 
                    AND 
                        a.acadLevelCode = :acadLevelCode 
                    GROUP BY 
                        a.courseSecCode,a.termCode,a.acadLevelCode",
                    $bind
        );
        
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function tranGPA() {
        $array = [];
        $stuID = isGetSet('studentID');
        $tranType = isGetSet('acadLevelCode');
        $bind = [ ":stuID" => $stuID, ":level" => $tranType ];
        $q = DB::inst()->query( "SELECT 
                        SUM(attCred) as Attempted,
                        SUM(compCred) as Completed,
                        SUM(gradePoints) as Points,
                        SUM(attCred*gradePoints)/SUM(attCred) as GPA 
                    FROM 
                        stu_acad_cred 
                    WHERE 
                        stuID = :stuID 
                    AND 
                        acadLevelCode = :level 
                    AND 
                        grade IS NOT NULL 
                    GROUP BY 
                        stuID",
                    $bind 
        );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function runRSTR($data) {
        $bind = [
                "stuID" => $data['stuID'],"rstrCode" => Util::_trim($data['rstrCode']),"severity" => Util::_trim($data['severity']),
                "startDate" => $data['startDate'],"endDate" => $data['endDate'],
                "comment" => $data['comment'],"addDate" => $data['addDate'],"addedBy" => $data['addedBy']
                ];
        $q = DB::inst()->insert('restriction',$bind);
        if(!$q) {
            redirect( BASE_URL . 'error/save_data/' );
        } else {
            /* Write to logs */
            $this->_log->setLog('New Record','Student Restriction',get_name($data['stuID']),$this->_uname);
            redirect( BASE_URL . 'student/rstr/' . $data['stuID'] . '/' . bm() );
        }
    }
    
    public function runEditRSTR($data) {
        $size = count($data['rstrID']);
        $i = 0;
        while($i < $size) {
            $update = [
                    "rstrCode" => Util::_trim($data['rstrCode'][$i]),"severity" => Util::_trim($data['severity'][$i]),
                    "startDate" => $data['startDate'][$i],"endDate" => $data['endDate'][$i],
                    "comment" => $data['comment'][$i]
                    ];
            $bind = [ ":stuID" => $data['stuID'],":id" => $data['rstrID'][$i] ];
            $q = DB::inst()->update('restriction',$update,'stuID=:stuID AND rstrID=:id',$bind);
        ++$i;
        }
        /* Write to logs */
        $this->_log->setLog('Update Record','Student Restriction',get_name($data['stuID']),$this->_uname);
        redirect( BASE_URL . 'student/rstr/' . $data['stuID'] . '/' . bm() );
    }
    
	public function __destruct() {
		DB::inst()->close();
	}
	
}