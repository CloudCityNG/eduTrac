<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * eduTrac Hooks Helper
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
	
    use \eduTrac\Classes\Libraries\Hooks;
	
	/**
	* Includes and loads all activated plugins.
	*
	* @since 1.0.0
	*/
	Hooks::load_activated_plugins();
	
	/**
	* An action called to add the plugin's link
	* to the menu structure.
	*
	* @since 1.0.0
	* @uses do_action() Calls 'admin_menu' hook.
	*/
	Hooks::do_action('admin_menu');
	Hooks::do_action('custom_plugin_page');
	Hooks::do_action('create_db_table');

	function init() {
		Hooks::do_action('init');
	}
	
	function head() {
		Hooks::do_action('head');
	}
	
	function footer() {
		Hooks::do_action('footer');
	}
    
    function version() {
        Hooks::do_action('version');
    }
	
	function dashboard_top_widgets() {
        Hooks::do_action('dashboard_top_widgets');
    }
	
	function dashboard_right_widgets() {
        Hooks::do_action('dashboard_right_widgets');
    }
    
    Hooks::add_action( 'head',						'head_version_meta',            5       );
    Hooks::add_action( 'version',					'foot_version',                 5       );
	Hooks::add_action( 'dashboard_top_widgets',		'dashboard_student_count',      5       );
	Hooks::add_action( 'dashboard_top_widgets',		'dashboard_course_count',       5       );
	Hooks::add_action( 'dashboard_top_widgets',		'dashboard_acadProg_count',     5       );
	Hooks::add_action( 'dashboard_right_widgets',	'dashboard_clock',     			5       );
	Hooks::add_action( 'dashboard_right_widgets',	'dashboard_weather',			5       );
	Hooks::add_filter( 'the_custom_page_content', 	'et_autop'            					);
	Hooks::add_filter( 'the_custom_page_content', 	'parsecode_unautop'  					);
	Hooks::add_filter( 'the_custom_page_content', 	'do_parsecode', 				5		);
