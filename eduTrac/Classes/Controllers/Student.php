<?php namespace eduTrac\Classes\Controllers;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Student Controller
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

class Student extends \eduTrac\Classes\Core\Controller {

	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
	    if(!hasPermission('access_student_screen')) { redirect( BASE_URL . 'dashboard/' ); }
		$this->view->staticTitle = array('Search Student');
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
		$this->view->render('student/index');
	}
    
    public function add($id) {
        if(!hasPermission('create_stu_record')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array('Add Student');
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
        $this->view->student = $this->model->getAppl($id);
        if(empty($this->view->student)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        $this->view->render('student/add');
    }
    
    public function view($id) {
        if(!hasPermission('access_student_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array('View Student');
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
        $this->view->student = $this->model->student($id);
        $this->view->address = $this->model->address($id);
        $this->view->admit = $this->model->admit($id);
        $this->view->prog = $this->model->prog($id);
        
        if(empty($this->view->student)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('student/view');
    }
    
    public function add_prog($id) {
        if(!hasPermission('create_stu_record')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array('Add Student Program');
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
        $this->view->student = $this->model->getStudent($id);
        $this->view->render('student/add_prog');
    }
    
    public function view_prog($id) {
        if(!hasPermission('access_student_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array('View Student Program');
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
        $this->view->stuProg = $this->model->stuProg($id);
        
        if(empty($this->view->stuProg)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('student/view_prog');
    }
    
    public function academic_credits($id) {
        if(!hasPermission('access_student_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array('Student Academic Credits');
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
        $this->view->student = $this->model->student($id);
        $this->view->acadCred = $this->model->acadCred($id);
        
        if(empty($this->view->student)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('student/academic_credits');
    }
    
    public function view_academic_credits($id) {
        if(!hasPermission('access_student_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array('Student Academic Credits');
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
        $this->view->viewAcadCred = $this->model->viewAcadCred($id);
        
        if(empty($this->view->viewAcadCred)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('student/view_academic_credits');
    }
    
    public function courses() {
        if(!hasPermission('access_student_portal')) { redirect( BASE_URL . 'dashboard/' ); }
    	$this->view->staticTitle = array('Course Sections');
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
        $this->view->courseSec = $this->model->courseSec();
		$this->view->render('student/courses');
    }
    
    public function portal() {
        if(!hasPermission('access_student_portal')) { redirect( BASE_URL . 'dashboard/' ); }
		$this->view->staticTitle = array('Student Portal');
		$this->view->render('student/portal');
	}
    
    public function schedule() {
        if(!hasPermission('access_student_portal')) { redirect( BASE_URL . 'dashboard/' ); }
    	$this->view->staticTitle = array('Class Schedule');
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
        $this->view->schedule = $this->model->schedule();
		$this->view->render('student/schedule');
	}
    
    public function runStudent() {
        if(!hasPermission('create_stu_record')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = array();
        $data['stuID'] = isPostSet('stuID');
        $data['advisorID'] = isPostSet('advisorID');
        $data['catYearID'] = isPostSet('catYearID');
        $data['antGradDate'] = isPostSet('antGradDate');
        $data['acadLevelCode'] = isPostSet('acadLevelCode');
        $data['addDate'] = isPostSet('addDate');
        $data['approvedBy'] = isPostSet('approvedBy');
        $data['progID'] = isPostSet('progID');
        $data['startDate'] = isPostSet('startDate');
        $this->model->runStudent($data);
    }
    
     public function runEditStudent() {
         if(!hasPermission('create_stu_record')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = array();
        $data['stuID'] = isPostSet('stuID');
        $data['advisorID'] = isPostSet('advisorID');
        $data['acadLevelCode'] = isPostSet('acadLevelCode');
        $data['catYearID'] = isPostSet('catYearID');
        $data['antGradDate'] = isPostSet('antGradDate');
        $this->model->runEditStudent($data);
    }
     
    public function runStuProg() {
        if(!hasPermission('create_stu_record')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = array();
        $data['stuID'] = isPostSet('stuID');
        $data['currStatus'] = isPostSet('currStatus');
        $data['startDate'] = isPostSet('startDate');
        $data['endDate'] = isPostSet('endDate');
        $data['progID'] = isPostSet('progID');
        $data['approvedBy'] = isPostSet('approvedBy');
        $this->model->runStuProg($data);
    }
    
    public function runEditStuProg() {
        if(!hasPermission('create_stu_record')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = array();
        $data['stuID'] = isPostSet('stuID');
        $data['currStatus'] = isPostSet('currStatus');
        $data['startDate'] = isPostSet('startDate');
        $data['endDate'] = isPostSet('endDate');
        $data['stuProgID'] = isPostSet('stuProgID');
        $this->model->runEditStuProg($data);
    }
    
    public function runAcadCred() {
        if(!hasPermission('create_stu_record')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = array();
        $data['grade'] = isPostSet('grade');
        $data['status'] = isPostSet('status');
        $data['statusDate'] = isPostSet('statusDate');
        $data['statusTime'] = isPostSet('statusTime');
        $data['id'] = isPostSet('id');
        $data['stuID'] = isPostSet('stuID');
        $data['courseSecID'] = isPostSet('courseSecID');
        $data['termID'] = isPostSet('termID');
        $this->model->runAcadCred($data);
    }
    
    public function runProgLookup() {
        if(!hasPermission('create_stu_record')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = array();
        $data['progID'] = isPostSet('progID');
        $this->model->runProgLookup($data);
    }
    
    public function runRegister() {
        if(!hasPermission('access_student_portal')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = [];
        $data['courseSecID'] = isPostSet('courseSecID');
        $data['termID'] = isPostSet('termID');
        $data['courseCredits'] = isPostSet('courseCredits');
        $this->model->runRegister($data);
    }
    
    public function search() {
        if(!hasPermission('access_student_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->model->search();
    }
	
}