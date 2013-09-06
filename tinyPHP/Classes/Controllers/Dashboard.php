<?php namespace tinyPHP\Classes\Controllers;
/**
 *
 * Dashboard Controller
 *  
 * PHP 5
 *
 * eduTrac(tm) : Student Information System (http://www.7mediaws.org/)
 * Copyright (C) 2013 Joshua Parker
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
 * @license GNU General Public License v3 (http://www.gnu.org/licenses/gpl-3.0.html)
 * @since   eduTrac(tm) v 1.0.0
 * @package Controller
 * @author  Joshua Parker <josh@7mediaws.org>
 */

if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');

class Dashboard extends \tinyPHP\Classes\Core\Controller {
	
	private $_auth;

	public function __construct() {
		parent::__construct();
		$this->_auth = new \tinyPHP\Classes\Libraries\Cookies();
        if(!$this->_auth->isUserLoggedIn()) { redirect( BASE_URL ); }
	}
	
	public function index() {
		$this->view->staticTitle = array('Dashboard');
		$this->view->render('dashboard/index');
	}
	
	public function search() {
		$data = array();
		$data['screen'] = isPostSet('screen');
		
		$this->model->search($data);		
	}
	
	public function logout() {
		$this->model->logout();
	}
	
}