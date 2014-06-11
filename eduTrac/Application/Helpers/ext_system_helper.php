<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * eduTrac System Helper
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
use \eduTrac\Classes\Libraries\Log;
use \eduTrac\Classes\Libraries\Cookies;
	
	/**
     * Bookmarking initialization function.
     * 
     * @since 1.1.3
     */
	function benchmark_init() {
		if( isGetSet('php-benchmark-test') ) {
		    \eduTrac\Classes\Libraries\PHPBenchmark\Monitor::instance()->init( !empty($_GET['display-data']) );
		    \eduTrac\Classes\Libraries\PHPBenchmark\Monitor::instance()->snapshot('Bootstrap finished');
		}
	}
	
	/**
     * Hide menu links by functions and/or by 
	 * permissions.
     * 
     * @since 4.0.4
     */
	function hl($f,$p=NULL) {
		if(function_exists($f)) {
			return ' style="display:none"';
		}
		if($p !== NULL) {
			return ae($p);
		}
	}
 	
    /**
     * When enabled, appends url string in order to give
     * benchmark statistics.
     * 
     * @since 1.0.0
     */
 	function bm() {
 	    if(Hooks::get_option('enable_benchmark') == 1) {
 	        return '?php-benchmark-test=1&display-data=1';
 	    }
 	}
    
    /**
     * Renders any unwarranted special characters to HTML entities.
     * 
     * @since 1.0.0
     * @param string $str
     * @return mixed
     */
    function _h($str) {
        return htmlspecialchars($str,ENT_QUOTES,'UTF-8');
    }
    
    function userQuery() {
        $auth = new Cookies;
        $bind = array(":id" => $auth->getPersonField('personID'));
        $q = DB::inst()->select( "saved_query","personID = :id","savedQueryID","*",$bind );
        foreach($q as $k => $v) {
            echo '<option value="'._h($v['savedQueryID']).'">'._h($v['savedQueryName']).'</option>';
        }
    }
    
    function emailTemplates() {
        $auth = new Cookies;
        $bind = [ ":id" => $auth->getPersonField('personID') ];
        $q = DB::inst()->query( "SELECT 
                    a.etID,
                    a.email_key,
                    a.email_name,
                    a.email_value,
                    a.deptCode 
                FROM 
                    email_template a 
                LEFT JOIN 
                    staff b 
                ON 
                    a.deptCode = b.deptCode 
                WHERE 
                    b.staffID = :id",
                $bind 
        );
        foreach($q as $k => $v) {
            echo '<option value="'._h($v['etID']).'">'._h($v['email_name']).'</option>';
        }
    }
	
	/**
	 * Term dropdown: shows general list of terms and
	 * if $termID is not NULL, shows the term attached 
	 * to a particular record.
	 * 
	 * @since 1.0.0
	 * @param string $termID - optional
	 * @return string Returns the record key if selected is true.
	 */
	function term_dropdown($termCode = NULL) {
        $q = DB::inst()->select( "term","","termID","termCode,termName" );
		foreach( $q as $k => $v ) {
	      	echo '<option value="'._h($v['termCode']).'"'.selected( $termCode, _h($v['termCode']), false ).'>'._h($v['termName']).'</option>' . "\n";
		}
	}
	
	/**
	 * Semester dropdown: shows general list of semesters and
	 * if $semesterID is not NULL, shows the semester attached 
	 * to a particular record.
	 * 
	 * @since 1.0.0
	 * @param string $semesterID - optional
	 * @return string Returns the record key if selected is true.
	 */
	function semester_dropdown($semID = NULL) {
        $q = DB::inst()->select( "semester","","acadYearCode","semCode,semName" );
		foreach( $q as $k => $v ) {
	      	echo '<option value="'._h($v['semesterCode']).'"'.selected( $semID, _h($v['semesterCode']), false ).'>'._h($v['semCode']).' '._h($v['semName']).'</option>' . "\n";
		}
	}
	
	/**
	 * Subject dropdown: shows general list of subjects and
	 * if $subjectCode is not NULL, shows the subject attached 
	 * to a particular record.
	 * 
	 * @since 1.0.0
	 * @param string $subjectID - optional
	 * @return string Returns the record key if selected is true.
	 */
	function subject_code_dropdown($subjectCode = NULL) {
        $q = DB::inst()->select( "subject","subjectCode <> 'NULL'","subjectCode","subjectCode,subjectName" );
		
		foreach( $q as $k => $v ) {
	      	echo '<option value="'._h($v['subjectCode']).'"'.selected( $subjectCode, _h($v['subjectCode']), false ).'>'._h($v['subjectCode']).' '._h($v['subjectName']).'</option>' . "\n";
		}
	}
    
    /**
     * Faculty dropdown: shows general list of faculty and
     * if $facID is not NULL, shows the faculty attached 
     * to a particular record.
     * 
     * @since 1.0.0
     * @param string $facID - optional
     * @return string Returns the record id if selected is true.
     */
    function facID_dropdown($facID = NULL) {
        $q = DB::inst()->select( "staff_meta","staffType = 'FAC'","staffID","staffID" );
        
        foreach( $q as $k => $v ) {
            echo '<option value="'._h($v['staffID']).'"'.selected( $facID, _h($v['staffID']), false ).'>'.get_name(_h($v['staffID'])).'</option>' . "\n";
        }
    }
    
    /**
     * Payment type dropdown: shows general list of payment types and
     * if $typeID is not NULL, shows the payment type attached 
     * to a particular record.
     * 
     * @since 1.0.3
     * @param string $typeID - optional
     * @return string Returns the record id if selected is true.
     */
    function payment_type_dropdown($typeID = NULL) {
        $q = DB::inst()->select( "payment_type" );
        
        foreach( $q as $k => $v ) {
            echo '<option value="'._h($v['ptID']).'"'.selected( $typeID, _h($v['ptID']), false ).'>'._h($v['type']).'</option>' . "\n";
        }
    }
    
    /**
     * Table dropdown: pulls dropdown list from specified table
     * if $tableID is not NULL, shows the record attached 
     * to a particular record.
     * 
     * @since 1.0.0
     * @param string $table
     * @param string $where
     * @param string $code
     * @param string $name
     * @param string $activeCode
     * @return mixed
     */
    function table_dropdown($table, $where = NULL, $id, $code, $name, $activeID = NULL, $bind = NULL) {
        $q = DB::inst()->select( $table,$where,$id,"$id,$code,$name",$bind );
        
        foreach( $q as $k => $v ) {
            echo '<option value="'._h($v[$code]).'"'.selected( $activeID, _h($v[$code]), false ).'>'._h($v[$code]).' '._h($v[$name]).'</option>' . "\n";
        }
    }
    
    function fee_table_dropdown() {
        $q = DB::inst()->select( "billing_table","status='A'","","*" );
		foreach( $q as $k => $v ) {
	      	echo '<option value="'._h($v['ID']).'">'._h($v['amount']).' '._h($v['name']).'</option>' . "\n";
		}
	}
	
	/**
	 * Date dropdown
	 */
	function date_dropdown($limit = 0,$name = '',$table = '',$column = '',$id = '',$field = '',$bool = '') {
        
        if($id != '') {
            $bind = [ ":id" => $id ];
            $array = [];
            $q = DB::inst()->select($table,"$column = :id","","*",$bind);
            foreach($q as $r) {
                $array[] = $r;
            }
            $date = explode("-",$r[$field]);
        }
		
		/*years*/
        $html_output = '           <select name="'.$name.'Year"'.$bool.' class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true">'."\n";
        $html_output .= '               <option value="">&nbsp;</option>'."\n";
            for ($year = 2000; $year <= (date("Y") - $limit); $year++) {
                $html_output .= '               <option value="' . sprintf("%04s", $year) . '"'.selected(sprintf("%04s", $year),$date[0],false).'>' . sprintf("%04s", $year) . '</option>'."\n";
            }
        $html_output .= '           </select>'."\n";
        
        /*months*/
        $html_output .= '           <select name="'.$name.'Month"'.$bool.' class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true">'."\n";
        $html_output .= '               <option value="">&nbsp;</option>'."\n";
        $months = array("", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
            for ($month = 1; $month <= 12; $month++) {
                $html_output .= '               <option value="' . sprintf("%02s", $month) . '"'.selected(sprintf("%02s", $month),$date[1],false).'>' . $months[$month] . '</option>'."\n";
            }
        $html_output .= '           </select>'."\n";
        
        /*days*/
        $html_output .= '           <select name="'.$name.'Day"'.$bool.' class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true">'."\n";
        $html_output .= '               <option value="">&nbsp;</option>'."\n";
            for ($day = 1; $day <= 31; $day++) {
                $html_output .= '               <option value="' . sprintf("%02s", $day) . '"'.selected(sprintf("%02s", $day),$date[2],false).'>' . sprintf("%02s", $day) . '</option>'."\n";
            }
        $html_output .= '           </select>'."\n";
        
        return $html_output;
    }
    
    /**
     * General ledger account dropdown: pulls dropdown list from general ledger 
	 * account table. if $activeID is not NULL, shows the record attached 
     * to a particular record.
     * 
     * @since 1.1.5
     * @param string $activeCode
     * @return mixed
     */
    function gl_acct_dropdown($activeID = NULL) {
        $q = DB::inst()->query( "SELECT * FROM gl_account" );
        $options = "";
        while( $row = $q->fetch(\PDO::FETCH_OBJ) ) {
            $options .= '<option value="'._h($row->glacctID).'"'.selected( $activeID, _h($row->glacctID), false ).'>'._h($row->gl_acct_number).' | '._h($row->gl_acct_name).'</option>';
        }
		echo $options;
    }
	
	function assignmentExist($code,$term) {
		$bind = [ ":code" => $code, ":term" => $term ];
		$q = DB::inst()->select( "assignment","courseSecCode = :code AND termCode = :term","","*",$bind );
		if(count($q) > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	function gradebookExist($code,$term) {
		$bind = [ ":code" => $code, ":term" => $term ];
		$q = DB::inst()->select( "gradebook","courseSecCode = :code AND termCode = :term","","*",$bind );
		if(count($q) > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	function studentsExist($code,$term) {
		$bind = [ ":code" => $code, ":term" => $term ];
		$q = DB::inst()->select( "stu_course_sec","courseSecCode = :code AND termCode = :term","","*",$bind );
		if(count($q) > 0) {
			return true;
		} else {
			return false;
		}
	}
    
    /**
     * @since 4.0.7
     */
    function getstudentload($term,$creds,$level) {
        $t = explode("/",$term);
        $newTerm1 = $t[0];
        $newTerm2 = $t[1];
        $bind = [ ":term1" => $newTerm1,":term2" => $newTerm2,":creds" => $creds,":level" => $level ];
        $q = DB::inst()->query( "SELECT 
                        status 
                    FROM 
                        student_load_rule 
                    WHERE 
                        term REGEXP CONCAT('[[:<:]]', :term1, '[[:>:]]') 
                    OR 
                        term REGEXP CONCAT('[[:<:]]', :term2, '[[:>:]]') 
                    AND 
                        acadLevelCode REGEXP CONCAT('[[:<:]]', :level, '[[:>:]]') 
                    AND 
                        :creds 
                    BETWEEN 
                        min_cred 
                    AND 
                        max_cred 
                    AND 
                        active = '1'",
                    $bind 
        );
        /*$q = DB::inst()->query( "SELECT 
                        status 
                    FROM 
                        student_load_rule 
                    WHERE 
                        term REGEXP '[[:<:]]".$newTerm."[[:>:]]' 
                    AND 
                        acadLevelCode REGEXP '[[:<:]]".$level."[[:>:]]' 
                    AND 
                        ".$creds." 
                    BETWEEN 
                        min_cred 
                    AND 
                        max_cred 
                    AND 
                        active = '1'"
        );*/
        foreach($q as $r) {
            return $r['status'];
        }
    }
    
    /**
     * @since 4.0.9
     */
    function room_booking($data) {
    	$auth = new \eduTrac\Classes\Libraries\Cookies;
    	/** 
		 * If check_event is set, then we will 
		 * check to make sure that the room and
		 * time slots are available for booking.
		 */
    	if(!empty($data['check_event']) && $data['check_event'] == 'Check Availability') {
	    	$roomCode = $data['roomCode'];
	        $sDate = $data['startDate'];
	        $endDate = $data['endDate'];
	        $sTime = date('H:i:s',strtotime($data['startTime']));
	        $eTime = date('H:i:s',strtotime($data['endTime']));
	        $start = $sDate . " " . $sTime;
	        $end = $sDate . " " . $eTime;
	        $repeats = $data['repeats'];
	        $repeatFreq = $data['repeatFreq'];
	                
	        if(empty($repeats)) {
	            $repeat = 0;
	            $freq = 0;
	            $bind1 = [ 
	                    ":room" => $roomCode,":term" => $data['termCode'],
	                    ":start" => $sDate.' '.$sTime,":end" => $endDate.' '.$eTime,
	                    ];
	            
	            $q = DB::inst()->query( "SELECT 
	                            roomCode,
	                            termCode,
	                            title,
	                            startDate,
	                            startTime,
	                            endTime 
	                        FROM 
	                            event
	                        WHERE 
	                            roomCode = :room 
	                        AND 
	                            termCode = :term 
	                        AND 
	                            :start 
	                        BETWEEN 
	                            CONCAT(startDate,' ',startTime) 
	                        AND 
	                            CONCAT(startDate,' ',endTime) 
	                        OR 
	                            :end 
	                        BETWEEN 
	                            CONCAT(startDate,' ',startTime) 
	                        AND 
	                            CONCAT(startDate,' ',endTime)",
	                        $bind1 
	            );
	            if(count($q) > 0) {
	            	echo '<div class="alert alert-danger centered">';
		            foreach($q as $k => $v) {
		        		echo '<font color="red">Conflict:&nbsp;&nbsp;&nbsp;&nbsp;'.$v['termCode'].'&nbsp;&nbsp;&nbsp;&nbsp;'.$v['roomCode'].'&nbsp;&nbsp;&nbsp;&nbsp;'.
		        		$v['title'].'&nbsp;&nbsp;&nbsp;&nbsp;'.$v['startDate'].'&nbsp;&nbsp;&nbsp;&nbsp;'.date('h:i A',strtotime($v['startTime'])).'&nbsp;&nbsp;&nbsp;&nbsp;'.
		        		date('h:i A',strtotime($v['endTime'])).'</font>';
		            }
		            echo '</div>';
	            }
	        } else {
	            $startDate = new \DateTime("$sDate");
	            $lastDate = new \DateTime("$endDate");
	            $days = $lastDate->diff($startDate)->format("%a");
	            $limit = $days+1;
	            $until = ($limit/$repeatFreq);
	            if ($repeatFreq == 1){
	                $weekday = 0;
	            }
	            
	            for($x = 0; $x < $until; $x++) {
	                $bind2 = [ 
	                    ":room" => $roomCode,
	                    ":start" => $start,":end" => $end,
	                    ];
	            $q = DB::inst()->query( "SELECT 
	            				* 
	        				FROM 
	        					event_meta 
	    					WHERE 
	    						roomCode = :room 
	                        AND 
	                            :start 
	                        BETWEEN 
	                            start 
	                        AND 
	                        	end
	                        OR 
	                            :end 
	                        BETWEEN 
	                        	start 
	                    	AND
	                            end 
	                        GROUP BY 
	                        	roomCode,start,end,title",
	                        $bind2 
				);
				if(count($q) > 0) {
					echo '<div class="alert alert-danger centered">';
		            foreach($q as $k => $v) {
		        		echo 'Conflict:&nbsp;&nbsp;&nbsp;&nbsp;'.$v['termCode'].'&nbsp;&nbsp;&nbsp;&nbsp;'.$v['roomCode'].'&nbsp;&nbsp;&nbsp;&nbsp;'.
		        		$v['title'].'&nbsp;&nbsp;&nbsp;&nbsp;'.date('F d, o h:i A',strtotime($v['start'])).'&nbsp;&nbsp;&nbsp;&nbsp;'.
		        		date('F d, o h:i A',strtotime($v['end'])).'<br />';
		            }
		            echo '</div>';
	            }
	            $sDate = strtotime($start . '+' . $repeatFreq . 'DAYS');
	            $eDate = strtotime($end . '+' . $repeatFreq . 'DAYS');
	            $start = date("Y-m-d H:i", $sDate);
	            $end = date("Y-m-d H:i", $eDate);
	            }
	        }
        }
        
                
        /** 
		 * If add_event is set, then we will 
		 * book the room and the available time slots.
		 */
		if(!empty($data['add_event']) && $data['add_event'] == 'Submit') {
			$title = $data['title'];
	        $text = $data['title'];
	        $pID = $auth->getPersonField('personID');
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
		}
    }
    
    function supervisor($id,$active = NULL) {
        $bind = [ ":id" => $id ];
        $q = DB::inst()->query( "SELECT 
                        staffID  
                    FROM 
                        staff 
                    WHERE 
                        staffID != :id",
                    $bind 
        );
        foreach( $q as $k => $v ) {
            echo '<option value="'._h($v['staffID']).'"'.selected( $active, _h($v['staffID']), false ).'>'.get_name(_h($v['staffID'])).'</option>' . "\n";
        }
    }
    
    function getJobID() {
        $auth = new \eduTrac\Classes\Libraries\Cookies;
        $bind = [ ":id" => $auth->getPersonField('personID') ];
        $q = DB::inst()->select('staff_meta','staffID=:id AND endDate=NULL OR endDate="0000-00-00"','','jobID',$bind);
        foreach($q as $r) {
            return _h($r['jobID']);
        }
    }
    
    function getJobTitle() {
        $bind = [ ":id" => getJobID() ];
        $q = DB::inst()->query( "SELECT 
                        a.title 
                    FROM 
                        job a 
                    LEFT JOIN 
                        staff_meta b 
                    ON 
                        a.ID = b.jobID 
                    WHERE 
                        a.ID = :id",
                    $bind 
        );
        foreach($q as $r) {
            return _h($r['title']);
        }
    }
	
	function getStaffJobTitle($id) {
		$bind = [ ":id" => $id ];
        $q = DB::inst()->query( "SELECT 
                        a.title 
                    FROM 
                        job a 
                    LEFT JOIN 
                        staff_meta b 
                    ON 
                        a.ID = b.jobID 
                    WHERE 
                        b.staffID = :id 
                    AND 
                    	b.hireDate = (SELECT MAX(hireDate) FROM staff_meta WHERE staffID = :id)",
                    $bind 
        );
        foreach($q as $r) {
            return _h($r['title']);
        }
	}
	
	function paypal_payment($data) {
	    if(is_array($data)) {
	        $bind = [ 
	               "stuID" => $data['stuID'],"termCode" => $data['term'],
	               "amount" => $data['amt'],"paymentTypeID" => '4',
	               "dateTime" => date("Y-m-d h:i:s")
	               ];
            $q = DB::inst()->insert( "payment", $bind );
	    }
	}
    
    /**
     * Address type select: shows general list of address types and
     * if $typeCode is not NULL, shows the address type attached 
     * to a particular record.
     * 
     * @since 1.0.0
     * @param string $typeCode
     * @return string Returns the record key if selected is true.
     */
    function address_type_select($typeCode = NULL) {
        $select = '<select name="addressType" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true" required>
            <option value="">&nbsp;</option>
            <option value="B"'.selected( $typeCode, 'B', false ).'>Business</option>
            <option value="H"'.selected( $typeCode, 'H', false ).'>Home/Mailing</option>
            <option value="P"'.selected( $typeCode, 'P', false ).'>Permanent</option>
            </select>';
        return Hooks::apply_filter('address_type', $select, $typeCode);
    }
    
    /**
     * Department Type select: shows general list of department types and
     * if $typeCode is not NULL, shows the department type attached 
     * to a particular record.
     * 
     * @since 1.0.0
     * @param string $typeCode
     * @return string Returns the record key if selected is true.
     */
    function dept_type_select($typeCode = NULL) {
        $select = '<select name="deptTypeCode" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true" required>
            <option value="">&nbsp;</option>
            <option value="'._t('ADMIN').'"'.selected( $typeCode, _t('ADMIN'), false ).'>'._t( 'Administrative' ).'</option>
            <option value="'._t('ACAD').'"'.selected( $typeCode, _t('ACAD'), false ).'>'._t( 'Academic' ).'</option>
            </select>';
        return Hooks::apply_filter('dept_type', $select, $typeCode);
    }
    
	/**
	 * Acad Level select: shows general list of academic levels and
	 * if $status is not NULL, shows the academic level attached 
	 * to a particular record.
	 * 
	 * @since 1.0.0
	 * @param string $status
	 * @return string Returns the record status if selected is true.
	 */
	function address_status_select($status = NULL) {
		$select = '<select name="addressStatus" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true" required>
			<option value="">&nbsp;</option>
	    	<option value="C"'.selected( $status, 'C', false ).'>Current</option>
			<option value="I"'.selected( $status, 'I', false ).'>Inactive</option>
		    </select>';
		return Hooks::apply_filter('address_status', $select, $status);
	}
    
    /**
     * Acad Level select: shows general list of academic levels and
     * if $levelCode is not NULL, shows the academic level attached 
     * to a particular record.
     * 
     * @since 1.0.0
     * @param string $levelCode
     * @return string Returns the record key if selected is true.
     */
    function acad_level_select($levelCode = null, $readonly = null, $required = '') {
        $select = '<select name="acadLevelCode" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true"'.$readonly.$required.'>
            <option value="">&nbsp;</option>
            <option value="NA"'.selected( $levelCode, 'NA', false ).'>N/A Not Applicable</option>
            <option value="CE"'.selected( $levelCode, 'CE', false ).'>CE Continuing Education</option>
            <option value="UG"'.selected( $levelCode, 'UG', false ).'>UG Undergraduate</option>
            <option value="GR"'.selected( $levelCode, 'GR', false ).'>GR Graduate</option>
            <option value="PhD"'.selected( $levelCode, 'PhD', false ).'>PhD Doctorate</option>
            </select>';
        return Hooks::apply_filter('acad_level', $select, $levelCode);
    }
	
	/**
	 * Status dropdown: shows general list of statuses and
	 * if $status is not NULL, shows the current status 
	 * for a particular record.
	 * 
	 * @since 1.0.0
	 * @param string $status
	 * @return string Returns the record key if selected is true.
	 */
	function status_select($status = NULL) {
		$select = '<select name="currStatus" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true" required>
    			<option value="">&nbsp;</option>
    	    	<option value="A"'.selected( $status, 'A', false ).'>A Active</option>
    	    	<option value="I"'.selected( $status, 'I', false ).'>I Inactive</option>
    			<option value="P"'.selected( $status, 'P', false ).'>P Pending</option>
    			<option value="O"'.selected( $status, 'O', false ).'>O Obsolete</option>
		        </select>';
        return Hooks::apply_filter('status', $select, $status);
	}
    
    /**
     * Course section select: shows general list of statuses and
	 * if $status is not NULL, shows the current status 
	 * for a particular course section record.
	 * 
	 * @since 1.0.0
	 * @param string $status
	 * @return string Returns the record key if selected is true.
	 */
	function course_sec_status_select($status = NULL) {
		$select = '<select name="currStatus" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true" required>
    			<option value="">&nbsp;</option>
    	    	<option'.dopt('activate_course_sec').' value="A"'.selected( $status, 'A', false ).'>A Active</option>
    	    	<option value="I"'.selected( $status, 'I', false ).'>I Inactive</option>
    			<option value="P"'.selected( $status, 'P', false ).'>P Pending</option>
    			<option'.dopt('cancel_course_sec').' value="C"'.selected( $status, 'C', false ).'>C Cancel</option>
    			<option value="O"'.selected( $status, 'O', false ).'>O Obsolete</option>
		        </select>';
        return Hooks::apply_filter('status', $select, $status);
	}
	
    /**
     * Person type select: shows general list of person types and
     * if $type is not NULL, shows the person type 
     * for a particular person record.
     * 
     * @since 1.0.0
     * @param string $type
     * @return string Returns the record type if selected is true.
     */
    function person_type_select($type = NULL) {
        $select = '<select name="personType" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true" required>
                <option value="">&nbsp;</option>
                <option value="FAC"'.selected( $type, 'FAC', false ).'>FAC Faculty</option>
                <option value="ADJ"'.selected( $type, 'ADJ', false ).'>ADJ Adjunct</option>
                <option value="STA"'.selected( $type, 'STA', false ).'>STA Staff</option>
                <option value="APL"'.selected( $type, 'APL', false ).'>APL Applicant</option>
                <option value="STU"'.selected( $type, 'STU', false ).'>STU Student</option>
                </select>';
        return Hooks::apply_filter('person_type', $select, $type);
    }
	
	/**
	 * Course Level dropdown: shows general list of course levels and
	 * if $levelCode is not NULL, shows the course level attached 
	 * to a particular record.
	 * 
	 * @since 1.0.0
	 * @param string $levelCode
	 * @return string Returns the record key if selected is true.
	 */
	function course_level_select($levelCode = NULL, $readonly = null) {		
		$select = '<select name="courseLevelCode" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true" required'.$readonly.'>
			<option value="">&nbsp;</option>
	    	<option value="100"'.selected( $levelCode, '100', false ).'>100 Course Level</option>
			<option value="200"'.selected( $levelCode, '200', false ).'>200 Course Level</option>
			<option value="300"'.selected( $levelCode, '300', false ).'>300 Course Level</option>
			<option value="400"'.selected( $levelCode, '400', false ).'>400 Course Level</option>
			<option value="500"'.selected( $levelCode, '500', false ).'>500 Course Level</option>
			<option value="600"'.selected( $levelCode, '600', false ).'>600 Course Level</option>
			<option value="700"'.selected( $levelCode, '700', false ).'>700 Course Level</option>
			<option value="800"'.selected( $levelCode, '800', false ).'>800 Course Level</option>
			<option value="900"'.selected( $levelCode, '900', false ).'>900 Course Level</option>
		    </select>';
		return Hooks::apply_filter('course_level', $select, $levelCode);
	}
	
	/**
     * Instructor method select: shows general list of instructor methods and
     * if $method is not NULL, shows the instructor method 
     * for a particular course section.
     * 
     * @since 1.0.0
     * @param string $method
     * @return string Returns the record method if selected is true.
     */
    function instructor_method($method = NULL) {
        $select = '<select name="instructorMethod" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true" required>
                <option value="">&nbsp;</option>
                <option value="' . _t('LEC') . '"'.selected( $method, _t('LEC'), false ).'>' . _t('LEC Lecture') . '</option>
                <option value="' . _t('LAB') . '"'.selected( $method, _t('LAB'), false ).'>' . _t('LAB Lab') . '</option>
                <option value="' . _t('SEM') . '"'.selected( $method, _t('SEM'), false ).'>' . _t('SEM Seminar') . '</option>
                <option value="' . _t('LL') . '"'.selected( $method, _t('LL'), false ).'>' . _t('LL Lecture + Lab') . '</option>
                <option value="' . _t('LS') . '"'.selected( $method, _t('LS'), false ).'>' . _t('LS Lecture + Seminar') . '</option>
                <option value="' . _t('SL') . '"'.selected( $method, _t('SL'), false ).'>' . _t('SL Seminar + Lab') . '</option>
                <option value="' . _t('LLS') . '"'.selected( $method, _t('LLS'), false ).'>' . _t('LLS Lecture + Lab + Seminar') . '</option>
                </select>';
        return Hooks::apply_filter('instructor_method', $select, $method);
    }
    
   /**
     * Student Course section status select: shows general list of course sec statuses and
     * if $status is not NULL, shows the status 
     * for a particular student course section record.
     * 
     * @since 1.0
     * @param string $status
     * @return string Returns the record status if selected is true.
     */
    function stu_course_sec_status_select($status = NULL) {
        $select = '<select name="status" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true" required>
                <option value="">&nbsp;</option>
                <option value="' . _t('A') . '"'.selected( $status, _t('A'), false ).'>' . _t('A Add') . '</option>
                <option value="' . _t('N') . '"'.selected( $status, _t('N'), false ).'>' . _t('N New') . '</option>
                <option value="' . _t('D') . '"'.selected( $status, _t('D'), false ).'>' . _t('D Drop') . '</option>
                <option value="' . _t('W') . '"'.selected( $status, _t('W'), false ).'>' . _t('W Withdrawn') . '</option>
                <option value="' . _t('C') . '"'.selected( $status, _t('C'), false ).'>' . _t('C Cancelled') . '</option>
                </select>';
        return Hooks::apply_filter('course_sec_status', $select, $status);
    }
    
    /**
     * Student program status select: shows general list of student 
     * statuses and if $status is not NULL, shows the status 
     * for a particular student program record.
     * 
     * @since 1.0.0
     * @param string $status
     * @return string Returns the record status if selected is true.
     */
    function stu_prog_status_select($status = NULL) {
        $select = '<select name="currStatus" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true" required>
                <option value="">&nbsp;</option>
                <option value="' . _t('A') . '"'.selected( $status, _t('A'), false ).'>' . _t('A Active') . '</option>
                <option value="' . _t('P') . '"'.selected( $status, _t('P'), false ).'>' . _t('P Potential') . '</option>
                <option value="' . _t('W') . '"'.selected( $status, _t('W'), false ).'>' . _t('W Withdrawn') . '</option>
                <option value="' . _t('C') . '"'.selected( $status, _t('C'), false ).'>' . _t('C Changed Mind') . '</option>
                <option value="' . _t('G') . '"'.selected( $status, _t('G'), false ).'>' . _t('G Graduated') . '</option>
                </select>';
        return Hooks::apply_filter('stu_prog_status', $select, $status);
    }
    
    /**
     * Credit type select: shows general list of credit types and
     * if $type is not NULL, shows the credit type 
     * for a particular course or course section record.
     * 
     * @since 1.0.0
     * @param string $type
     * @return string Returns the record type if selected is true.
     */
    function credit_type($type = NULL) {
        $select = '<select name="status" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true" required>
                <option value="">&nbsp;</option>
                <option value="' . _t('I') . '"'.selected( $status, _t('I'), false ).'>' . _t('I Institutional') . '</option>
                <option value="' . _t('TR') . '"'.selected( $status, _t('TR'), false ).'>' . _t('TR Transfer') . '</option>
                <option value="' . _t('AP') . '"'.selected( $status, _t('AP'), false ).'>' . _t('AP Advanced Placement') . '</option>
                <option value="' . _t('X') . '"'.selected( $status, _t('X'), false ).'>' . _t('X Exempt') . '</option>
                <option value="' . _t('T') . '"'.selected( $status, _t('T'), false ).'>' . _t('T Test') . '</option>
                </select>';
        return Hooks::apply_filter('course_sec_status', $select, $status);
    }
    
    /**
     * Class year select: shows general list of class years and
     * if $year is not NULL, shows the class year
     * for a particular student.
     * 
     * @since 1.0.0
     * @param string $year
     * @return string Returns the record year if selected is true.
     */
    function class_year($year = NULL) {
        $select = '<select name="classYear" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true">
                <option value="">&nbsp;</option>
                <option value="' . _t('FR') . '"'.selected( $year, _t('FR'), false ).'>' . _t('FR Freshman') . '</option>
                <option value="' . _t('SO') . '"'.selected( $year, _t('SO'), false ).'>' . _t('SO Sophomore') . '</option>
                <option value="' . _t('JR') . '"'.selected( $year, _t('JR'), false ).'>' . _t('JR Junior') . '</option>
                <option value="' . _t('SR') . '"'.selected( $year, _t('SR'), false ).'>' . _t('SR Senior') . '</option>
                <option value="' . _t('UG') . '"'.selected( $year, _t('UG'), false ).'>' . _t('UG Undergraduate Student') . '</option>
                <option value="' . _t('GR') . '"'.selected( $year, _t('GR'), false ).'>' . _t('GR Grad Student') . '</option>
                <option value="' . _t('PhD') . '"'.selected( $year, _t('PhD'), false ).'>' . _t('PhD PhD Student') . '</option>
                </select>';
        return Hooks::apply_filter('class_year', $select, $year);
    }
    
    /**
     * Grading scale: shows general list of letter grades and
     * if $grade is not NULL, shows the grade
     * for a particular student course section record
     * 
     * @since 1.0.0
     * @param string $grade
     * @return string Returns the stu_course_sec grade if selected is true.
     */
    function grading_scale($grade = NULL) {
    	$select = '<select name="grade[]" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true" required>'."\n";
		$select .= '<option value="">&nbsp;</option>'."\n";
		$q = DB::inst()->select( "grade_scale","status = '1'" );
		foreach($q as $r) {
			$select .= '<option value="' . _h($r['grade']) . '"'.selected( $grade, _h($r['grade']), false ).'>' . _h($r['grade']) . '</option>'."\n";
		}
        $select .= '</select>';
        return Hooks::apply_filter('grading_scale', $select, $grade);
    }
	
	function grades($id,$aID) {
		$array = [];
		$bind = [ ":id" => $id,":aID" => $aID ];
		$q = DB::inst()->select("gradebook","stuID = :id AND assignID = :aID","","*",$bind);
		foreach($q as $r) {
			$array[] = $r;
		}
        $select = grading_scale(_h($r['grade']));
        return Hooks::apply_filter('grades', $select);
    }
    
	function stuGrades($id,$aID) {
		$bind = [ ":id" => $id,":aID" => $aID ];
		$q = DB::inst()->select("gradebook","stuID = :id AND assignID = :aID","","*",$bind);
		foreach($q as $r) {
			$array[] = $r;
		}
		return $array;
	}
    
    /**
     * Admit status: shows general list of admission statuses and
     * if $status is not NULL, shows the admit status
     * for a particular applicant.
     * 
     * @since 1.0.0
     * @param string $status
     * @return string Returns the application admit status if selected is true.
     */
    function admit_status_select($status = NULL) {
        $select = '<select name="admitStatus" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true">
                <option value="">&nbsp;</option>
                <option value="' . _t('FF') . '"'.selected( $status, _t('FF'), false ).'>' . _t('FF First Time Freshman') . '</option>
                <option value="' . _t('TR') . '"'.selected( $status, _t('TR'), false ).'>' . _t('TR Transfer') . '</option>
                <option value="' . _t('RA') . '"'.selected( $status, _t('RA'), false ).'>' . _t('RA Readmit') . '</option>
                <option value="' . _t('NA') . '"'.selected( $status, _t('NA'), false ).'>' . _t('NA Non-Applicable') . '</option>
                </select>';
        return Hooks::apply_filter('admit_status', $select, $status);
    }
	
	/**
     * General Ledger type select: shows general list of general 
	 * ledger types and if $type is not NULL, shows the general 
	 * ledger type for a particular general ledger record.
     * 
     * @since 1.1.5
     * @param string $type
     * @return string Returns the record type if selected is true.
     */
    function general_ledger_type_select($type = NULL) {
        $select = '<select name="gl_acct_type" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true" required>
                <option value="">&nbsp;</option>
                <option value="'._t('Asset').'"'.selected( $type, _t('Asset'), false ).'>'._t('Asset').'</option>
                <option value="'._t('Liability').'"'.selected( $type, _t('Liability'), false ).'>'._t('Liability').'</option>
                <option value="'._t('Equity').'"'.selected( $type, _t('Equity'), false ).'>'._t('Equity').'</option>
                <option value="'._t('Revenue').'"'.selected( $type, _t('Revenue'), false ).'>'._t('Revenue').'</option>
                <option value="'._t('Expense').'"'.selected( $type, _t('Expense'), false ).'>'._t('Expense').'</option>
                </select>';
        return Hooks::apply_filter('general_ledger_type', $select, $type);
    }
	
	function rolePerm($id) {
		$array = [];
		$q = DB::inst()->query("SELECT permission from role WHERE ID = $id");
		foreach($q as $v) {
			$array[] = $v;
		}
		$sql = DB::inst()->query("SELECT * FROM permission");
		foreach($sql as $r) {
			$perm = Hooks::maybe_unserialize($v['permission']);
			echo '
				<tr>
					<td>'.$r['permName'].'</td>
					<td class="text-center">
				<input type="checkbox" name="permission[]" value="'.$r['permKey'].'" ';
				if(in_array($r['permKey'],$perm)) { echo 'checked="checked"'; };
				echo '/>
					</td>
				</tr>';
		}
	}
	
	function personPerm($id) {
		$array = [];
		$bind = [ ":id" => $id ];
		$q = DB::inst()->query( "SELECT permission FROM person_perms WHERE personID = :id", $bind );
		foreach($q as $r) {
			$array[] = $r;
		}
		$personPerm = Hooks::maybe_unserialize($r['permission']);
		/** 
		 * Select the role(s) of the person who's 
		 * personID = $id
		 */ 
		$array1 = [];
		$bind1 = [ ":id" => $id ];
		$q1 = DB::inst()->query( "SELECT roleID from person_roles WHERE personID = :id",$bind1 );
		foreach($q1 as $r1) {
			$array1[] = $r1;
		}
		/**
		 * Select all the permissions from the role(s)
		 * that are connected to the selected person.
		 */
		$array2 = [];
		$bind2 = [ ":id" => _h($r1['roleID']) ];
		$q2 = DB::inst()->query("SELECT permission from role WHERE ID = :id", $bind2);
		foreach($q2 as $r2) {
			$array2[] = $r2;
		}
		$perm = Hooks::maybe_unserialize($r2['permission']);
		$sql = DB::inst()->query("SELECT * FROM permission");
		foreach($sql as $r) {
			echo '
				<tr>
					<td>'.$r['permName'].'</td>
					<td class="text-center">
				<input type="checkbox" name="permission[]" value="'.$r['permKey'].'" ';
				if(in_array($r['permKey'],$perm)) { echo 'checked="checked" disabled="disabled"'; } elseif($personPerm != '' && in_array($r['permKey'],$personPerm)) { echo 'checked="checked"';};
				echo '/>
					</td>
				</tr>';
		}
	}
	
	function student_has_restriction() {
		$auth = new \eduTrac\Classes\Libraries\Cookies;
        $bind = [ ":id" => $auth->getPersonField('personID') ];
        $q = DB::inst()->query( "SELECT 
        				GROUP_CONCAT(DISTINCT c.deptName SEPARATOR ',') AS 'Restriction' 
    				FROM 
    					restriction a 
					LEFT JOIN 
						restriction_code b 
					ON 
						a.rstrCode = b.rstrCode 
					LEFT JOIN 
						department c 
					ON 
						b.deptCode = c.deptCode 
					WHERE 
						a.severity = '99' 
					AND 
						a.endDate <= '0000-00-00' 
					AND 
						a.stuID = :id 
					GROUP BY 
						a.stuID 
					HAVING 
						a.stuID = :id",
					$bind 
		);
		if(count($q) > 0) {
			foreach($q as $r) {
				return '<strong>'.$r['Restriction'].'</strong>';
			}
		} else {
			return false;
		}
	}
    
    /**
     * Checks against certain keywords when the SQL 
     * terminal and saved query screens are used. Helps 
     * against database manipulation and SQL injection.
     * 
     * @since 1.0.0
     * @return boolean
     */
    function forbidden_keyword() {
        $array = [ 
            "create","delete","drop table","alter","update",
            "insert","change","convert","modifies",
            "optimize","purge","rename","replace",
            "revoke","unlock","truncate","anything",
            "svc","write","into","--","1=1","1 = 1","\\",
            "?","'x'","loop","exit","leave","undo",
            "upgrade","update","html","script","css",
            "x=x","x = x","everything","anyone","everyone",
            "upload","&","&amp;","xp_","$","0=0","0 = 0",
            "X=X","X = X","union","'='","XSS","mysql_error",
            "die","password","auth_token","alert","img","src",
            "drop tables","drop index","drop database","drop column",
            "show tables in","show databases"," in ",
            "slave","hosts","grants","warnings","variables",
            "triggers","privileges","engine","processlist",
            "relaylog","errors"
        ];
        return $array;
    }
    
    /**
     * Function wrapper for the setError log method.
     */
    function logError($type,$string,$file,$line) {
        $log = new \eduTrac\Classes\Libraries\Log;
        return $log->setError($type,$string,$file,$line);
    }
    
    function translate_class_year($year) {
        switch($year) {
            case 'FR':
                return 'Freshman';
            break;
            
            case 'SO':
                return 'Sophomore';
            break;
            
            case 'JR':
                return 'Junior';
            break;
            
            case 'SR':
                return 'Senior';
            break;
            
            case 'GR':
                return 'Grad Student';
            break;
            
            case 'PhD':
                return 'PhD Student';
            break;
        }
    }
    
    function translate_addr_status($status) {
        switch($status) {
            case 'C':
                return 'Current';
            break;
            
            case 'I':
                return 'Inactive';
            break;
        }
    }
    
    function translate_addr_type($type) {
        switch($type) {
            case 'H':
                return 'Home';
            break;
            
            case 'P':
                return 'Permanent';
            break;
            
            case 'B':
                return 'Business';
            break;
        }
    }
    
    function translate_phone_type($type) {
        switch($type) {
            case 'H':
                return 'Home';
            break;
            
            case 'CEL':
                return 'Cellular';
            break;
        }
    }
    
    function get_name($ID) {
        $bind = array( ":id" => $ID );
        $q = DB::inst()->select( "person","personID = :id","","lname,fname",$bind );
        foreach($q as $r) {
            $array[] = $r;
        }
        return _h($r['lname']).', '._h($r['fname']);
    }
	
	/**
	 * @since 4.1.6
	 */
	function get_initials($ID,$initials=2) {
        $bind = array( ":id" => $ID );
        $q = DB::inst()->select( "person","personID = :id","","lname,fname",$bind );
        foreach($q as $r) {
            $array[] = $r;
        }
		if($initials == 2) {
			return substr(_h($r['fname']),0,1).'. '.substr(_h($r['lname']),0,1).'.';
		} else {
			return _h($r['lname']).', '.substr(_h($r['fname']),0,1).'.';
		}
    }
    
    function hasAppl($id) {
        $bind = array( ":id" => $id );
        $q = DB::inst()->select( "application","personID = :id","","*",$bind );
        foreach($q as $r) {
            $array[] = $r;
        }
        return _h($r['personID']);
    }
    
    function getStuSec($code,$term) {
        $auth = new \eduTrac\Classes\Libraries\Cookies;
		$bind = [ ":id" => $auth->getPersonField('personID'),":code" => $code,":term" => $term ];
        $q = DB::inst()->query( "SELECT * FROM stu_course_sec WHERE stuID = :id AND courseSecCode = :code AND termCode = :term",$bind );
        if(count($q) > 0) {
            return ' style="display:none;"';
        }
    }
    
    function isRegistrationOpen() {
        if(Hooks::get_option('open_registration') == 0) {
            return ' style="display:none;"';
        }
    }
    
    /**
     * Graduated Status: if the status on a student's program 
	 * is "G", then the status and status dates are disabled.
	 * 
	 * @since 1.0.0
     * @param string
	 * @return mixed
	 */
    function gs($s) {
        if($s == 'G') {
            return ' readonly="readonly"';
        }
    }
    
    function calculateGradePoints($grade) {
    	$bind = [ ":grade" => $grade ];
		$q = DB::inst()->select( "grade_scale","grade = :grade","","points",$bind );
		foreach($q as $r) {
			$gradePoints = $r['points'];
		}
        return $gradePoints;
    }
	
	/**
	 * Save Query: shows a list of saved queries 
	 * for a particular user.
	 * 
	 * @since 1.0.0
	 * @return mixed
	 */
	function save_query_dropdown() {
		$auth = new \eduTrac\Classes\Libraries\Cookies;
		$q = DB::inst()->query( "SELECT * FROM saved_query WHERE personID = '".$auth->getPersonField('personID')."'" );
		foreach( $q as $k => $v ) {
	      	echo '<option value="'._h($v['savedQueryID']).'">'._h($v['savedQueryName']).'</option>' . "\n";
		}
	}

	function getAge($birthdate, $pattern = 'mysql')
	{
	    $patterns = array(
	        'eu'    => 'd/m/Y',
	        'mysql' => 'Y-m-d',
	        'us'    => 'm/d/Y',
	    );
	
	    $now      = new \DateTime();
	    $in       = \DateTime::createFromFormat($patterns[$pattern], $birthdate);
	    $interval = $now->diff($in);
	    return $interval->y;
	}
    
    /**
     * Function to help with SQL injection when using SQL terminal 
     * and the saved query screens.
     */
    function strstra($haystack, $needles=array(), $before_needle=false) {
        $chr = array();
        foreach($needles as $needle) {
                $res = strstr($haystack, $needle, $before_needle);
                if ($res !== false) $chr[$needle] = $res;
        }
        if(empty($chr)) return false;
        return min($chr);
    }
	
	function get_subjName($id) {
		$q = DB::inst()->query( "SELECT subjCode FROM subject WHERE subjectID = '$id'" );
		$r = $q->fetch();
		return _h($r['subjCode']);
	}
	
	function print_gzipped_page() {
	
	    global $HTTP_ACCEPT_ENCODING;
	    if( headers_sent() ){
	        $encoding = false;
	    }elseif( strpos($HTTP_ACCEPT_ENCODING, 'x-gzip') !== false ){
	        $encoding = 'x-gzip';
	    }elseif( strpos($HTTP_ACCEPT_ENCODING,'gzip') !== false ){
	        $encoding = 'gzip';
	    }else{
	        $encoding = false;
	    }
	
	    if( $encoding ){
	        $contents = ob_get_contents();
	        ob_end_clean();
	        header('Content-Encoding: '.$encoding);
	        print("\x1f\x8b\x08\x00\x00\x00\x00\x00");
	        $size = strlen($contents);
	        $contents = gzcompress($contents, 9);
	        $contents = substr($contents, 0, $size);
	        print($contents);
	        exit();
	    } else {
	        ob_end_flush();
	        exit();
	    }
	}
	
	function get_user_avatar($email, $s = 80, $class = '', $d = 'mm', $r = 'g', $img = false) {
	    $url = 'http://www.gravatar.com/avatar/';
        $url .= md5( strtolower( trim( $email ) ) );
        $url .= "?s=200&d=$d&r=$r";
		$avatarsize = getimagesize($url);
		$avatar = '<img src="' . $url . '" ' . imgResize($avatarsize[1],  $avatarsize[1], $s) . ' class="'.$class .'" />';
		return Hooks::apply_filter('user_avatar', $avatar, $email, $s);
	}
	
	function getuserdata($id,$field) {
		$bind = [ ":id" => $id ];
		$q = DB::inst()->query( "SELECT 
						a.*,
						b.*,
						c.short_name,
						d.code,
						e.* 
					FROM 
						person a 
					LEFT JOIN address b ON a.personID = b.personID 
					LEFT JOIN country c ON b.country = c.iso2 
					LEFT JOIN state d ON b.state = d.code 
					LEFT JOIN staff e ON a.personID = e.staffID 
					WHERE 
						a.personID = :id 
					AND 
						b.startDate = (SELECT MAX(startDate) FROM address WHERE personID = :id)",
					$bind 
		);
		foreach($q as $r) {
			return $r[$field];
		}
	}
    
    function student_can_register() {
        $auth = new \eduTrac\Classes\Libraries\Cookies;
        $bind1 = [ ":term" => Hooks::get_option('registration_term'), ":stuID" => $auth->getPersonField('personID') ];
        $q = DB::inst()->query( "SELECT 
                        COUNT(courseSecCode) AS Courses 
                    FROM 
                        stu_course_sec 
                    WHERE 
                        stuID = :stuID 
                    AND 
                        termCode = :term 
                    AND 
                    	status IN('A','N') 
                    GROUP BY 
                        stuID,termCode",
                    $bind1 
        );
        foreach($q as $r) {
            $courses = $r['Courses'];
        }
        
        $bind2 = [ ":stuID" => $auth->getPersonField('personID'), ":today" => date('Y-m-d') ];
        $sql1 = DB::inst()->query( "SELECT 
                        * 
                    FROM 
                        restriction 
                    WHERE 
                        severity = '99' 
                    AND 
                        stuID = :stuID 
                    AND 
                        endDate = '0000-00-00' 
                    OR 
                        endDate > :today",
                    $bind2 
        );
        
        $bind3 = [ ":id" => $auth->getPersonField('personID') ];
        $sql2 = DB::inst()->select("student","stuID=:id","","ID",$bind3);
        
        if($courses != NULL && $courses >= Hooks::get_option('number_of_courses')) {
            return false;
        } elseif(count($sql1) > 0) {
            return false;
		} elseif(count($sql2) <= 0) {
            return false;
        } else {
            return true;
        }
    }

    function has_balance($id,$term) {
        $bind = [ ":stuID" => $id,":term" => $term ];
        
        $q1 = DB::inst()->query( "SELECT 
                        SUM(b.amount) AS Bill 
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
                        c.termCode = :term 
                    GROUP BY 
                        c.stuID,c.termCode",
                    $bind 
        );
        
        foreach($q1 as $r1) {
            $beginBalance = $r1['Bill'];
        }
        
        $q2 = DB::inst()->query( "SELECT 
                        SUM(a.courseFee) AS CourseFee,
                        SUM(a.labFee) AS LabFee,
                        SUM(a.materialFee) AS MaterialFee 
                    FROM 
                        course_sec a 
                    LEFT JOIN 
                        stu_acad_cred b 
                    ON 
                        a.termCode = b.termCode 
                    WHERE 
                        b.stuID = :stuID 
                    AND 
                        a.termCode = :term 
                    AND 
                        a.courseSecCode = b.courseSecCode 
                    GROUP BY 
                        b.stuID,b.termCode,b.courseSecCode",
                    $bind 
        );
        
        foreach($q2 as $r2) {
            $courseFees = $r2['CourseFee']+$r2['LabFee']+$r2['MaterialFee'];
        }
        
        $q3 = DB::inst()->query( "SELECT 
                        SUM(amount) AS 'Payment' 
                    FROM 
                        payment 
                    WHERE 
                        stuID = :stuID 
                    AND 
                        termCode = :term 
                    GROUP BY 
                        stuID,termCode",
                    $bind 
        );
        
        foreach($q3 as $r3) {
            $payment = $r3['Payment'];
        }
        
        $q4 = DB::inst()->query( "SELECT 
                        SUM(amount) AS 'Refund' 
                    FROM 
                        refund 
                    WHERE 
                        stuID = :stuID 
                    AND 
                        termCode = :term 
                    GROUP BY 
                        stuID,termCode",
                    $bind 
        );
        
        foreach($q4 as $r4) {
            $refund = $r4['Refund'];
        }
        
        $startBalance = bcadd($beginBalance,$courseFees,2);
        $endBalance = bcsub($payment,$startBalance,2);
        $currentBalance = bcsub($endBalance,$refund,2);
        
        if($currentBalance < 0) {
            return ' style="color:red"';
        }
    }
	
	function success_update() {
		$message = '<div class="alert alert-success">';
				$message .= '<strong>'._t('Success!').'</strong> '._t( 'The record was updated successfully.');
		$message .= '</div>';
		return $message;
	}
	
	function error_update() {
		$message = '<div class="alert alert-danger">';
				$message .= '<strong>'._t('Error!').'</strong> '._t( 'The system was unable to update the record in the database. Please try again. If the problem persists, contact your system administrator.');
		$message .= '</div>';
		return $message;
	}
	
	function percent($num_amount, $num_total) {
		$count1 = $num_amount / $num_total;
		$count2 = $count1 * 100;
		$count = number_format($count2, 0);
		return $count;
	}
	
	function timeAgo($original) {
	    // array of time period chunks
	    $chunks = array(
	    array(60 * 60 * 24 * 365 , 'year'),
	    array(60 * 60 * 24 * 30 , 'month'),
	    array(60 * 60 * 24 * 7, 'week'),
	    array(60 * 60 * 24 , 'day'),
	    array(60 * 60 , 'hour'),
	    array(60 , 'min'),
	    array(1 , 'sec'),
	    );
	 
	    $today = time(); /* Current unix time  */
	    $since = $today - $original;
	 
	    // $j saves performing the count function each time around the loop
	    for ($i = 0, $j = count($chunks); $i < $j; $i++) {
	 
	    $seconds = $chunks[$i][0];
	    $name = $chunks[$i][1];
	 
	    // finding the biggest chunk (if the chunk fits, break)
		    if (($count = floor($since / $seconds)) != 0) {
		        break;
		    }
	    }
	 
	    $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
	 
	    if ($i + 1 < $j) {
	    // now getting the second item
	    $seconds2 = $chunks[$i + 1][0];
	    $name2 = $chunks[$i + 1][1];
	 
	    // add second item if its greater than 0
		    if (($count2 = floor(($since - ($seconds * $count)) / $seconds2)) != 0) {
		        $print .= ($count2 == 1) ? ', 1 '.$name2 : " $count2 {$name2}s";
		    }
	    }
	    return $print;
	}
    
    function upgradeSQL($file, $delimiter = ';')
    {
        set_time_limit(0);
    
        if (is_file($file) === true)
        {
            $file = fopen($file, 'r');
    
            if (is_resource($file) === true)
            {
                $query = array();
    
                while (feof($file) === false)
                {
                    $query[] = fgets($file);
    
                    if (preg_match('~' . preg_quote($delimiter, '~') . '\s*$~iS', end($query)) === 1)
                    {
                        $query = trim(implode('', $query));
    
                        if (DB::inst()->query($query) === false)
                        {
                            echo '<p><font color="red">ERROR:</font> ' . $query . '</p>' . "\n";
                        }
    
                        else
                        {
                            echo '<p><font color="green">SUCCESS:</font> ' . $query . '</p>' . "\n";
                        }
    
                        while (ob_get_level() > 0)
                        {
                            ob_end_flush();
                        }
    
                        flush();
                    }
    
                    if (is_string($query) === true)
                    {
                        $query = array();
                    }
                }
    
                fclose($file);
				redirect( BASE_URL . 'upgrade/' );
            }
        }
    }
    
    function remoteFileExists($url) {
        $curl = curl_init($url);
    
        //don't fetch the actual page, you only want to check the connection is ok
        curl_setopt($curl, CURLOPT_NOBODY, true);
    
        //do request
        $result = curl_exec($curl);
    
        $ret = false;
    
        //if request did not fail
        if ($result !== false) {
            //if request was ok, check response code
            $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);  
    
            if ($statusCode == 200) {
                $ret = true;   
            }
        }
    
        curl_close($curl);

    return $ret;
    
    }
    
    function redirect_upgrade_db() {
        $auth = new Cookies;
        $acl = new \eduTrac\Classes\Libraries\ACL($auth->getPersonField('personID'));
        if($acl->userHasRole(8)) {
            if(CURRENT_VERSION == getCurrentVersion(0)) {
                if(Hooks::get_option('dbversion') < upgradeDB(0)) {
                    if (basename($_SERVER["REQUEST_URI"]) != "upgrade") {
                        redirect(BASE_URL . 'upgrade/');
                    }
                }
            }
        }
    }
    
    function templates($name) {
        $bind = array(":email" => $name);
        $q = DB::inst()->select( "email_template","email_name = :email","","email_value",$bind );
        if($q) {
            while($r = $q->fetch(\PDO::FETCH_ASSOC)) {
                return _h($r['email_value']);
            }
        }
    }
    
    function sysMailer() {
        $q = DB::inst()->query( "SELECT email, fname, lname FROM person ORDER BY lname" );
        if($q->num_rows > 0) {
            while($r = $q->fetch(\PDO::FETCH_ASSOC)) {
                echo '<option value="'._h($r['email']).'">'._h($r['lname']).', '._h($r['fname']).'</option>'."\n";
            }
        }
    }
    
    function head_version_meta() {
        echo "<meta name='generator' content='eduTrac ERP " . CURRENT_VERSION . "'>\n";
    }
    
    function foot_version() {
        echo "v". CURRENT_VERSION;
    }
	
	function et_hash_password($password) {
		// By default, use the portable hash from phpass
		$hasher = new \eduTrac\Classes\Libraries\PasswordHash(8, FALSE);
	
			return $hasher->HashPassword($password);
	}
	 
	function et_check_password($password, $hash, $person_id = '') {
		// If the hash is still md5...
		if ( strlen($hash) <= 32 ) {
			$check = ( $hash == md5($password) );
			if ( $check && $person_id ) {
				// Rehash using new hash.
				et_set_password($password, $person_id);
				$hash = et_hash_password($password);
			}
			return Hooks::apply_filter('check_password', $check, $password, $hash, $person_id);
		}
		
		// If the stored hash is longer than an MD5, presume the
		// new style phpass portable hash.
		$hasher = new \eduTrac\Classes\Libraries\PasswordHash(8, FALSE);
		
		$check = $hasher->CheckPassword($password, $hash);
		
			return Hooks::apply_filter('check_password', $check, $password, $hash, $person_id);
	}
	 
	function et_set_password( $password, $person_id ) {
		$hash = et_hash_password($password);
		DB::inst()->update( "person", array( 'password' => $hash ), array( 'personID', $person_id ));
	}
	
	function et_hash_cookie($cookie) {
		// By default, use the portable hash from phpass
		$hasher = new \eduTrac\Classes\Libraries\PasswordHash(8, TRUE);

			return $hasher->HashPassword($cookie);
	}
	 
	function et_authenticate_cookie($cookie, $cookiehash, $person_id = '') {

		$hasher = new \eduTrac\Classes\Libraries\PasswordHash(8, TRUE);

		$check = $hasher->CheckPassword($cookie, $cookiehash);

			return Hooks::apply_filter('authenticate_cookie', $check, $cookie, $cookiehash, $person_id);
	}