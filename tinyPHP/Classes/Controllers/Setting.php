<?php namespace tinyPHP\Classes\Controllers;
/**
 *
 * Setting Controller
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

class Setting extends \tinyPHP\Classes\Core\Controller {

	public function __construct() {
		parent::__construct();
		if(!hasPermission('edit_settings')) { redirect( BASE_URL . 'dashboard/' ); }
	}
	
	public function index() {
		$this->view->staticTitle = array('System Settings');
		$this->view->css = array( 
                                'theme/scripts/plugins/forms/select2/select2.css',
                                'theme/scripts/plugins/forms/multiselect/css/multi-select.css'
                                );
        $this->view->js = array( 
                                'theme/scripts/plugins/forms/select2/select2.js',
                                'theme/scripts/plugins/forms/multiselect/js/jquery.multi-select.js',
                                'theme/scripts/plugins/forms/jquery-inputmask/dist/jquery.inputmask.bundle.min.js',
                                'theme/scripts/demo/form_elements.js'
                                );
		$this->view->render('setting/index');
	}
	
    public function runSetting() {
        $options = array( 'system_email','enable_ssl','site_title','cookieexpire','cookiepath','hold_file_loc',
                          'maintenance_mode','enable_benchmark','current_term_code','enable_cron_log');
        $this->model->runSetting($options);
    }
}