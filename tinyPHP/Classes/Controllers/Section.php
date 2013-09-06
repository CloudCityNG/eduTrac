<?php namespace tinyPHP\Classes\Controllers;
/**
 *
 * Course Controller
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

class Section extends \tinyPHP\Classes\Core\Controller {

	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
	    if(!hasPermission('access_course_sec_screen')) { redirect( BASE_URL . 'dashboard/' ); }
		$this->view->staticTitle = array('Search Section');
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
		$this->view->render('section/index');
	}
    
    public function add($id) {
        if(!hasPermission('add_course_sec')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array('Add Section');
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
        $this->view->crse = $this->model->crse($id);
        
        if(empty($this->view->crse)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        $this->view->render('section/add');
    }
    
    public function view($id) {
        if(!hasPermission('access_course_sec_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array('View Section');
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
        $this->view->sec = $this->model->section($id);
        
        if(empty($this->view->sec)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('section/view');
    }
    
    public function addnl_info($id) {
        if(!hasPermission('add_course_sec')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array('Additional Course Section Info');
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
        $this->view->addnl = $this->model->section($id);
        
        if(empty($this->view->addnl)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('section/addnl_info');
    }
    
    public function register() {
        if(!hasPermission('register_students')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array('Course Registration');
        $this->view->css = array( 
                                'theme/scripts/plugins/forms/select2/select2.css',
                                'theme/scripts/plugins/forms/multiselect/css/multi-select.css',
                                'theme/scripts/plugins/forms/bootstrap-timepicker/css/bootstrap-timepicker.min.css'
                                );
        $this->view->js = array( 
                                'theme/scripts/plugins/forms/select2/select2.js',
                                'theme/scripts/plugins/forms/multiselect/js/jquery.multi-select.js',
                                'theme/scripts/plugins/forms/jquery-inputmask/dist/jquery.inputmask.bundle.min.js',
                                'theme/scripts/plugins/forms/bootstrap-timepicker/js/bootstrap-timepicker.min.js',
                                'theme/scripts/demo/timepicker.js',
                                'theme/scripts/demo/form_elements.js'
                                );
        $this->view->render('section/register');
    }
    
    public function runSection() {
        if(!hasPermission('add_course_sec')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = array();
        $data['courseCode'] = isPostSet('courseCode');
        $data['sectionNumber'] = isPostSet('sectionNumber');
        $data['locationCode'] = isPostSet('locationCode');
        $data['termCode'] = isPostSet('termCode');
        $data['courseID'] = isPostSet('courseID');
        $data['secShortTitle'] = isPostSet('secShortTitle');
        $data['startDate'] = isPostSet('startDate');
        $data['endDate'] = isPostSet('endDate');
        $data['deptCode'] = isPostSet('deptCode');
        $data['minCredit'] = isPostSet('minCredit');
        $data['maxCredit'] = isPostSet('maxCredit');
        $data['increCredit'] = isPostSet('increCredit');
        $data['ceu'] = isPostSet('ceu');
        $data['courseLevelCode'] = isPostSet('courseLevelCode');
        $data['acadLevelCode'] = isPostSet('acadLevelCode');
        $data['secShortTitle'] = isPostSet('secShortTitle');
        $data['currStatus'] = isPostSet('currStatus');
        $data['statusDate'] = isPostSet('statusDate');
        $data['approvedDate'] = isPostSet('approvedDate');
        $data['approvedBy'] = isPostSet('approvedBy');
        $this->model->runSection($data);
    }
    
    public function runEditSection() {
        if(!hasPermission('add_course_sec')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = array();
        $data['locationCode'] = isPostSet('locationCode');
        $data['termCode'] = isPostSet('termCode');
        $data['courseID'] = isPostSet('courseID');
        $data['secShortTitle'] = isPostSet('secShortTitle');
        $data['startDate'] = isPostSet('startDate');
        $data['endDate'] = isPostSet('endDate');
        $data['deptCode'] = isPostSet('deptCode');
        $data['minCredit'] = isPostSet('minCredit');
        $data['maxCredit'] = isPostSet('maxCredit');
        $data['increCredit'] = isPostSet('increCredit');
        $data['ceu'] = isPostSet('ceu');
        $data['courseLevelCode'] = isPostSet('courseLevelCode');
        $data['acadLevelCode'] = isPostSet('acadLevelCode');
        $data['secShortTitle'] = isPostSet('secShortTitle');
        $data['currStatus'] = isPostSet('currStatus');
        $data['statusDate'] = isPostSet('statusDate');
        $data['courseSecID'] = isPostSet('courseSecID');
        $this->model->runEditSection($data);
    }
    
    public function runAddnl() {
        if(!hasPermission('add_course_sec')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = array();
        $data['facID'] = isPostSet('facID');
        $data['secType'] = isPostSet('secType');
        $data['instructorMethod'] = isPostSet('instructorMethod');
        $data['contactHours'] = isPostSet('contactHours');
        $data['instructorLoad'] = isPostSet('instructorLoad');
        $data['courseSecID'] = isPostSet('courseSecID');
        $this->model->runAddnl($data);
    }
    
    public function search() {
        if(!hasPermission('access_course_sec_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->model->search();
    }
    
    public function runTermLookup() {
        if(!hasPermission('add_course_sec')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = array();
        $data['termCode'] = isPostSet('termCode');
        $this->model->runTermLookup($data);
    }
    
    public function runReg() {
        if(!hasPermission('register_students')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = array();
        $data['stuID'] = isPostSet('stuID');
        $data['courseSecID'] = isPostSet('courseSecID');
        $this->model->runReg($data);
    }
    
    public function deleteCourse($id) {
        if(!hasPermission('add_course_sec')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->model->deleteCourse($id);
    }
	
}