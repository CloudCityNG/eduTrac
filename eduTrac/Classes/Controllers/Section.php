<?php namespace eduTrac\Classes\Controllers;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Course Section Controller
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

class Section extends \eduTrac\Classes\Core\Controller {

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
    
    public function offering_info($id) {
        if(!hasPermission('add_course_sec')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array('Course Section Offering Info');
        $this->view->css = array( 
                                'theme/scripts/plugins/forms/select2/select2.css',
                                'theme/scripts/plugins/forms/multiselect/css/multi-select.css',
                                'theme/scripts/plugins/forms/bootstrap-timepicker/css/bootstrap-timepicker.min.css',
                                );
        $this->view->js = array( 
                                'theme/scripts/plugins/forms/select2/select2.js',
                                'theme/scripts/plugins/forms/multiselect/js/jquery.multi-select.js',
                                'theme/scripts/plugins/forms/jquery-inputmask/dist/jquery.inputmask.bundle.min.js',
                                'theme/scripts/plugins/forms/bootstrap-timepicker/js/bootstrap-timepicker.min.js',
                                'theme/scripts/demo/form_elements.js'
                                );
        $this->view->soff = $this->model->soff($id);
        
        if(empty($this->view->soff)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('section/offering_info');
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
    
    public function batch_register() {
        if(!hasPermission('register_students')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array('Batch Course Registration');
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
        $this->view->render('section/batch_register');
    }
    
    public function courses() {
        if(!hasPermission('access_grading_screen')) { redirect( BASE_URL . 'dashboard/' ); }
		$this->view->staticTitle = array('Course Section Grading');
		$this->view->css = array( 
								'theme/scripts/plugins/tables/DataTables/media/css/DT_bootstrap.css',
								'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/css/TableTools.css',
								'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/css/ColVis.css',
                                'theme/scripts/plugins/forms/select2/select2.css',
                                'theme/scripts/plugins/forms/multiselect/css/multi-select.css'
								);
								
		$this->view->js = array( 
								'theme/scripts/plugins/forms/select2/select2.js',
                                'theme/scripts/plugins/forms/multiselect/js/jquery.multi-select.js',
                                'theme/scripts/plugins/forms/jquery-inputmask/dist/jquery.inputmask.bundle.min.js',
                                'theme/scripts/plugins/tables/DataTables/media/js/jquery.dataTables.min.js',
								'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/js/TableTools.min.js',
								'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/js/ColVis.min.js',
								'theme/scripts/plugins/tables/DataTables/media/js/DT_bootstrap.js',
								'theme/scripts/demo/tables.js',
                                'theme/scripts/demo/form_elements.js'
								);
        $this->view->courseSec = $this->model->courseSec();
		$this->view->render('section/courses');
	}
    
    public function grading($id) {
        if(!hasPermission('access_grading_screen')) { redirect( BASE_URL . 'dashboard/' ); }
    	$this->view->staticTitle = array('Course Section Grading');
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
								'theme/scripts/demo/tables.js',
								);
        $this->view->grades = $this->model->grades($id);
        
        if(empty($this->view->grades)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
		$this->view->render('section/grading');
	}
    
    public function runSection() {
        if(!hasPermission('add_course_sec')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = array();
        $data['courseCode'] = isPostSet('courseCode');
        $data['sectionNumber'] = isPostSet('sectionNumber');
        $data['locationID'] = isPostSet('locationID');
        $data['termID'] = isPostSet('termID');
        $data['courseID'] = isPostSet('courseID');
        $data['secShortTitle'] = isPostSet('secShortTitle');
        $data['startDate'] = isPostSet('startDate');
        $data['endDate'] = isPostSet('endDate');
        $data['deptID'] = isPostSet('deptID');
        $data['minCredit'] = isPostSet('minCredit');
        //$data['maxCredit'] = isPostSet('maxCredit');
        //$data['increCredit'] = isPostSet('increCredit');
        $data['ceu'] = isPostSet('ceu');
        $data['courseLevelCode'] = isPostSet('courseLevelCode');
        $data['acadLevelCode'] = isPostSet('acadLevelCode');
        $data['currStatus'] = isPostSet('currStatus');
        $data['statusDate'] = isPostSet('statusDate');
        $data['approvedDate'] = isPostSet('approvedDate');
        $data['approvedBy'] = isPostSet('approvedBy');
        $this->model->runSection($data);
    }
    
    public function runEditSection() {
        if(!hasPermission('add_course_sec')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = array();
        $data['locationID'] = isPostSet('locationID');
        $data['termID'] = isPostSet('termID');
        $data['courseID'] = isPostSet('courseID');
        $data['secShortTitle'] = isPostSet('secShortTitle');
        $data['startDate'] = isPostSet('startDate');
        $data['endDate'] = isPostSet('endDate');
        $data['deptID'] = isPostSet('deptID');
        $data['minCredit'] = isPostSet('minCredit');
        //$data['maxCredit'] = isPostSet('maxCredit');
        //$data['increCredit'] = isPostSet('increCredit');
        $data['ceu'] = isPostSet('ceu');
        $data['courseLevelCode'] = isPostSet('courseLevelCode');
        $data['acadLevelCode'] = isPostSet('acadLevelCode');
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
    
    public function runSOFF() {
        if(!hasPermission('add_course_sec')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = array();
        $data['buildingID'] = isPostSet('buildingID');
        $data['roomID'] = isPostSet('roomID');
        $data['dotw'] = isPostSet('dotw');
        $data['startTime'] = isPostSet('startTime');
        $data['endTime'] = isPostSet('endTime');
        $data['stuReg'] = isPostSet('stuReg');
        $data['courseSecID'] = isPostSet('courseSecID');
        $this->model->runSOFF($data);
    }
    
    public function search() {
        if(!hasPermission('access_course_sec_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->model->search();
    }
    
    public function runTermLookup() {
        if(!hasPermission('add_course_sec')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = array();
        $data['termID'] = isPostSet('termID');
        $this->model->runTermLookup($data);
    }
    
    public function runStuLookup() {
        if(!hasPermission('add_course_sec')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = array();
        $data['stuID'] = isPostSet('stuID');
        $this->model->runStuLookup($data);
    }
    
    public function runSecLookup() {
        if(!hasPermission('add_course_sec')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = array();
        $data['courseSecID'] = isPostSet('courseSecID');
        $this->model->runSecLookup($data);
    }
    
    public function runReg() {
        if(!hasPermission('register_students')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = array();
        $data['stuID'] = isPostSet('stuID');
        $data['courseSecID'] = isPostSet('courseSecID');
        $this->model->runReg($data);
    }
    
    public function runBatchReg() {
        if(!hasPermission('register_students')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = [];
        $data['courseSecID'] = isPostSet('courseSecID');
        $data['queryID'] = isPostSet('queryID');
        $this->model->runBatchReg($data);
    }
    
    public function runGrades() {
        if(!hasPermission('access_grading_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = array();
        $data['stuID'] = isPostSet('stuID');
        $data['courseSecID'] = isPostSet('courseSecID');
        $data['termID'] = isPostSet('termID');
        $data['grade'] = isPostSet('grade');
        $data['cmplCredit'] = isPostSet('cmplCredit');
        $this->model->runGrades($data);
    }
    
    public function deleteCourse($id) {
        if(!hasPermission('add_course_sec')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->model->deleteCourse($id);
    }
	
}