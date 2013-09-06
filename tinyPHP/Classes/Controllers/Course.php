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
 * @since   eduTrac(tm) v 1.0.0
 * @package Controller
 * @author  Joshua Parker <josh@7mediaws.org>
 */

if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');

class Course extends \tinyPHP\Classes\Core\Controller {
	
	private $_auth;

	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		if(!hasPermission('access_course_screen')) { redirect( BASE_URL . 'dashboard/' ); }
		$this->view->staticTitle = array('Search Course');
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
		$this->view->render('course/index');
	}
    
    public function add() {
        if(!hasPermission('add_course')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array('Add Course');
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
        $this->view->render('course/add');
    }
    
    public function view($id) {
        if(!hasPermission('access_course_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array('View Course');
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
        
        $this->view->render('course/view');
    }
    
    public function addnl_info($id) {
        if(!hasPermission('access_course_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array('Additional Course Info');
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
        $this->view->addnl = $this->model->crse($id);
        $this->view->crseList = $this->model->crseList();
        
        if(empty($this->view->addnl)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('course/addnl_info');
    }
    
    public function runCourse() {
        if(!hasPermission('add_course')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = array();
        $data['courseNumber'] = isPostSet('courseNumber');
        $data['courseCode'] = isPostSet('courseCode');
        $data['subjCode'] = isPostSet('subjCode');
        $data['acadDeptCode'] = isPostSet('acadDeptCode');
        $data['courseDesc'] = isPostSet('courseDesc');
        $data['minCredit'] = isPostSet('minCredit');
        //$data['maxCredit'] = isPostSet('maxCredit');
        //$data['increCredit'] = isPostSet('increCredit');
        $data['courseLevelCode'] = isPostSet('courseLevelCode');
        $data['acadLevelCode'] = isPostSet('acadLevelCode');
        $data['courseShortTitle'] = isPostSet('courseShortTitle');
        $data['courseLongTitle'] = isPostSet('courseLongTitle');
        $data['preReq'] = isPostSet('preReq');
        $data['allowAudit'] = isPostSet('allowAudit');
        $data['allowWaitlist'] = isPostSet('allowWaitlist');
        $data['minEnroll'] = isPostSet('minEnroll');
        $data['seatCap'] = isPostSet('seatCap');
        $data['startDate'] = isPostSet('startDate');
        $data['endDate'] = isPostSet('endDate');
        $data['currStatus'] = isPostSet('currStatus');
        $data['statusDate'] = isPostSet('statusDate');
        $data['approvedDate'] = isPostSet('approvedDate');
        $data['approvedBy'] = isPostSet('approvedBy');
        $this->model->runCourse($data);
    }
    
    public function runEditCourse() {
        if(!hasPermission('add_course')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = array();
        $data['courseNumber'] = isPostSet('courseNumber');
        $data['courseCode'] = isPostSet('courseCode');
        $data['subjCode'] = isPostSet('subjCode');
        $data['acadDeptCode'] = isPostSet('acadDeptCode');
        $data['courseDesc'] = isPostSet('courseDesc');
        $data['minCredit'] = isPostSet('minCredit');
        //$data['maxCredit'] = isPostSet('maxCredit');
        //$data['increCredit'] = isPostSet('increCredit');
        $data['courseLevelCode'] = isPostSet('courseLevelCode');
        $data['acadLevelCode'] = isPostSet('acadLevelCode');
        $data['courseShortTitle'] = isPostSet('courseShortTitle');
        $data['courseLongTitle'] = isPostSet('courseLongTitle');
        $data['preReq'] = isPostSet('preReq');
        $data['allowAudit'] = isPostSet('allowAudit');
        $data['allowWaitlist'] = isPostSet('allowWaitlist');
        $data['minEnroll'] = isPostSet('minEnroll');
        $data['seatCap'] = isPostSet('seatCap');
        $data['startDate'] = isPostSet('startDate');
        $data['endDate'] = isPostSet('endDate');
        $data['currStatus'] = isPostSet('currStatus');
        $data['statusDate'] = isPostSet('statusDate');
        $data['courseID'] = isPostSet('courseID');
        $this->model->runEditCourse($data);
    }
    
    public function runAddnl() {
        if(!hasPermission('add_course')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = array();
        $data['preReq'] = isPostSet('preReq');
        $data['allowAudit'] = isPostSet('allowAudit');
        $data['allowWaitlist'] = isPostSet('allowWaitlist');
        $data['minEnroll'] = isPostSet('minEnroll');
        $data['seatCap'] = isPostSet('seatCap');
        $data['courseID'] = isPostSet('courseID');
        $this->model->runAddnl($data);
    }
    
    public function search() {
        $this->model->search();
    }
    
    public function deleteCourse($id) {
        if(!hasPermission('add_course')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->model->deleteCourse($id);
    }
	
}