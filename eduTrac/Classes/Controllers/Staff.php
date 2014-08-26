<?php namespace eduTrac\Classes\Controllers;
/**
 * Staff Controller
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

if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');

class Staff extends \eduTrac\Classes\Core\Controller {

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
	    if(!hasPermission('access_staff_screen')) { redirect( BASE_URL . 'dashboard/' ); }
		$this->view->staticTitle = array(_t('Search Staff'));
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
		$this->view->render('staff/index');
	}
    
    public function add($id) {
        if(!hasPermission('create_staff_record')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array(_t('Add Staff'));
        $this->view->person = $this->model->person($id);
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
        if(empty($this->view->person)) {
            redirect( BASE_URL . 'staff/view/' . $id . '/' );
        }
        $this->view->render('staff/add');
    }
    
    public function view($id) {
        if(!hasPermission('create_staff_record')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array(_t('View Staff'));
        $this->view->staff = $this->model->staff($id);
        $this->view->staffAddr = $this->model->staffAddr($id);
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
        if(empty($this->view->staff)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('staff/view');
    }
    
    public function timesheets() {
        if(!hasPermission('submit_timesheets')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array(_t('Timesheets'));
        $this->view->less = [ 'less/admin/module.admin.page.form_elements.less','less/admin/module.admin.page.tables.less' ];
		$this->view->css = [ 'css/admin/module.admin.page.form_elements.min.css','css/admin/module.admin.page.tables.min.css' ];
        $this->view->js = [ 
                            'components/modules/admin/forms/elements/bootstrap-select/assets/lib/js/bootstrap-select.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-select/assets/custom/js/bootstrap-select.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/lib/js/select2.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/custom/js/select2.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/lib/js/bootstrap-datepicker.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/custom/js/bootstrap-datepicker.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-timepicker/assets/lib/js/bootstrap-timepicker.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-timepicker/assets/custom/js/bootstrap-timepicker.init.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/lib/js/jquery.dataTables.min.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/lib/extras/TableTools/media/js/TableTools.min.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/custom/js/DT_bootstrap.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/custom/js/datatables.init.js?v=v2.1.0'
                            ];
        $this->view->timesheets = $this->model->timesheets();
        $this->view->render('staff/timesheets');
    }
    
    public function view_timesheet($week) {
        if(!hasPermission('submit_timesheets')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array(_t('View Timesheet'));
		$this->view->less = [ 'less/admin/module.admin.page.form_elements.less','less/admin/module.admin.page.tables.less' ];
		$this->view->css = [ 'css/admin/module.admin.page.form_elements.min.css','css/admin/module.admin.page.tables.min.css' ];
        $this->view->js = [ 
                            'components/modules/admin/forms/elements/bootstrap-select/assets/lib/js/bootstrap-select.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-select/assets/custom/js/bootstrap-select.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/lib/js/select2.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/custom/js/select2.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/lib/js/bootstrap-datepicker.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/custom/js/bootstrap-datepicker.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-timepicker/assets/lib/js/bootstrap-timepicker.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-timepicker/assets/custom/js/bootstrap-timepicker.init.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/lib/js/jquery.dataTables.min.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/lib/extras/TableTools/media/js/TableTools.min.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/custom/js/DT_bootstrap.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/custom/js/datatables.init.js?v=v2.1.0'
                            ];
        $this->view->viewTimeSheet = $this->model->viewTimeSheet($week);
        if(empty($this->view->viewTimeSheet)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        $this->view->render('staff/view_timesheet');
    }
    
    public function runStaff() {
        if(!hasPermission('create_staff_record')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = array();
        $data['staffID'] = isPostSet('staffID');
        $data['supervisorID'] = isPostSet('supervisorID');
        $data['schoolCode'] = isPostSet('schoolCode');
        $data['buildingCode'] = isPostSet('buildingCode');
        $data['officeCode'] = isPostSet('officeCode');
        $data['jobStatusCode'] = isPostSet('jobStatusCode');
        $data['jobID'] = isPostSet('jobID');
        $data['office_phone'] = isPostSet('office_phone');
        $data['deptCode'] = isPostSet('deptCode');
        $data['staffType'] = isPostSet('staffType');
        $data['status'] = isPostSet('status');
        $data['hireDate'] = isPostSet('hireDate');
        $data['startDate'] = isPostSet('startDate');
        $data['endDate'] = isPostSet('endDate');
        $data['addDate'] = isPostSet('addDate');
        $data['approvedBy'] = isPostSet('approvedBy');
        $this->model->runStaff($data);
    }
    
     public function runEditStaff() {
        if(!hasPermission('create_staff_record')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = array();
        $data['staffID'] = isPostSet('staffID');
        $data['schoolCode'] = isPostSet('schoolCode');
        $data['buildingCode'] = isPostSet('buildingCode');
        $data['officeCode'] = isPostSet('officeCode');
        $data['office_phone'] = isPostSet('office_phone');
        $data['deptCode'] = isPostSet('deptCode');
        $data['status'] = isPostSet('status');
        $this->model->runEditStaff($data);
    }
    
    public function runTimeSheets() {
        if(!hasPermission('submit_timesheets')) { redirect( BASE_URL . 'dashboard/' ); exit(); }
        $data = [];
        $data['employeeID'] = isPostSet('employeeID');
        $data['jobID'] = isPostSet('jobID');
        $data['workWeek'] = isPostSet('workWeek');
        $data['startDateTime'] = isPostSet('startDateTime');
        $data['endDateTime'] = isPostSet('endDateTime');
        $data['note'] = isPostSet('note');
        $data['addDate'] = isPostSet('addDate');
        $data['addedBy'] = isPostSet('addedBy');
        $this->model->runTimeSheets($data);
    }
    
    public function search() {
        if(!hasPermission('access_staff_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->model->search();
    }
	
}