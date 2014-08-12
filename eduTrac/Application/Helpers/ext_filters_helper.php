<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * eduTrac ERP Filters Helper
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
 * @since       4.0.0
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */
	
use \eduTrac\Classes\Core\DB;
use \eduTrac\Classes\Libraries\Hooks;
use \eduTrac\Classes\Libraries\Cookies;

	/**
	* Retrieves logged in users country and state.
	*
	* @since 4.0.0
	*/
	function dashboard_location($id) {
		$location = '<p><a href="#">@ '.getuserdata($id,'short_name').', '.getuserdata($id,'code').'</a></p>';
		return Hooks::apply_filter('dashboard_location', $location);
	}
	
	/**
	 * Shows number of courses the student is registered for 
	 * or has taken with the institution.
	 *
	 * @since 4.0.0
	 */
	function profile_course_stat() {
		$auth = new \eduTrac\Classes\Libraries\Cookies;
		$array = [];
		$bind = [ ":id" => $auth->getPersonField('personID') ];
		$q = DB::inst()->select( "stu_acad_cred","stuID=:id AND grade=''","","COUNT(stuAcadCredID)",$bind );
		foreach($q as $r) {
			$array[] = $r;
		}
		if($q <= 0) {
			$courseStat = 0;
		} else {
			$courseStat = $r['COUNT(stuAcadCredID)'];
		}
		return Hooks::apply_filter('profile_course_stat', $courseStat);
	}
	
	/**
	 * Shows student's GPA.
	 *
	 * @since 4.0.0
	 */
	function profile_gpa_stat() {
		$auth = new \eduTrac\Classes\Libraries\Cookies;
		$array = [];
		$bind = [ ":id" => $auth->getPersonField('personID') ];
		$q = DB::inst()->select( "stu_acad_cred","stuID=:id","","SUM(compCred*gradePoints)/SUM(compCred) AS GPA",$bind );
		foreach($q as $r) {
			$array[] = $r;
		}
		if(_h($r['GPA']) <= 0) {
			$gpaStat = _t( 'N/A' );
		} else {
			$gpaStat = _h($r['GPA']);
		}
		return Hooks::apply_filter('profile_gpa_stat', $gpaStat);
	}
	
	/**
	* Shows number of active students.
	*
	* @since 4.0.0
	*/
	function dashboard_student_count() {
		$array = [];
		$q = DB::inst()->select( "student","status='A'","","COUNT(stuID)" );
		foreach($q as $r) {
			$array[] = $r;
		}
		$stuCount = '<div class="col-md-4">';
			$stuCount .= '<a href="#" class="widget-stats widget-stats-1 widget-stats-inverse">';
				$stuCount .= '<span class="glyphicons group"><i></i><span class="txt">'._t( 'Active Students' ).'</span></span>';
				$stuCount .= '<div class="clearfix"></div>';
				$stuCount .= '<span class="count">'.$r['COUNT(stuID)'].'</span>';
			$stuCount .= '</a>';
		$stuCount .= '</div>';
		echo Hooks::apply_filter('dashboard_student_count', $stuCount);
	}
	
	/**
	* Shows number of active courses.
	*
	* @since 4.0.0
	*/
	function dashboard_course_count() {
		$array = [];
		$q = DB::inst()->select( "course","currStatus='A' && endDate = '0000-00-00'","","COUNT(courseID)" );
		foreach($q as $r) {
			$array[] = $r;
		}
		$crseCount = '<div class="col-md-4">';
			$crseCount .= '<a href="#" class="widget-stats widget-stats-1 widget-stats-inverse">';
				$crseCount .= '<span class="glyphicons book"><i></i><span class="txt">'._t( 'Active Courses' ).'</span></span>';
				$crseCount .= '<div class="clearfix"></div>';
				$crseCount .= '<span class="count">'.$r['COUNT(courseID)'].'</span>';
			$crseCount .= '</a>';
		$crseCount .= '</div>';
		echo Hooks::apply_filter('dashboard_course_count', $crseCount);
	}
	
	/**
	* Shows number of active academic programs.
	*
	* @since 4.0.0
	*/
	function dashboard_acadProg_count() {
		$array = [];
		$q = DB::inst()->select( "acad_program","currStatus='A' && endDate = '0000-00-00'","","COUNT(acadProgID)" );
		foreach($q as $r) {
			$array[] = $r;
		}
		$crseCount = '<div class="col-md-4">';
			$crseCount .= '<a href="#" class="widget-stats widget-stats-1 widget-stats-inverse">';
				$crseCount .= '<span class="glyphicons keynote"><i></i><span class="txt">'._t( 'Active Programs' ).'</span></span>';
				$crseCount .= '<div class="clearfix"></div>';
				$crseCount .= '<span class="count">'.$r['COUNT(acadProgID)'].'</span>';
			$crseCount .= '</a>';
		$crseCount .= '</div>';
		echo Hooks::apply_filter('dashboard_course_count', $crseCount);
	}
	
	/**
	* Shows clock on the dashboard.
	*
	* @since 4.0.0
	*/
	function dashboard_clock() {
		$clock = '<section class="panel">';
				$clock .= '<div class="widget-clock">';
						$clock .= '<div id="clock"></div>';
				$clock .= '</div>';
		$clock .= '</section>'."\n";
		echo Hooks::apply_filter('dashboard_clock', $clock);
	}
	
	/**
	* Shows weather on dashboard.
	*
	* @since 4.0.0
	*/
	function dashboard_weather() {
        if(_h(Hooks::{'get_option'}( 'wwo_key' )) != '') {
            $parameters['url'] = BASE_URL.'eduTrac/Classes/Libraries/Weather';
            $parameters['apiKey'] = _h(Hooks::{'get_option'}( 'wwo_key' ));
            $parameters['location'] = _h(Hooks::{'get_option'}( 'location' ));
            $parameters['autoDetect'] = _h(Hooks::{'get_option'}( 'autodetect_location' ));
            $parameters['detectType'] = _h(Hooks::{'get_option'}( 'autodetect_type' ));
            $parameters['degreesUnits'] = _h(Hooks::{'get_option'}( 'degree_units' ));
            $parameters['windUnits'] = _h(Hooks::{'get_option'}( 'wind_units' ));
            $parameters['curl'] = _h(Hooks::{'get_option'}( 'curl' ));
            $JBW = new \eduTrac\Classes\Libraries\Weather\JBWeather();
            echo '<section class="panel">';
                    $weather =$JBW->setParams($parameters);
                    $weather .=$JBW->display();
            echo '</section>'."\n";
            echo Hooks::apply_filter('dashboard_weather', $weather);
        }
    }

	function getCurrentVersion($array) {
	    // Create the stream context
        $context = stream_context_create(array(
            'http' => array(
            'timeout' => 2      // Timeout in seconds
            )
        ));
        $version = explode("\n", file_get_contents('http://api.7mediaws.org/upgrades/com-version.txt',false,$context));
        return Hooks::apply_filter( 'get_current_version', $version[$array] );
    }
    
    function upgradeDB($array) {
        // Create the stream context
        $context = stream_context_create(array(
            'http' => array(
            'timeout' => 2      // Timeout in seconds
            )
        ));
    	$upgrade = explode("\n", file_get_contents('http://api.7mediaws.org/upgrades/com-dbversion.txt',false,$context));
		return Hooks::apply_filter( 'upgrade_db', $upgrade[$array] );
	}
	
	/**
	 * Shows update message when a new version of 
	 * eduTrac ERP is available.
	 *
	 * @since 4.0.0
	 */
	function show_update_message() {
		// Create the stream context
        $context = stream_context_create(array(
            'http' => array(
            'timeout' => 2      // Timeout in seconds
            )
        ));
        $auth = new Cookies;
        $acl = new \eduTrac\Classes\Libraries\ACL($auth->getPersonField('personID'));
        if($acl->userHasRole(8)) {
            if(CURRENT_VERSION < getCurrentVersion(0)) {
            	$alert = '<div class="alerts alerts-warn center">';
						$alert .= '<strong>'._t( 'Update!' ).'</strong> '._t( 'Hey admin, there is a new eduTrac Community update.' ).' <a href="http://sourceforge.net/projects/edutrac/">'._t( ' Click here' ).'</a> '._t( 'to download it. Also feel free to check out the').' <a href="#modal" data-toggle="modal">'._t( 'changelog' ).'</a>';
				$alert .= '</div>';
				
				$alert .= '<div id="modal" class="modal fade">';
						$alert .= '<div class="modal-dialog">';
							$alert .= '<div class="modal-content">';
								$alert .= '<div class="modal-header">';
										$alert .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>';
										$alert .= '<h4 class="modal-title">'._t( 'Changelog' ).'</h4>';
								$alert .= '</div>';
								$alert .= '<!-- //modal-header-->';
								$alert .= '<div class="modal-body">';
									$alert .= '<p>'.file_get_contents( "http://api.7mediaws.org/upgrades/com-changelog.txt",false,$context ).'</p>';
								$alert .= '</div>';
								$alert .= '<!-- //modal-body-->';
							$alert .= '</div>';
						$alert .= '</div>';
					$alert .= '</div>';
				$alert .= '<!-- //modal-->';
            }
        }
        return Hooks::apply_filter( 'update_message', $alert );
	}
    
    /**
      * Retrieve the cdn's root url.
      *
      * @since 4.0.0
      * @uses apply_filter() Calls 'cdn_uri' filter.
      *
      * @return string CDN root url.
      */
     function get_cdn_uri() {
          return Hooks::apply_filter( 'cdn_uri', 'http://edutrac.s3.amazonaws.com/' );
     }
	 
	 /**
      * Retrieves eduTrac site root url.
      *
      * @since 4.1.9
      * @uses apply_filter() Calls 'base_url' filter.
      *
      * @return string eduTrac root url.
      */
     function get_base_url() {
     	$url = BASE_URL;
		return Hooks::apply_filter( 'base_url', $url );
     }
	 
	 /**
      * Retrieve javascript directory uri.
      *
      * @since 4.1.9
      * @uses apply_filter() Calls 'javascript_directory_uri' filter.
      *
      * @return string eduTrac javascript url.
      */
     function get_javascript_directory_uri() {
     	$directory = 'static/assets/components';
		$javascript_root_uri = get_base_url();
		$javascript_dir_uri = "$javascript_root_uri$directory/";
		return Hooks::apply_filter( 'javascript_directory_uri', $javascript_dir_uri, $javascript_root_uri, $directory );
     }
	 
	 /**
      * Retrieve less directory uri.
      *
      * @since 4.1.9
      * @uses apply_filter() Calls 'less_directory_uri' filter.
      *
      * @return string eduTrac less url.
      */
     function get_less_directory_uri() {
     	$directory = 'static/assets/less';
		$less_root_uri = get_base_url();
		$less_dir_uri = "$less_root_uri$directory/";
		return Hooks::apply_filter( 'less_directory_uri', $less_dir_uri, $less_root_uri, $directory );
     }
	 
	 /**
      * Retrieve css directory uri.
      *
      * @since 4.1.9
      * @uses apply_filter() Calls 'css_directory_uri' filter.
      *
      * @return string eduTrac css url.
      */
     function get_css_directory_uri() {
     	$directory = 'static/assets/css';
		$css_root_uri = get_base_url();
		$css_dir_uri = "$css_root_uri$directory/";
		return Hooks::apply_filter( 'css_directory_uri', $css_dir_uri, $css_root_uri, $directory );
     }
	
	/**
	 * Parses a string into variables to be stored in an array.
	 *
	 * Uses {@link http://www.php.net/parse_str parse_str()}
	 *
	 * @since 4.2.0
	 * @param string $string The string to be parsed.
	 * @param array $array Variables will be stored in this array.
	 */
	function et_parse_str( $string, &$array ) {
		parse_str( $string, $array );
		/**
		 * Filter the array of variables derived from a parsed string.
		 *
		 * @since 4.2.0
		 * @param array $array The array populated with variables.
		 */
		$array = Hooks::apply_filter( 'et_parse_str', $array );
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
	
	function get_user_avatar($email, $s = 80, $class = '', $d = 'mm', $r = 'g', $img = false) {
	    $url = 'http://www.gravatar.com/avatar/';
        $url .= md5( strtolower( trim( $email ) ) );
        $url .= "?s=200&d=$d&r=$r";
		$avatarsize = getimagesize($url);
		$avatar = '<img src="' . $url . '" ' . imgResize($avatarsize[1],  $avatarsize[1], $s) . ' class="'.$class .'" />';
		return Hooks::apply_filter('user_avatar', $avatar, $email, $s);
	}
	
	function success_update() {
		$message = '<div class="alert alert-success">';
				$message .= '<strong>'._t('Success!').'</strong> '._t( 'The record was updated successfully.');
		$message .= '</div>';
		return Hooks::apply_filter('success_update', $message);
	}
	
	function error_update() {
		$message = '<div class="alert alert-danger">';
				$message .= '<strong>'._t('Error!').'</strong> '._t( 'The system was unable to update the record in the database. Please try again. If the problem persists, contact your system administrator.');
		$message .= '</div>';
		return Hooks::apply_filter('error_update', $message);
	}