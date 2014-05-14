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
 * @since       3.0.0
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */

class Student extends \eduTrac\Classes\Core\Controller {

	public function __construct() {
		parent::__construct();
		/**
		 * If user is logged in and the lockscreen cookie is set, 
		 * redirect user to the lock screen until he/she enters 
		 * his/her password to gain access.
		 */
		if(isset($_COOKIE['SCREENLOCK'])) {
			redirect( BASE_URL . 'lock/' );
		}
	}
	
	public function index() {
	    if(!hasPermission('access_student_screen')) { redirect( BASE_URL . 'dashboard/' ); }
		$this->view->staticTitle = array(_t('Search Student'));
		$this->view->less = [ 'less/admin/module.admin.page.form_elements.less','less/admin/module.admin.page.tables.less' ];
		$this->view->css = [ 'css/admin/module.admin.page.form_elements.min.css','css/admin/module.admin.page.tables.min.css' ];
        $this->view->js = [ 
                            'components/modules/admin/forms/elements/bootstrap-select/assets/lib/js/bootstrap-select.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-select/assets/custom/js/bootstrap-select.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/lib/js/select2.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/custom/js/select2.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/lib/js/bootstrap-datepicker.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/custom/js/bootstrap-datepicker.init.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/lib/js/jquery.dataTables.min.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/lib/extras/TableTools/media/js/TableTools.min.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/custom/js/DT_bootstrap.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/custom/js/datatables.init.js?v=v2.1.0'
                            ];
		$this->view->search = $this->model->search();
		$this->view->render('student/index');
	}
    
