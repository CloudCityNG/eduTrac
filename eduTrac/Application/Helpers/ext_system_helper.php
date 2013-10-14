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
 * @since       1.0.0
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */

use \eduTrac\Classes\Core\DB;
use \eduTrac\Classes\Libraries\Hooks;
use \eduTrac\Classes\Libraries\Log;
use \eduTrac\Classes\Libraries\Cookies;
 	
    /**{
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
                    a.deptID 
                FROM 
                    email_template a 
                LEFT JOIN 
                    staff b 
                ON 
                    a.deptID = b.deptID 
                LEFT JOIN 
                    faculty c
                ON 
                    a.deptID = c.deptID 
                WHERE 
                    b.staffID = :id 
                OR 
                    c.facID = :id",
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
	 * @since 1.0,0
	 * @param string $semesterID - optional
	 * @return string Returns the record key if selected is true.
	 */
	function semester_dropdown($semID = NULL) {
        $q = DB::inst()->select( "semester","","acadYearCode","semesterID,semCode,semName" );
		foreach( $q as $k => $v ) {
	      	echo '<option value="'._h($v['semesterID']).'"'.selected( $semID, _h($v['semesterID']), false ).'>'._h($v['semCode']).' '._h($v['semName']).'</option>' . "\n";
		}
	}
	
	/**
	 * Subject dropdown: shows general list of subjects and
	 * if $subjectID is not NULL, shows the subject attached 
	 * to a particular record.
	 * 
	 * @since 1.0.0
	 * @param string $subjectID - optional
	 * @return string Returns the record key if selected is true.
	 */
	function subject_id_dropdown($subjectID = NULL) {
        $q = DB::inst()->select( "subject","","subjectID","subjectID,subjCode,subjName" );
		
		foreach( $q as $k => $v ) {
	      	echo '<option value="'._h($v['subjectID']).'"'.selected( $subjectID, _h($v['subjectID']), false ).'>'._h($v['subjCode']).' '._h($v['subjName']).'</option>' . "\n";
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
        $q = DB::inst()->select( "faculty","","facID","facID" );
        
        foreach( $q as $k => $v ) {
            echo '<option value="'._h($v['facID']).'"'.selected( $facID, _h($v['facID']), false ).'>'.get_name(_h($v['facID'])).'</option>' . "\n";
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
    function table_dropdown($table, $where = NULL, $id, $code, $name, $activeID = NULL) {
        $q = DB::inst()->select( $table,$where,$id,"$id,$code,$name" );
        
        foreach( $q as $k => $v ) {
            echo '<option value="'._h($v[$id]).'"'.selected( $activeID, _h($v[$id]), false ).'>'._h($v[$code]).' '._h($v[$name]).'</option>' . "\n";
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
        $select = '<select style="width:30%;" name="addressType" id="select2_10" required>
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
        $select = '<select style="width:50%;" name="deptTypeCode" id="select2_22" required>
            <option value="">&nbsp;</option>
            <option value="admin"'.selected( $typeCode, 'admin', false ).'>Administrative</option>
            <option value="acad"'.selected( $typeCode, 'acad', false ).'>Academic</option>
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
		$select = '<select style="width:25%;" name="addressStatus" id="select2_9" required>
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
    function acad_level_select($levelCode = NULL, $readonly = null) {
        $select = '<select style="width:100%;" name="acadLevelCode" id="select2_18"'.$readonly.' required>
            <option value="">&nbsp;</option>
            <option value="NA"'.selected( $levelCode, 'NA', false ).'>N/A Not Applicable</option>
            <option value="ES"'.selected( $levelCode, 'ES', false ).'>ES Elementary School</option>
            <option value="MS"'.selected( $levelCode, 'MS', false ).'>MS Middle School</option>
            <option value="HS"'.selected( $levelCode, 'HS', false ).'>HS High School</option>
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
		$select = '<select style="width:100%;" name="currStatus" id="select2_9" required>
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
		$select = '<select style="width:100%;" name="currStatus" id="select2_9" required>
    			<option value="">&nbsp;</option>
    	    	<option value="A"'.selected( $status, 'A', false ).'>A Active</option>
    	    	<option value="I"'.selected( $status, 'I', false ).'>I Inactive</option>
    			<option value="P"'.selected( $status, 'P', false ).'>P Pending</option>
    			<option value="C"'.selected( $status, 'C', false ).'>C Cancel</option>
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
        $select = '<select style="width:30%;" name="personType" id="select2_9" required>
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
		$select = '<select style="width:100%;" name="courseLevelCode" required id="select2_21"'.$readonly.'>
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
        $select = '<select style="width:60%;" name="instructorMethod" id="select2_9" required>
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
        $select = '<select style="width:60%;" name="status" id="select2_9" required>
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
        $select = '<select style="width:60%;" name="currStatus" id="select2_9" required>
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
        $select = '<select style="width:60%;" name="status" id="select2_9" required>
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
        $select = '<select style="width:60%;" name="classYear" id="select2_9" required>
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
        $select = '<select style="width:25%;" name="grade[]" required>
                <option value="">&nbsp;</option>
                <option value="' . _t('A') . '"'.selected( $grade, _t('A'), false ).'>' . _t('A') . '</option>
                <option value="' . _t('B') . '"'.selected( $grade, _t('B'), false ).'>' . _t('B') . '</option>
                <option value="' . _t('C') . '"'.selected( $grade, _t('C'), false ).'>' . _t('C') . '</option>
                <option value="' . _t('D') . '"'.selected( $grade, _t('D'), false ).'>' . _t('D') . '</option>
                <option value="' . _t('F') . '"'.selected( $grade, _t('F'), false ).'>' . _t('F') . '</option>
                <option value="' . _t('W') . '"'.selected( $grade, _t('W'), false ).'>' . _t('W') . '</option>
                <option value="' . _t('I') . '"'.selected( $grade, _t('I'), false ).'>' . _t('I') . '</option>
                </select>';
        return Hooks::apply_filter('grading_scale', $select, $grade);
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
        $select = '<select style="width:25%;" name="admitStatus" id="select2_18">
                <option value="">&nbsp;</option>
                <option value="' . _t('FF') . '"'.selected( $status, _t('FF'), false ).'>' . _t('FF First Time Freshman') . '</option>
                <option value="' . _t('TR') . '"'.selected( $status, _t('TR'), false ).'>' . _t('TR Transfer') . '</option>
                <option value="' . _t('RA') . '"'.selected( $status, _t('RA'), false ).'>' . _t('RA Readmit') . '</option>
                <option value="' . _t('NA') . '"'.selected( $status, _t('NA'), false ).'>' . _t('NA Non-Applicable') . '</option>
                </select>';
        return Hooks::apply_filter('admit_status', $select, $status);
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
            "create","delete","drop","alter","update",
            "insert","change","convert","modifies",
            "optimize","purge","rename","replace",
            "revoke","unlock","truncate","anything",
            "svc","write","into","--","1=1","1 = 1","\\",
            "+","?","'x'","loop","exit","leave","undo",
            "upgrade","update","html","script","css",
            "x=x","x = x","everything","anyone","everyone",
            "upload","&","&amp;","xp_","$","0=0","0 = 0",
            "X=X","X = X","union","'='","XSS","mysql_error",
            "die","password","auth_token","alert","img","src"
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
    
    function hasAppl($id) {
        $bind = array( ":id" => $id );
        $q = DB::inst()->select( "application","personID = :id","","*",$bind );
        foreach($q as $r) {
            $array[] = $r;
        }
        return _h($r['personID']);
    }
    
    function getStuSec($csID) {
        $auth = new \eduTrac\Classes\Libraries\Cookies;
        $id = $auth->getPersonField('personID');
        $q = DB::inst()->query( "SELECT * FROM stu_course_sec WHERE stuID = '$id' AND courseSecID = '$csID'" );
        if($q->rowCount() > 0) {
            return ' style="display:none;';
        }
    }
    
    function isRegistrationOpen() {
        if(Hooks::get_option('open_registration') == 0) {
            return ' style="display:none;';
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
    
    function calculateGradePoints($letterGrade) {
        if($letterGrade == 'A') {
            $gradePoints = 4;
        } elseif ($letterGrade == 'B') {
            $gradePoints = 3;                                                                         
        } elseif ($letterGrade == 'C')  {
            $gradePoints = 2;                                                                        
        } elseif ($letterGrade == 'D')  {
            $gradePoints = 1;                                                                           
        } else {
            $gradePoints = 0;                                                                          
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
	
	/*function course_grid($cid,$sid) {
		$query1 = DB::inst()->select( TP. "school", "*", "school_id = '$sid'", null );
		
		while($numperiods = $query1->fetch(\PDO::FETCH_ASSOC)) {
			
			 for($i=1; $i<=$numperiods['numperiods']; $i++) {
			  // Clear re-used variables for the new row //
			  $tablerow = "";
			  $sunday = "<td>";
			  $monday = "<td>";
			  $tuesday = "<td>";
			  $wednesday = "<td>";
			  $thursday = "<td>";
			  $friday = "<td>";
			  $saturday = "<td>";
			
			  print("<tr class=\"gradeX\"> <td>$i</td>");
			  
			  $query2 = DB::inst()->query("SELECT coursename, facultyid, semesterid, sectionnum, roomnum, periodnum, dotw FROM "."course WHERE periodnum = '$i' AND courseid = '$cid'");
			
			  while( $class = $query2->fetch(\PDO::FETCH_ASSOC) ) {
			   $days = preg_split('//', $class[6], -1, PREG_SPLIT_NO_EMPTY);
			
			   for($j=0; $j<count($days); $j++) {
				switch($days[$j]) {
				case 'N':
			   $q = DB::inst()->query("SELECT fname, lname FROM "."faculty WHERE facid = '" . clean($class[1]) . "'");
			   $teacher = $q->fetch(\PDO::FETCH_ASSOC);
			
			   $sunday .= "<b>$class[0]</b><br />
			   Section: $class[3]<br />
			   Room: $class[4]<br />
			   Teacher: $teacher[0] $teacher[1]";
			
			   if($sunday != "<td>")
			 $sunday .= "<br /><br />";
			   else
				 $sunday .= "<br />";
				   break;
			 case 'M':
			   $q = DB::inst()->query("SELECT fname, lname FROM "."faculty WHERE facid = '" . clean($class[1]) . "'");
			   $teacher = $q->fetch(\PDO::FETCH_ASSOC);
			
			   $monday .= "<b>$class[0]</b><br />
			   Section: $class[3]<br />
			   Room: $class[4]<br />
			   Teacher: $teacher[0] $teacher[1]";
			
			   if($monday != "<td>")
			 $monday .= "<br /><br />";
			   else
				 $monday .= "<br />";
				   break;
			 case 'T':
			   $q = DB::inst()->query("SELECT fname, lname FROM "."faculty WHERE facid = '" . clean($class[1]) . "'");
			   $teacher = $q->fetch(\PDO::FETCH_ASSOC);
			
			   $tuesday .= "<b>$class[0]</b><br />
			   Section: $class[3]<br />
			   Room: $class[4]<br />
			   Teacher: $teacher[0] $teacher[1]";
			   if($tuesday != "<td>")
			 $tuesday .= "<br /><br />";
			   else
				 $tuesday .= "<br />";
			
				   break;
			 case 'W':
			   $q = DB::inst()->query("SELECT fname, lname FROM "."faculty WHERE facid = '" . clean($class[1]) . "'");
			   $teacher = $q->fetch(\PDO::FETCH_ASSOC);
			
			   $wednesday .= "<b>$class[0]</b><br />
			   Section: $class[3]<br />
			   Room: $class[4]<br />
			   Teacher: $teacher[0] $teacher[1]";
			   if($wednesday != "<td>")
			 $wednesday .= "<br /><br />";
			   else
				 $wednesday .= "<br />";
				   break;
			 case 'H':
			   $q = DB::inst()->query("SELECT fname, lname FROM "."faculty WHERE facid = '" . clean($class[1]) . "'");
			   $teacher = $q->fetch(\PDO::FETCH_ASSOC);
			
			   $thursday .= "<b>$class[0]</b><br />
			   Section: $class[3]<br />
			   Room: $class[4]<br />
			   Teacher: $teacher[0] $teacher[1]";
			   if($thursday != "<td>")
			 $thursday .= "<br /><br />";
			   else
				 $thursday .= "<br />";
				   break;
			 case 'F':
			   $q = DB::inst()->query("SELECT fname, lname FROM "."faculty WHERE facid = '" . clean($class[1]) . "'");
			   $teacher = $q->fetch(\PDO::FETCH_ASSOC);
			
			   $friday .= "<b>$class[0]</b><br />
			   Section: $class[3]<br />
			   Room: $class[4]<br />
			   Teacher: $teacher[0] $teacher[1]";
			   if($friday != "<td>")
			 $friday .= "<br /><br />";
			   else
				 $friday .= "<br />";
					   break;
			case 'S':
			   $q = DB::inst()->query("SELECT fname, lname FROM "."faculty WHERE facid = '" . clean($class[1]) . "'");
			   $teacher = $q->fetch(\PDO::FETCH_ASSOC);
			
			   $saturday .= "<b>$class[0]</b><br />
			   Section: $class[3]<br />
			   Room: $class[4]<br />
			   Teacher: $teacher[0] $teacher[1]";
			
			   if($saturday != "<td>")
			 $saturday .= "<br /><br />";
			   else
				 $saturday .= "<br />";
					   break;
				}
			   }
			  }
			
			  $tablerow = $sunday . "&nbsp;</td>" . $monday . "&nbsp;</td>" . $tuesday . "&nbsp;</td>" . $wednesday . "&nbsp;</td>" . $thursday . "&nbsp;</td>" . $friday . "&nbsp;</td>" . $saturday . "&nbsp;</td>";
			
			  print($tablerow);
			
			  print("</tr>");
			 }
		 }
	}*/
	
	function get_user_avatar($email, $size = 100) {
		$avatarsize = getimagesize("http://www.gravatar.com/avatar/".md5($email).'?s=200');
		$avatar = '<img src="http://www.gravatar.com/avatar/' . md5($email).'?s=200' . '" ' . imgResize($avatarsize[1],  $avatarsize[1], $size) . ' />';
		return Hooks::apply_filter('user_avatar', $avatar, $email, $size);
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
    
                return fclose($file);
            }
        }
    
        return false;
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
    
    function getCurrentVersion($array) {
        $version = explode("\n", file_get_contents('http://api.7mediaws.org/upgrades/version.txt'));
        return Hooks::apply_filter( 'get_current_version', $version[$array] );
    }
    
    function upgradeDB($array) {
    	$upgrade = explode("\n", file_get_contents('http://api.7mediaws.org/upgrades/dbversion.txt'));
		return Hooks::apply_filter( 'upgrade_db', $upgrade[$array] );
	}
    
    function show_update_message() {
        $auth = new Cookies;
        $acl = new \eduTrac\Classes\Libraries\ACL($auth->getPersonField('personID'));
        if($acl->userHasRole(8)) {
            if(CURRENT_ET_VERSION < getCurrentVersion(0)) {
                $alert = 
                    '<!-- Alert -->
    				<div class="success">
						<strong>'._t( 'Update!' ).'</strong> '._t( 'Hey admin, there is a new eduTrac update. 
                        <a href="http://www.7mediaws.org/client/">Click here</a> to download it. Also feel free to check out
                        the <a href="#myModal" data-toggle="modal">changelog</a>.' ).'
					</div>
					<!-- // Alert END -->
					
					<div class="modal hide fade" id="myModal">
                        <div class="modal-body">'.
                            file_get_contents( "http://api.7mediaws.org/upgrades/changelog.txt" )
                        .'</div>
                        <div class="modal-footer">
                            <a href="#" data-dismiss="modal" class="btn btn-primary">'._t( 'Cancel' ).'</a>
                        </div>
                    </div>';
            }
        }
        return $alert;
	}
    
    function redirect_upgrade_db() {
        $auth = new Cookies;
        $acl = new \eduTrac\Classes\Libraries\ACL($auth->getPersonField('personID'));
        if($acl->userHasRole(8)) {
            if(CURRENT_ET_VERSION == getCurrentVersion(0)) {
                if(Hooks::get_option('dbversion') < upgradeDB(0)) {
                    redirect(BASE_URL . 'upgrade/');
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
        echo "<meta name='generator' content='eduTrac " . CURRENT_ET_VERSION . "'>\n";
    }
    
    function foot_version() {
        echo "v". CURRENT_ET_VERSION;
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
