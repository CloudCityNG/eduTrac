<?php namespace tinyPHP\Classes\Controllers;
/**
 *
 * Permission Controller
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

class Permission extends \tinyPHP\Classes\Core\Controller {
    
    public function __construct() {
        parent::__construct();
        if(!hasPermission('access_permission_screen')) { redirect( BASE_URL . 'dashboard/' ); }
    }
	
	public function index() {
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
                                
        $this->view->staticTitle = array('Manage Permissions');
        $this->view->render('permission/index');
    }
    
    public function add() {
        $this->view->staticTitle = array('Add Permission');
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
        $this->view->render('permission/add');
    }
    
    public function view() {
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
        $this->view->staticTitle = array('View Permission');
        $this->view->render('permission/view');
    }
    
    public function runRolePerm() {
        $data = array();
        $data['personID'] = isPostSet('personID');
        $this->model->runRolePerm($data);       
    }
    
    public function editSaveDeletePerm() {
        $data = array();
        $data['permID'] = isPostSet('permID');
        $data['permName'] = isPostSet('permName');
        $data['permKey'] = isPostSet('permKey');
        $data['savePerm'] = isPostSet('savePerm');
        $data['delPerm'] = isPostSet('delPerm');
        $this->model->editSaveDeletePerm($data);
    }
	
}