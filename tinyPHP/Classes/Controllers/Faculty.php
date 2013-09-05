<?php namespace tinyPHP\Classes\Controllers;
/**
 *
 * Faculty Controller
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
 * @since eduTrac(tm) v 1.0
 * @license GNU General Public License v3 (http://www.gnu.org/licenses/gpl-3.0.html)
 */

if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');

class Faculty extends \tinyPHP\Classes\Core\Controller {

	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
	    if(!hasPermission('access_faculty_screen')) { redirect( BASE_URL . 'dashboard/' ); }
		$this->view->staticTitle = array('Search Faculty');
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
		$this->view->search = $this->model->search();
		$this->view->render('faculty/index');
	}
    
    public function add($id) {
        if(!hasPermission('create_fac_record')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array('Add Faculty');
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
        $this->view->person = $this->model->person($id);
        $this->view->render('faculty/add');
    }
    
    public function view($id) {
        if(!hasPermission('create_fac_record')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array('View Faculty');
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
        $this->view->faculty = $this->model->faculty($id);
        
        if(empty($this->view->faculty)) {
            redirect( BASE_URL . 'error/invalidRecord/' );
        }
        
        $this->view->render('faculty/view');
    }
    
    public function runFaculty() {
        if(!hasPermission('create_fac_record')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = array();
        $data['facID'] = isPostSet('facID');
        $data['buildingCode'] = isPostSet('buildingCode');
        $data['officeCode'] = isPostSet('officeCode');
        $data['office_phone'] = isPostSet('office_phone');
        $data['deptCode'] = isPostSet('deptCode');
        $data['addDate'] = isPostSet('addDate');
        $data['approvedBy'] = isPostSet('approvedBy');
        $this->model->runFaculty($data);
    }
    
     public function runEditFaculty() {
        if(!hasPermission('create_fac_record')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = array();
        $data['facID'] = isPostSet('facID');
        $data['buildingCode'] = isPostSet('buildingCode');
        $data['officeCode'] = isPostSet('officeCode');
        $data['office_phone'] = isPostSet('office_phone');
        $data['deptCode'] = isPostSet('deptCode');
        $this->model->runEditFaculty($data);
    }
    
    public function search() {
        if(!hasPermission('access_faculty_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->model->search();
    }
	
}