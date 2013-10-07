<?php namespace eduTrac\Classes\Controllers;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Dashboard Controller
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

class Dashboard extends \eduTrac\Classes\Core\Controller {
	
	private $_auth;

	public function __construct() {
		parent::__construct();
		$this->_auth = new \eduTrac\Classes\Libraries\Cookies();
        if(!$this->_auth->isUserLoggedIn()) { redirect( BASE_URL ); }
	}
	
	public function index() {
		$this->view->staticTitle = array('Dashboard');
        $this->view->css = array( 
                                'theme/scripts/plugins/calendars/fullcalendar/fullcalendar/fullcalendar.css',
                                'theme/scripts/plugins/forms/select2/select2.css',
                                'theme/scripts/plugins/forms/multiselect/css/multi-select.css',
                                'theme/scripts/plugins/forms/bootstrap-timepicker/css/bootstrap-timepicker.min.css',
                                );
                                
        $this->view->js = array( 
                                'theme/scripts/plugins/calendars/fullcalendar/fullcalendar/fullcalendar.js',
                                'theme/scripts/plugins/forms/select2/select2.js',
                                'theme/scripts/plugins/forms/multiselect/js/jquery.multi-select.js',
                                'theme/scripts/plugins/forms/jquery-inputmask/dist/jquery.inputmask.bundle.min.js',
                                'theme/scripts/plugins/forms/bootstrap-timepicker/js/bootstrap-timepicker.min.js',
                                'theme/scripts/demo/form_elements.js'
                                );
		$this->view->render('dashboard/index');
	}
    
    public function getEvents() {
        $this->model->getEvents();
    }
	
	public function search() {
		$data = array();
		$data['screen'] = isPostSet('screen');
		
		$this->model->search($data);		
	}
    
    public function runEvent() {
        $data = [];
        $data['title'] = isPostSet('title');
        $data['description'] = isPostSet('description');
        $data['roomID'] = isPostSet('roomID');
        $data['startDate'] = isPostSet('startDate');
        $data['startTime'] = isPostSet('startTime');
        $data['endTime'] = isPostSet('endTime');
        $data['repeats'] = isPostSet('repeats');
        $data['repeatFreq'] = isPostSet('repeatFreq');
        $this->model->runEvent($data);
    }
	
	public function logout() {
		$this->model->logout();
	}
	
}