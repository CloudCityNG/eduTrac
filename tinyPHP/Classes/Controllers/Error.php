<?php namespace tinyPHP\Classes\Controllers;
/**
 *
 * Error Controller
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
 * @since eduTrac(tm) v 1.0.0
 * @package Controller
 */

if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');

class Error extends \tinyPHP\Classes\Core\Controller {
	
	private $_auth;

	public function __construct() {
		parent::__construct();
		$this->_auth = new \tinyPHP\Classes\Libraries\Cookies();
        if(!$this->_auth->isUserLoggedIn()) { redirect( BASE_URL . 'dashboard/' ); }
	}
    
    public function logs() {
        $this->view->staticTitle = array('Error Log');
        $this->view->css = array( 
                                'theme/scripts/plugins/tables/DataTables/media/css/DT_bootstrap.css',
                                'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/css/TableTools.css',
                                'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/css/ColVis.css',
                                );
                                
        $this->view->js = array( 
                                'theme/scripts/plugins/tables/DataTables/media/js/jquery.dataTables.min.js',
                                'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/js/TableTools.min.js',
                                'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/js/ColVis.min.js',
                                'theme/scripts/plugins/tables/DataTables/media/js/DT_bootstrap.js',
                                'theme/scripts/demo/tables.js'
                                );
        $this->view->logs = $this->model->logs();
        $this->view->render('error/logs');
    }
	
	public function index() {
		$this->view->render('error-header/index',true);
		$this->view->render('error/index',true);
		$this->view->render('error-footer/index',true);
	}
    
    public function invalid_record() {
        $this->view->staticTitle = array('Invalid Record');
        $this->view->render('error/invalid_record');
    }
	
    public function SQL() {
        $this->view->staticTitle = array('SQL Restricted Keywords');
        $this->view->render('error/SQL');
    }
    
	public function screen_error() {
		$this->view->staticTitle = array('Screen Error');
		$this->view->render('error/screen_error');
	}
    
    public function delete_record() {
        $this->view->staticTitle = array('Delete Record Error');
        $this->view->render('error/delete_record');
    }
	
	public function save_query() {
		$this->view->staticTitle = array('Save Query');
		$this->view->render('error/save_query');
	}
    
    public function nslc_purge() {
        $this->view->staticTitle = array('NSLC Purge Error');
        $this->view->render('error/nslc_purge');
    }
    
    public function nslc_extraction() {
        $this->view->staticTitle = array('NSLC Extraction Error');
        $this->view->render('error/nslc_extraction');
    }
    
    public function save_data() {
        $this->view->staticTitle = array('Save Data');
        $this->view->render('error/save_data');
    }
    
    public function edit_data() {
        $this->view->staticTitle = array('Edit Data');
        $this->view->render('error/edit_data');
    }
    
    public function deleteLog($id) {
        $this->model->deleteLog($id);
    }

}