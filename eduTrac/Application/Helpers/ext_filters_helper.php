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
        $version = explode("\n", file_get_contents('http://api.7mediaws.org/upgrades/erp-version.txt',false,$context));
        return Hooks::apply_filter( 'get_current_version', $version[$array] );
    }
    
    function upgradeDB($array) {
        // Create the stream context
        $context = stream_context_create(array(
            'http' => array(
            'timeout' => 2      // Timeout in seconds
            )
        ));
    	$upgrade = explode("\n", file_get_contents('http://api.7mediaws.org/upgrades/erp-dbversion.txt',false,$context));
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
									$alert .= '<p>'.file_get_contents( "http://api.7mediaws.org/upgrades/erp-changelog.txt",false,$context ).'</p>';
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