    public function add($id) {
        if(!hasPermission('create_stu_record')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array(_t('Add Student'));
        $this->view->student = $this->model->getAppl($id);
		$this->view->less = [ 'less/admin/module.admin.page.form_elements.less','less/admin/module.admin.page.tables_responsive.less' ];
		$this->view->css = [ 'css/admin/module.admin.page.form_elements.min.css','css/admin/module.admin.page.tables_responsive.min.css' ];
        $this->view->js = [ 
        					'components/modules/admin/forms/elements/fuelux-checkbox/fuelux-checkbox.js?v=v2.1.0',
        					'components/modules/admin/forms/elements/fuelux-radio/fuelux-radio.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-select/assets/lib/js/bootstrap-select.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-select/assets/custom/js/bootstrap-select.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/lib/js/select2.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/custom/js/select2.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/lib/js/bootstrap-datepicker.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/custom/js/bootstrap-datepicker.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-timepicker/assets/lib/js/bootstrap-timepicker.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-timepicker/assets/custom/js/bootstrap-timepicker.init.js?v=v2.1.0'
                            ];
        if(empty($this->view->student)) {
            redirect( BASE_URL . 'student/view/' . $id . '/' );
        }
        $this->view->render('student/add');
    }
    
    public function view($id) {
        if(!hasPermission('access_student_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array(_t('View Student'));
        $this->view->prog = $this->model->prog($id);
        $this->view->address = $this->model->address($id);
        $this->view->admit = $this->model->admit($id);
        $this->view->less = [ 'less/admin/module.admin.page.form_elements.less','less/admin/module.admin.page.tables_responsive.less' ];
		$this->view->css = [ 'css/admin/module.admin.page.form_elements.min.css','css/admin/module.admin.page.tables_responsive.min.css' ];
        $this->view->js = [ 
        					'components/modules/admin/forms/elements/fuelux-checkbox/fuelux-checkbox.js?v=v2.1.0',
        					'components/modules/admin/forms/elements/fuelux-radio/fuelux-radio.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-select/assets/lib/js/bootstrap-select.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-select/assets/custom/js/bootstrap-select.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/lib/js/select2.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/custom/js/select2.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/lib/js/bootstrap-datepicker.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/custom/js/bootstrap-datepicker.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-timepicker/assets/lib/js/bootstrap-timepicker.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-timepicker/assets/custom/js/bootstrap-timepicker.init.js?v=v2.1.0'
                            ];
        if(empty($this->view->prog)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('student/view');
    }
    
    public function rstr($id) {
        if(!hasPermission('access_student_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array(_t('Student Restrictions'));
        $this->view->student = $this->model->student($id);
        $this->view->rstr = $this->model->rstr($id);
		$this->view->less = [ 'less/admin/module.admin.page.form_elements.less','less/admin/module.admin.page.tables_responsive.less' ];
		$this->view->css = [ 'css/admin/module.admin.page.form_elements.min.css','css/admin/module.admin.page.tables_responsive.min.css' ];
        $this->view->js = [ 
        					'components/modules/admin/forms/elements/fuelux-checkbox/fuelux-checkbox.js?v=v2.1.0',
        					'components/modules/admin/forms/elements/fuelux-radio/fuelux-radio.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-select/assets/lib/js/bootstrap-select.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-select/assets/custom/js/bootstrap-select.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/lib/js/select2.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/custom/js/select2.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/lib/js/bootstrap-datepicker.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/custom/js/bootstrap-datepicker.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-timepicker/assets/lib/js/bootstrap-timepicker.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-timepicker/assets/custom/js/bootstrap-timepicker.init.js?v=v2.1.0'
                            ];
        if(empty($this->view->student)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        $this->view->render('student/rstr');
    }
    
    public function add_prog($id) {
        if(!hasPermission('create_stu_record')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array(_t('Add Student Program'));
		$this->view->less = [ 'less/admin/module.admin.page.form_elements.less' ];
		$this->view->css = [ 'css/admin/module.admin.page.form_elements.min.css' ];
        $this->view->js = [ 
                            'components/modules/admin/forms/elements/bootstrap-select/assets/lib/js/bootstrap-select.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-select/assets/custom/js/bootstrap-select.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/lib/js/select2.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/custom/js/select2.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/lib/js/bootstrap-datepicker.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/custom/js/bootstrap-datepicker.init.js?v=v2.1.0'
                            ];
        $this->view->student = $this->model->getStudent($id);
		if(empty($this->view->student)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        $this->view->render('student/add_prog');
    }
    
    public function view_prog($id) {
        if(!hasPermission('access_student_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array(_t('View Student Program'));
        $this->view->stuProg = $this->model->stuProg($id);
        $this->view->less = [ 'less/admin/module.admin.page.form_elements.less' ];
		$this->view->css = [ 'css/admin/module.admin.page.form_elements.min.css' ];
        $this->view->js = [ 
                            'components/modules/admin/forms/elements/bootstrap-select/assets/lib/js/bootstrap-select.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-select/assets/custom/js/bootstrap-select.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/lib/js/select2.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/custom/js/select2.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/lib/js/bootstrap-datepicker.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/custom/js/bootstrap-datepicker.init.js?v=v2.1.0'
                            ];
        if(empty($this->view->stuProg)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('student/view_prog');
    }
    
    public function academic_credits($id) {
        if(!hasPermission('access_student_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array(_t('Student Academic Credits'));
        $this->view->less = [ 'less/admin/module.admin.page.form_elements.less','less/admin/module.admin.page.tables.less' ];
		$this->view->css = [ 'css/admin/module.admin.page.form_elements.min.css','css/admin/module.admin.page.tables.min.css' ];
        $this->view->js = [ 
                            'components/modules/admin/forms/elements/bootstrap-select/assets/lib/js/bootstrap-select.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-select/assets/custom/js/bootstrap-select.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/lib/js/select2.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/custom/js/select2.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/lib/js/bootstrap-datepicker.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/custom/js/bootstrap-datepicker.init.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/lib/js/jquery.dataTables.min.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/lib/extras/TableTools/media/js/TableTools.min.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/custom/js/DT_bootstrap.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/custom/js/datatables.init.js?v=v2.1.0'
                            ];
        $this->view->student = $this->model->student($id);
        $this->view->acadCred = $this->model->acadCred($id);
        
        if(empty($this->view->student)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('student/academic_credits');
    }
    
    public function view_academic_credits($id) {
        if(!hasPermission('access_student_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array(_t('Student Academic Credits'));
		$this->view->less = [ 'less/admin/module.admin.page.form_elements.less' ];
		$this->view->css = [ 'css/admin/module.admin.page.form_elements.min.css' ];
        $this->view->js = [ 
        					'components/modules/admin/forms/elements/fuelux-checkbox/fuelux-checkbox.js?v=v2.1.0',
        					'components/modules/admin/forms/elements/fuelux-radio/fuelux-radio.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-select/assets/lib/js/bootstrap-select.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-select/assets/custom/js/bootstrap-select.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/lib/js/select2.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/custom/js/select2.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/lib/js/bootstrap-datepicker.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/custom/js/bootstrap-datepicker.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-timepicker/assets/lib/js/bootstrap-timepicker.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-timepicker/assets/custom/js/bootstrap-timepicker.init.js?v=v2.1.0'
                            ];
        $this->view->viewAcadCred = $this->model->viewAcadCred($id);
        
        if(empty($this->view->viewAcadCred)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('student/view_academic_credits');
    }
    
    public function courses() {
        if(!hasPermission('access_student_portal')) { redirect( BASE_URL . 'dashboard/' ); }
    	$this->view->staticTitle = array(_t('Course Sections'));
        $this->view->less = [ 'less/admin/module.admin.page.form_elements.less','less/admin/module.admin.page.tables.less' ];
		$this->view->css = [ 'css/admin/module.admin.page.form_elements.min.css','css/admin/module.admin.page.tables.min.css' ];
        $this->view->js = [ 
                            'components/modules/admin/forms/elements/bootstrap-select/assets/lib/js/bootstrap-select.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-select/assets/custom/js/bootstrap-select.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/lib/js/select2.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/custom/js/select2.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/lib/js/bootstrap-datepicker.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/custom/js/bootstrap-datepicker.init.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/lib/js/jquery.dataTables.min.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/lib/extras/TableTools/media/js/TableTools.min.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/custom/js/DT_bootstrap.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/custom/js/datatables.init.js?v=v2.1.0'
                            ];
        $this->view->courseSec = $this->model->courseSec();
		$this->view->render('student/courses');
    }
	
	public function grades($id) {
        if(!hasPermission('access_student_portal')) { redirect( BASE_URL . 'dashboard/' ); }
    	$this->view->staticTitle = array(_t('Grades'));
		$this->view->less = [ 'less/admin/module.admin.page.form_elements.less','less/admin/module.admin.page.tables.less' ];
		$this->view->css = [ 'css/admin/module.admin.page.form_elements.min.css','css/admin/module.admin.page.tables.min.css' ];
        $this->view->js = [ 
                            'components/modules/admin/forms/elements/bootstrap-select/assets/lib/js/bootstrap-select.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-select/assets/custom/js/bootstrap-select.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/lib/js/select2.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/custom/js/select2.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/lib/js/bootstrap-datepicker.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/custom/js/bootstrap-datepicker.init.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/lib/js/jquery.dataTables.min.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/lib/extras/TableTools/media/js/TableTools.min.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/custom/js/DT_bootstrap.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/custom/js/datatables.init.js?v=v2.1.0'
                            ];
        $this->view->gradesAssign = $this->model->gradesAssign($id);
		$this->view->gradesStu = $this->model->gradesStu($id);
		if(empty($this->view->gradesAssign)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
		$this->view->render('student/grades');
    }
    
    public function final_grades() {
        if(!hasPermission('access_student_portal')) { redirect( BASE_URL . 'dashboard/' ); }
    	$this->view->staticTitle = array(_t('Final Grades'));
        $this->view->less = [ 'less/admin/module.admin.page.form_elements.less','less/admin/module.admin.page.tables.less' ];
		$this->view->css = [ 'css/admin/module.admin.page.form_elements.min.css','css/admin/module.admin.page.tables.min.css' ];
        $this->view->js = [ 
                            'components/modules/admin/forms/elements/bootstrap-select/assets/lib/js/bootstrap-select.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-select/assets/custom/js/bootstrap-select.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/lib/js/select2.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/custom/js/select2.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/lib/js/bootstrap-datepicker.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/custom/js/bootstrap-datepicker.init.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/lib/js/jquery.dataTables.min.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/lib/extras/TableTools/media/js/TableTools.min.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/custom/js/DT_bootstrap.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/custom/js/datatables.init.js?v=v2.1.0'
                            ];
        $this->view->finalGrades = $this->model->finalGrades();
		if(empty($this->view->finalGrades)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
		$this->view->render('student/final_grades');
    }
    
    public function portal() {
        if(!hasPermission('access_student_portal')) { redirect( BASE_URL . 'dashboard/' ); }
		$this->view->staticTitle = array(_t('Student Portal'));
		$this->view->render('student/portal');
	}
    
    public function schedule() {
        if(!hasPermission('access_student_portal')) { redirect( BASE_URL . 'dashboard/' ); }
    	$this->view->staticTitle = array(_t('Class Schedule'));
        $this->view->less = [ 'less/admin/module.admin.page.form_elements.less','less/admin/module.admin.page.tables.less' ];
		$this->view->css = [ 'css/admin/module.admin.page.form_elements.min.css','css/admin/module.admin.page.tables.min.css' ];
        $this->view->js = [ 
                            'components/modules/admin/forms/elements/bootstrap-select/assets/lib/js/bootstrap-select.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-select/assets/custom/js/bootstrap-select.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/lib/js/select2.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/custom/js/select2.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/lib/js/bootstrap-datepicker.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/custom/js/bootstrap-datepicker.init.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/lib/js/jquery.dataTables.min.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/lib/extras/TableTools/media/js/TableTools.min.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/custom/js/DT_bootstrap.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/custom/js/datatables.init.js?v=v2.1.0'
                            ];
        $this->view->schedule = $this->model->schedule();
		if(empty($this->view->schedule)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
		$this->view->render('student/schedule');
	}
    
    public function terms() {
        if(!hasPermission('access_student_portal')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array(_t('Class Schedule'));
        $this->view->less = [ 'less/admin/module.admin.page.form_elements.less','less/admin/module.admin.page.tables.less' ];
		$this->view->css = [ 'css/admin/module.admin.page.form_elements.min.css','css/admin/module.admin.page.tables.min.css' ];
        $this->view->js = [ 
                            'components/modules/admin/forms/elements/bootstrap-select/assets/lib/js/bootstrap-select.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-select/assets/custom/js/bootstrap-select.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/lib/js/select2.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/custom/js/select2.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/lib/js/bootstrap-datepicker.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/custom/js/bootstrap-datepicker.init.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/lib/js/jquery.dataTables.min.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/lib/extras/TableTools/media/js/TableTools.min.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/custom/js/DT_bootstrap.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/custom/js/datatables.init.js?v=v2.1.0'
                            ];
        $this->view->term = $this->model->term();
        $this->view->render('student/terms');
    }
    
    public function bill() {
        if(!hasPermission('access_student_portal')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array(_t('My Bills'));
        $this->view->less = [ 'less/admin/module.admin.page.form_elements.less','less/admin/module.admin.page.tables.less' ];
		$this->view->css = [ 'css/admin/module.admin.page.form_elements.min.css','css/admin/module.admin.page.tables.min.css' ];
        $this->view->js = [ 
                            'components/modules/admin/forms/elements/bootstrap-select/assets/lib/js/bootstrap-select.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-select/assets/custom/js/bootstrap-select.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/lib/js/select2.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/custom/js/select2.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/lib/js/bootstrap-datepicker.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/custom/js/bootstrap-datepicker.init.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/lib/js/jquery.dataTables.min.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/lib/extras/TableTools/media/js/TableTools.min.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/custom/js/DT_bootstrap.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/custom/js/datatables.init.js?v=v2.1.0'
                            ];
        $this->view->myBill = $this->model->myBill();
        $this->view->render('student/bill');
    }
    
    public function view_bill($id) {
        if(!hasPermission('access_student_portal')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array(_t('View My Bill'));
        $this->view->bill = $this->model->bill($id);
        $this->view->beginBalance = $this->model->beginBalance($id);
        $this->view->courseFees = $this->model->courseFees($id);
        $this->view->sumRefund = $this->model->sumRefund($id);
        $this->view->sumPayments = $this->model->sumPayments($id);
        $this->view->refund = $this->model->refund($id);
        $this->view->payment = $this->model->payment($id);
        
        if(empty($this->view->bill)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('student/view_bill');
    }
	
	public function graduation() {
	    if(!hasPermission('graduate_students')) { redirect( BASE_URL . 'dashboard/' ); }
		$this->view->staticTitle = array(_t('Graduate Student(s)'));
		$this->view->less = [ 'less/admin/module.admin.page.form_elements.less' ];
		$this->view->css = [ 'css/admin/module.admin.page.form_elements.min.css' ];
        $this->view->js = [ 
                            'components/modules/admin/forms/elements/bootstrap-select/assets/lib/js/bootstrap-select.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-select/assets/custom/js/bootstrap-select.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/lib/js/select2.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/custom/js/select2.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/lib/js/bootstrap-datepicker.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/custom/js/bootstrap-datepicker.init.js?v=v2.1.0'
                            ];
		$this->view->render('student/graduation');
	}
	
	public function tran() {
	    if(!hasPermission('access_tran_screen')) { redirect( BASE_URL . 'dashboard/' ); }
		$this->view->staticTitle = array(_t('Generate Transcript(s)'));
		$this->view->less = [ 'less/admin/module.admin.page.form_elements.less','less/admin/module.admin.page.tables_responsive.less' ];
		$this->view->css = [ 'css/admin/module.admin.page.form_elements.min.css','css/admin/module.admin.page.tables_responsive.min.css' ];
        $this->view->js = [ 
        					'components/modules/admin/forms/elements/fuelux-checkbox/fuelux-checkbox.js?v=v2.1.0',
        					'components/modules/admin/forms/elements/fuelux-radio/fuelux-radio.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-select/assets/lib/js/bootstrap-select.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-select/assets/custom/js/bootstrap-select.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/lib/js/select2.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/custom/js/select2.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/lib/js/bootstrap-datepicker.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/custom/js/bootstrap-datepicker.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-timepicker/assets/lib/js/bootstrap-timepicker.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-timepicker/assets/custom/js/bootstrap-timepicker.init.js?v=v2.1.0'
                            ];
		$this->view->render('student/tran');
	}
	
	public function generate() {
	    if(!hasPermission('access_tran_screen')) { redirect( BASE_URL . 'dashboard/' ); }
	    $this->view->staticTitle = array(_t('Transcript'));
	    $this->view->stuInfo = $this->model->tranStuInfo();
	    $this->view->courses = $this->model->tranCourse();
        $this->view->tranGPA = $this->model->tranGPA();
		if(empty($this->view->stuInfo)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        $this->view->render('bh',true);
        $this->view->render('student/generate',true);
        $this->view->render('bf',true);
    }
    
    public function runStudent() {
        if(!hasPermission('create_stu_record')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = array();
        $data['stuID'] = isPostSet('stuID');
        $data['advisorID'] = isPostSet('advisorID');
        $data['catYearCode'] = isPostSet('catYearCode');
        $data['antGradDate'] = isPostSet('antGradDate');
        $data['acadLevelCode'] = isPostSet('acadLevelCode');
        $data['addDate'] = isPostSet('addDate');
        $data['approvedBy'] = isPostSet('approvedBy');
        $data['acadProgCode'] = isPostSet('acadProgCode');
        $data['startDate'] = isPostSet('startDate');
        $data['status'] = isPostSet('status');
        $this->model->runStudent($data);
    }
    
     public function runEditStudent() {
         if(!hasPermission('create_stu_record')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = array();
        $data['stuID'] = isPostSet('stuID');
        $data['advisorID'] = isPostSet('advisorID');
        $data['acadLevelCode'] = isPostSet('acadLevelCode');
        $data['catYearCode'] = isPostSet('catYearCode');
        $data['status'] = isPostSet('status');
        $this->model->runEditStudent($data);
    }
     
    public function runStuProg() {
        if(!hasPermission('create_stu_record')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = array();
        $data['stuID'] = isPostSet('stuID');
        $data['currStatus'] = isPostSet('currStatus');
        $data['startDate'] = isPostSet('startDate');
        $data['endDate'] = isPostSet('endDate');
        $data['acadProgCode'] = isPostSet('acadProgCode');
        $data['antGradDate'] = isPostSet('antGradDate');
        $data['advisorID'] = isPostSet('advisorID');
        $data['catYearCode'] = isPostSet('catYearCode');
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
        $data['antGradDate'] = isPostSet('antGradDate');
        $data['advisorID'] = isPostSet('advisorID');
        $data['catYearCode'] = isPostSet('catYearCode');
        $data['eligible_to_graduate'] = isPostSet('eligible_to_graduate');
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
        $data['courseSecCode'] = isPostSet('courseSecCode');
        $data['termCode'] = isPostSet('termCode');
        $this->model->runAcadCred($data);
    }
    
    public function runProgLookup() {
        if(!hasPermission('create_stu_record')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = array();
        $data['acadProgCode'] = isPostSet('acadProgCode');
        $this->model->runProgLookup($data);
    }
    
    public function runRegister() {
        if(!hasPermission('access_student_portal')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = [];
        $data['courseSecCode'] = isPostSet('courseSecCode');
        $data['termCode'] = isPostSet('termCode');
        $data['courseCredits'] = isPostSet('courseCredits');
		$data['courseFee'] = isPostSet('courseFee');
		$data['labFee'] = isPostSet('labFee');
		$data['materialFee'] = isPostSet('materialFee');
        $this->model->runRegister($data);
    }
    
    public function runGraduation() {
        $data = [];
        $data['studentID'] = isPostSet('studentID');
        $data['queryID'] = isPostSet('queryID');
        $data['gradDate'] = isPostSet('gradDate');
        $this->model->runGraduation($data);
    }
    
    public function runRSTR() {
        $data = [];
        $data['stuID'] = isPostSet('stuID');
        $data['rstrCode'] = isPostSet('rstrCode');
        $data['severity'] = isPostSet('severity');
        $data['startDate'] = isPostSet('startDate');
        $data['endDate'] = isPostSet('endDate');
        $data['comment'] = isPostSet('comment');
        $data['addDate'] = isPostSet('addDate');
        $data['addedBy'] = isPostSet('addedBy');
        $this->model->runRSTR($data);
    }
    
    public function runEditRSTR() {
        $data = [];
        $data['stuID'] = isPostSet('stuID');
        $data['rstrCode'] = isPostSet('rstrCode');
        $data['severity'] = isPostSet('severity');
        $data['startDate'] = isPostSet('startDate');
        $data['endDate'] = isPostSet('endDate');
        $data['comment'] = isPostSet('comment');
        $data['rstrID'] = isPostSet('rstrID');
        $this->model->runEditRSTR($data);
    }
    
    public function search() {
        if(!hasPermission('access_student_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->model->search();
    }
	
}