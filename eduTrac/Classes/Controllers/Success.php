<?php namespace eduTrac\Classes\Controllers;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Success Controller
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

class Success extends \eduTrac\Classes\Core\Controller {
	
	private $_auth;

	public function __construct() {
		parent::__construct();
		$this->_auth = new \eduTrac\Classes\Libraries\Cookies();
        if(!$this->_auth->isUserLoggedIn()) { redirect( BASE_URL ); }
		/**
		 * If user is logged in and the lockscreen cookie is set, 
		 * redirect user to the lock screen until he/she enters 
		 * his/her password to gain access.
		 */
		if(isset($_COOKIE['SCREENLOCK'])) {
			redirect( BASE_URL . 'lock/' );
		}
	}
	
	public function index() {
		redirect( BASE_URL );
	}
	
	public function save_query() {
	    $this->view->staticTitle = array(_t('Save Query Success'));
		$this->view->render('success/save_query');
	}
    
    public function save_data() {
        $this->view->staticTitle = array(_t('Save Data Success'));
        $this->view->render('success/save_data');
    }
    
    public function course_registration() {
        $this->view->staticTitle = array(_t('Course Registration Success'));
        $this->view->render('success/course_registration');
    }
    
    public function nslc_purge() {
        $this->view->staticTitle = array(_t('Purge NSLC Success'));
        $this->view->render('success/nslc_purge');
    }
    
    public function delete_record() {
        $this->view->staticTitle = array(_t('Delete Record Success'));
        $this->view->render('success/delete_record');
    }
    
    public function update_record() {
        $this->view->staticTitle = array(_t('Update Record Success'));
        $this->view->render('success/update_record');
    }
    
    public function reset_password() {
        $this->view->staticTitle = array(_t('Reset Password Success'));
        $this->view->render('success/reset_password');
    }
    
    public function progress_report() {
        $this->view->staticTitle = array(_t('Sent Progress Report Successfully'));
        $this->view->render('success/progress_report');
    }

}