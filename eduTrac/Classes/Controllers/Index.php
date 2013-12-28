<?php namespace eduTrac\Classes\Controllers;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Index Controller
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

class Index extends \eduTrac\Classes\Core\Controller {
	
	private $_auth;

	public function __construct() {
		parent::__construct();
		$this->_auth = new \eduTrac\Classes\Libraries\Cookies();
        
        if(!file_exists(SYS_PATH . 'Config/installer.lock')) {
            redirect('/install/?step=1');
        }
	}
	
	public function index() {
		if($this->_auth->isUserLoggedIn()) { redirect(BASE_URL . 'dashboard/'); }
		$this->view->staticTitle = array('Login');
		$this->view->render('login-header/index',true);
		$this->view->render('index/index',true);
		$this->view->render('login-footer/index',true);
	}
	
	public function runLogin() {
		$data = array();
		$data['uname'] = isPostSet('uname');
		$data['password'] = isPostSet('password');
		$data['rememberme'] = isPostSet('rememberme');
		$this->model->runLogin($data);
	}
	
}