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
 * @since       3.0.0
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */

class Section extends \eduTrac\Classes\Core\Controller {

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
	    if(!hasPermission('access_course_sec_screen')) { redirect( BASE_URL . 'dashboard/' ); }
		$this->view->staticTitle = array(_t('Search Section'));
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
		$this->view->render('section/index');
	}
    
    public function add($id) {
        if(!hasPermission('add_course_sec')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array(_t('Add Section'));
        $this->view->crse = $this->model->crse($id);
        $this->view->less = [ 'less/admin/module.admin.page.form_elements.less' ];
		$this->view->css = [ 'css/admin/module.admin.page.form_elements.min.css' ];
        $this->view->js = [ 
                            'components/modules/admin/forms/elements/bootstrap-select/assets/lib/js/bootstrap-select.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-select/assets/custom/js/bootstrap-select.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/lib/js/select2.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/custom/js/select2.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/lib/js/bootstrap-datepicker.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/custom/js/bootstrap-datepicker.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-maxlength/bootstrap-maxlength.min.js',
                            'components/modules/admin/forms/elements/bootstrap-maxlength/custom/js/custom.js'
                            ];
        if(empty($this->view->crse)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        $this->view->render('section/add');
    }
    
    public function view($id) {
        if(!hasPermission('access_course_sec_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array(_t('View Section'));
        $this->view->sec = $this->model->section($id);
        $this->view->less = [ 'less/admin/module.admin.page.form_elements.less' ];
		$this->view->css = [ 'css/admin/module.admin.page.form_elements.min.css' ];
        $this->view->js = [ 
                            'components/modules/admin/forms/elements/bootstrap-select/assets/lib/js/bootstrap-select.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-select/assets/custom/js/bootstrap-select.init.js?v=v2.1.0',
                            //'components/modules/admin/forms/elements/select2/assets/lib/js/select2.js?v=v2.1.0',
                            //'components/modules/admin/forms/elements/select2/assets/custom/js/select2.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/lib/js/bootstrap-datepicker.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/custom/js/bootstrap-datepicker.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-maxlength/bootstrap-maxlength.min.js',
                            'components/modules/admin/forms/elements/bootstrap-maxlength/custom/js/custom.js'
                            ];
        if(empty($this->view->sec)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('section/view');
    }
    
    public function addnl_info($id) {
        if(!hasPermission('access_course_sec_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array(_t('Additional Course Section Info'));
        $this->view->addnl = $this->model->section($id);
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
        if(empty($this->view->addnl)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('section/addnl_info');
    }
    
    public function offering_info($id) {
        if(!hasPermission('access_course_sec_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array(_t('Course Section Offering Info'));
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
        $this->view->soff = $this->model->soff($id);
        
        if(empty($this->view->soff)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('section/offering_info');
    }
    
    public function billing_info($id) {
        if(!hasPermission('access_course_sec_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array(_t('Course Section Billing Info'));
        $this->view->binfo = $this->model->binfo($id);
        
        if(empty($this->view->binfo)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('section/billing_info');
    }
    
    public function booking_info($id) {
        if(!hasPermission('access_course_sec_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array(_t('Course Section Booking Info'));
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
        $this->view->bookInfo = $this->model->bookInfo($id);
        $this->view->booking = $this->model->booking($id);
        
        if(empty($this->view->bookInfo)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('section/booking_info');
    }
    
    public function register() {
        if(!hasPermission('register_students')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array(_t('Course Registration'));
		$this->view->less = [ 'less/admin/module.admin.page.form_elements.less' ];
		$this->view->css = [ 'css/admin/module.admin.page.form_elements.min.css' ];
        $this->view->js = [ 
                            'components/modules/admin/forms/elements/bootstrap-select/assets/lib/js/bootstrap-select.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-select/assets/custom/js/bootstrap-select.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/lib/js/select2.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/custom/js/select2.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/lib/js/bootstrap-datepicker.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/custom/js/bootstrap-datepicker.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/jCombo/jquery.jCombo.min.js'
                            ];
        $this->view->render('section/register');
    }
    
    public function batch_register() {
        if(!hasPermission('register_students')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array(_t('Batch Course Registration'));
		$this->view->less = [ 'less/admin/module.admin.page.form_elements.less' ];
		$this->view->css = [ 'css/admin/module.admin.page.form_elements.min.css' ];
        $this->view->js = [ 
                            'components/modules/admin/forms/elements/bootstrap-select/assets/lib/js/bootstrap-select.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-select/assets/custom/js/bootstrap-select.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/lib/js/select2.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/custom/js/select2.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/lib/js/bootstrap-datepicker.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/custom/js/bootstrap-datepicker.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/jCombo/jquery.jCombo.min.js'
                            ];
        $this->view->render('section/batch_register');
    }
	
	public function sros() {
        if(!hasPermission('access_stu_roster_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array(_t('Print Student Roster'));
		$this->view->less = [ 'less/admin/module.admin.page.form_elements.less' ];
		$this->view->css = [ 'css/admin/module.admin.page.form_elements.min.css' ];
        $this->view->js = [ 
                            'components/modules/admin/forms/elements/bootstrap-select/assets/lib/js/bootstrap-select.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-select/assets/custom/js/bootstrap-select.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/lib/js/select2.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/custom/js/select2.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/lib/js/bootstrap-datepicker.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/custom/js/bootstrap-datepicker.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/jCombo/jquery.jCombo.min.js'
                            ];
        $this->view->render('section/sros');
    }
	
	public function roster() {
	    if(!hasPermission('access_stu_roster_screen')) { redirect( BASE_URL . 'dashboard/' ); }
	    $this->view->staticTitle = array(_t('Student Section Roster'));
	    $this->view->roster = $this->model->roster();
		$this->view->rosterCount = $this->model->rosterCount();
		if(empty($this->view->roster)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        $this->view->render('bh',true);
        $this->view->render('section/roster',true);
        $this->view->render('bf',true);
    }
    
    public function courses() {
        if(!hasPermission('access_grading_screen')) { redirect( BASE_URL . 'dashboard/' ); }
		$this->view->staticTitle = array(_t('My Course Sections'));
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
		$this->view->render('section/courses');
	}
    
    public function catalog() {
        if(!hasPermission('access_course_sec_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array(_t('Course Catalog By Terms'));
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
        $this->view->catalog = $this->model->catalog();
        $this->view->render('section/catalog');
    }
    
    public function pdf() {
        if(!hasPermission('access_course_sec_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array(_t('Course Catalog'));
        $this->view->pdf = $this->model->pdf();
        if(empty($this->view->pdf)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        $this->view->render('bh',true);
        $this->view->render('section/pdf',true);
        $this->view->render('bf',true);
    }
	
	public function add_assignment($id) {
        if(!hasPermission('access_grading_screen')) { redirect( BASE_URL . 'dashboard/' ); }
		$this->view->staticTitle = array(_t('Add Course Section Assignment'));
        $this->view->addAssign = $this->model->addAssign($id);
		$this->view->less = [ 'less/admin/module.admin.page.form_elements.less' ];
		$this->view->css = [ 'css/admin/module.admin.page.form_elements.min.css' ];
		$this->view->js = [ 
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/lib/js/bootstrap-datepicker.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/custom/js/bootstrap-datepicker.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-maxlength/bootstrap-maxlength.min.js',
                            'components/modules/admin/forms/elements/bootstrap-maxlength/custom/js/custom.js'
                            ];
		if(empty($this->view->addAssign)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
		$this->view->render('section/add_assignment');
	}
	
	public function assignments($id) {
        if(!hasPermission('access_grading_screen')) { redirect( BASE_URL . 'dashboard/' ); }
		$this->view->staticTitle = array(_t('Course Section Assignments'));
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
        $this->view->assignments = $this->model->assignments($id);
		if(empty($this->view->assignments)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
		$this->view->render('section/assignments');
	}
	
	public function view_assignment($id) {
        if(!hasPermission('access_grading_screen')) { redirect( BASE_URL . 'dashboard/' ); }
		$this->view->staticTitle = array(_t('View Course Section Assignment'));
        $this->view->viewAssign = $this->model->viewAssign($id);
		$this->view->less = [ 'less/admin/module.admin.page.form_elements.less' ];
		$this->view->css = [ 'css/admin/module.admin.page.form_elements.min.css' ];
        $this->view->js = [ 
                            'components/modules/admin/forms/elements/bootstrap-select/assets/lib/js/bootstrap-select.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-select/assets/custom/js/bootstrap-select.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/lib/js/select2.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/custom/js/select2.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/lib/js/bootstrap-datepicker.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/custom/js/bootstrap-datepicker.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/jCombo/jquery.jCombo.min.js'
                            ];
		if(empty($this->view->viewAssign)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
		$this->view->render('section/view_assignment');
	}
    
    public function attendance($id) {
        if(!hasPermission('access_grading_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array(_t('Attendance'));
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
        $this->view->attendance = $this->model->attendance($id);
		if(empty($this->view->attendance)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        $this->view->render('section/attendance');
    }
	
	public function grading($id) {
        if(!hasPermission('access_grading_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array(_t('Course Section Grading'));
        $this->view->grades = $this->model->grades($id);
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
		if(empty($this->view->grades)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        $this->view->render('section/grading');
    }
	
	public function export_grades($id) {
        if(!hasPermission('access_grading_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array(_t('Export Course Section Grades'));
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
        $this->view->grades = $this->model->grades($id);
		if(empty($this->view->grades)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        $this->view->render('section/export_grades');
    }
	
	public function gradebook($code) {
        if(!hasPermission('access_grading_screen')) { redirect( BASE_URL . 'dashboard/' ); }
		$this->view->staticTitle = array(_t('Course Section Gradebook'));
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
        $this->view->gradebookAssign = $this->model->gradebookAssign($code);
		$this->view->gradebookStu = $this->model->gradebookStu($code);
		if(empty($this->view->gradebookAssign)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
		$this->view->render('section/gradebook');
	}
    
    public function attendance_report($id) {
        if(!hasPermission('access_grading_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array(_t('Attendance Report'));
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
        $this->view->report = $this->model->attendanceReport($id);
        
        if(empty($this->view->report)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        $this->view->render('section/attendance_report');
    }
    
    public function final_grade($id) {
        if(!hasPermission('access_grading_screen')) { redirect( BASE_URL . 'dashboard/' ); }
    	$this->view->staticTitle = array(_t('Course Section Final Grade'));
		$this->view->less = [ 'less/admin/module.admin.page.form_elements.less','less/admin/module.admin.page.tables.less' ];
		$this->view->css = [ 'css/admin/module.admin.page.form_elements.min.css','css/admin/module.admin.page.tables.min.css' ];
        $this->view->js = [ 
                            'components/modules/admin/forms/elements/bootstrap-select/assets/lib/js/bootstrap-select.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-select/assets/custom/js/bootstrap-select.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/lib/js/select2.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/custom/js/select2.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/lib/js/bootstrap-datepicker.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/custom/js/bootstrap-datepicker.init.js?v=v2.1.0',
                            ];
        $this->view->finalGrade = $this->model->finalGrade($id);
        
        if(empty($this->view->finalGrade)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
		$this->view->render('section/final_grade');
	}
	
	public function fg_export($id) {
        if(!hasPermission('access_grading_screen')) { redirect( BASE_URL . 'dashboard/' ); }
    	$this->view->staticTitle = array(_t('Export Final Grade'));
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
        $this->view->finalGrade = $this->model->finalGrade($id);
        
        if(empty($this->view->finalGrade)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
		$this->view->render('section/fg_export');
	}
    
    public function progress() {
        if(!hasPermission('access_grading_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array(_t('Create Progress Report'));
        $this->view->render('section/progress');
    }
    
    public function runSection() {
        if(!hasPermission('add_course_sec')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = array();
        $data['courseID'] = isPostSet('courseID');
        $data['sectionNumber'] = isPostSet('sectionNumber');
        $data['locationCode'] = isPostSet('locationCode');
        $data['termCode'] = isPostSet('termCode');
        $data['courseCode'] = isPostSet('courseCode');
        $data['secShortTitle'] = isPostSet('secShortTitle');
        $data['startDate'] = isPostSet('startDate');
        $data['endDate'] = isPostSet('endDate');
        $data['deptCode'] = isPostSet('deptCode');
        $data['minCredit'] = isPostSet('minCredit');
        //$data['maxCredit'] = isPostSet('maxCredit');
        //$data['increCredit'] = isPostSet('increCredit');
        $data['ceu'] = isPostSet('ceu');
        $data['courseLevelCode'] = isPostSet('courseLevelCode');
        $data['acadLevelCode'] = isPostSet('acadLevelCode');
        $data['currStatus'] = isPostSet('currStatus');
        $data['statusDate'] = isPostSet('statusDate');
		$data['comment'] = isPostSet('comment');
        $data['approvedDate'] = isPostSet('approvedDate');
        $data['approvedBy'] = isPostSet('approvedBy');
        $this->model->runSection($data);
    }
    
    public function runEditSection() {
        if(!hasPermission('add_course_sec')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = array();
        $data['locationCode'] = isPostSet('locationCode');
        $data['termCode'] = isPostSet('termCode');
        $data['courseCode'] = isPostSet('courseCode');
        $data['secShortTitle'] = isPostSet('secShortTitle');
        $data['startDate'] = isPostSet('startDate');
        $data['endDate'] = isPostSet('endDate');
        $data['deptCode'] = isPostSet('deptCode');
        $data['minCredit'] = isPostSet('minCredit');
        //$data['maxCredit'] = isPostSet('maxCredit');
        //$data['increCredit'] = isPostSet('increCredit');
        $data['ceu'] = isPostSet('ceu');
        $data['courseLevelCode'] = isPostSet('courseLevelCode');
        $data['acadLevelCode'] = isPostSet('acadLevelCode');
        $data['currStatus'] = isPostSet('currStatus');
        $data['statusDate'] = isPostSet('statusDate');
		$data['comment'] = isPostSet('comment');
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
        $data['buildingCode'] = isPostSet('buildingCode');
        $data['roomCode'] = isPostSet('roomCode');
        $data['dotw'] = isPostSet('dotw');
        $data['startTime'] = isPostSet('startTime');
        $data['endTime'] = isPostSet('endTime');
        $data['stuReg'] = isPostSet('stuReg');
        $data['courseSecID'] = isPostSet('courseSecID');
        $this->model->runSOFF($data);
    }
    
    public function runBINFO() {
        if(!hasPermission('add_crse_sec_bill')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = array();
        $data['courseFee'] = isPostSet('courseFee');
        $data['labFee'] = isPostSet('labFee');
        $data['materialFee'] = isPostSet('materialFee');
        $data['courseSecID'] = isPostSet('courseSecID');
        $this->model->runBINFO($data);
    }
    
    public function search() {
        if(!hasPermission('access_course_sec_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->model->search();
    }
    
    public function runTermLookup() {
        $this->model->runTermLookup();
    }
	
	public function runSecTermLookup() {
        if(!hasPermission('add_course_sec')) { redirect( BASE_URL . 'dashboard/' ); }
		$data = array();
        $data['termCode'] = isPostSet('termCode');
        $this->model->runSecTermLookup($data);
    }
    
    public function runStuLookup() {
        $data = array();
        $data['stuID'] = isPostSet('stuID');
        $this->model->runStuLookup($data);
    }
    
    public function runSecLookup() {
        if(!hasPermission('add_course_sec')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->model->runSecLookup();
    }
	
	public function runSecRosterLookup() {
        $this->model->runSecRosterLookup();
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
    
    public function runAttendance() {
        if(!hasPermission('access_grading_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = array();
        $data['stuID'] = isPostSet('stuID');
        $data['termCode'] = isPostSet('termCode');
        $data['courseSecCode'] = isPostSet('courseSecCode');
        $data['status'] = isPostSet('status');
        $data['date'] = isPostSet('date');
        $this->model->runAttendance($data);
    }
	
	public function runGrades() {
		if(!hasPermission('access_grading_screen')) { redirect( BASE_URL . 'dashboard/' ); }
		$data = [];
		$data['assignID'] = isPostSet('assignID');
        $data['termCode'] = isPostSet('termCode');
		$data['courseSecCode'] = isPostSet('courseSecCode');
		$data['facID'] = isPostSet('facID');
		$data['stuID'] = isPostSet('stuID');
		$data['grade'] = isPostSet('grade');
		$data['addDate'] = isPostSet('addDate');
		$data['addedBy'] = isPostSet('addedBy');
		$this->model->runGrades($data);
	}
    
    public function runFinalGrade() {
        if(!hasPermission('access_grading_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = [];
        $data['stuID'] = isPostSet('stuID');
        $data['courseSecCode'] = isPostSet('courseSecCode');
        $data['termCode'] = isPostSet('termCode');
        $data['grade'] = isPostSet('grade');
        $data['cmplCredit'] = isPostSet('cmplCredit');
        $this->model->runFinalGrade($data);
    }
    
    public function runProgress() {
        if(!hasPermission('access_grading_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = [];
        $data['stuID'] = isPostSet('stuID');
        $data['grade'] = isPostSet('grade');
        $data['subject'] = isPostSet('subject');
        $data['courseTitle'] = isPostSet('courseTitle');
        $data['semester'] = isPostSet('semester');
        $data['behavior'] = isPostSet('behavior');
        $data['assignments'] = isPostSet('assignments');
        $data['notes'] = isPostSet('notes');
        $this->model->runProgress($data);
    }
	
	public function runAssignment() {
		$data = [];
		$data['shortName'] = isPostSet('shortName');
		$data['title'] = isPostSet('title');
		$data['dueDate'] = isPostSet('dueDate');
		$data['termCode'] = isPostSet('termCode');
		$data['courseSecCode'] = isPostSet('courseSecCode');
		$data['facID'] = isPostSet('facID');
		$data['addDate'] = isPostSet('addDate');
		$data['addedBy'] = isPostSet('addedBy');
		$this->model->runAssignment($data);
	}
	
	public function runEditAssignment() {
		$data = [];
		$data['title'] = isPostSet('title');
		$data['dueDate'] = isPostSet('dueDate');
		$data['ID'] = isPostSet('assignID');
		$this->model->runEditAssignment($data);
	}
    
    public function runBookingInfo() {
        $data = [];
        $data['courseSecID'] = isPostSet('courseSecID');
        $data['roomCode'] = isPostSet('roomCode');
        $data['termCode'] = isPostSet('termCode');
        $data['title'] = isPostSet('courseSecCode');
        $data['description'] = isPostSet('courseSecCode');
        $data['startDate'] = isPostSet('startDate');
        $data['endDate'] = isPostSet('endDate');
        $data['startTime'] = isPostSet('startTime');
        $data['endTime'] = isPostSet('endTime');
        $data['repeats'] = isPostSet('repeats');
        $data['repeatFreq'] = isPostSet('repeatFreq');
        $this->model->runBookingInfo($data);
    }
    
    public function runCheckConflicts() {
        $data = [];
        $data['roomCode'] = isPostSet('roomCode');
        $data['termCode'] = isPostSet('termCode');
        $data['startDate'] = isPostSet('startDate');
        $data['endDate'] = isPostSet('endDate');
        $data['startTime'] = isPostSet('startTime');
        $data['endTime'] = isPostSet('endTime');
        $data['repeats'] = isPostSet('repeats');
        $data['repeatFreq'] = isPostSet('repeatFreq');
        $this->model->runCheckConflicts($data);
    }
    
    public function deleteCourse($id) {
        if(!hasPermission('add_course_sec')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->model->deleteCourse($id);
    }
	
}