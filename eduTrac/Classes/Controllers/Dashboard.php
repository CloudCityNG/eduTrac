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
 * @since       3.0.0
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */

class Dashboard extends \eduTrac\Classes\Core\Controller {
	
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
		$this->view->staticTitle = array(_t('Dashboard'));
		$this->view->PROG = $this->model->PROG();
		$this->view->stuDept = $this->model->stuDept();
		$this->view->less = [ 'less/admin/module.admin.page.index.less' ];
		$this->view->css = [ 'css/admin/module.admin.page.index.min.css' ];
		$this->view->js = [ 
                            'components/modules/admin/charts/flot/assets/lib/jquery.flot.js?v=v2.1.0',
                            'components/modules/admin/charts/flot/assets/lib/jquery.flot.resize.js?v=v2.1.0',
                            'components/modules/admin/charts/flot/assets/lib/plugins/jquery.flot.tooltip.min.js?v=v2.1.0',
                            'components/modules/admin/charts/flot/assets/custom/js/flotcharts.common.js?v=v2.1.0',
                            'components/modules/admin/charts/flot/assets/custom/js/flotchart-simple.init.js?v=v2.1.0',
                            'components/modules/admin/charts/easy-pie/assets/lib/js/jquery.easy-pie-chart.js?v=v2.1.0',
                            'components/modules/admin/charts/easy-pie/assets/custom/easy-pie.init.js?v=v2.1.0',
                            'components/modules/admin/charts/flot/custom/chart.js',
                            'components/modules/admin/charts/flot/custom/js/custom-flot.js'
                            ];
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