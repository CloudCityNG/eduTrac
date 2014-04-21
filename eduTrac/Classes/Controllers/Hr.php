<?php namespace eduTrac\Classes\Controllers;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Human Resources Controller
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
 * @since       3.0.2
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */

class Hr extends \eduTrac\Classes\Core\Controller {
	
	public function __construct() {
		parent::__construct();
        if(!hasPermission('access_human_resources')) { redirect( BASE_URL . 'dashboard/' ); }
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
		$this->view->staticTitle = array(_t('Search Employees'));
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
		$this->view->render('hr/index');
	}
	
	public function add($id) {
        $this->view->staticTitle = array(_t('Add New Position'));
        $this->view->addPosition = $this->model->addPosition($id);
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
		if(empty($this->view->addPosition)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        $this->view->render('hr/add');
    }
    
    public function view($id) {
        $this->view->staticTitle = array(_t('View Employee'));
        $this->view->employee = $this->model->employee($id);
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
		if(empty($this->view->employee)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        $this->view->render('hr/view');
    }
	
	public function grades() {
		$this->view->staticTitle = array(_t('Pay Grades'));
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
		$this->view->grades = $this->model->grades();
		$this->view->render('hr/grades');
	}
	
	public function jobs() {
		$this->view->staticTitle = array(_t('Job Titles'));
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
		$this->view->jobs = $this->model->jobs();
		$this->view->render('hr/jobs');
	}
	
	public function timesheets() {
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
                            'components/modules/admin/tables/datatables/assets/lib/js/jquery.dataTables.min.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/lib/extras/TableTools/media/js/TableTools.min.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/custom/js/DT_bootstrap.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/custom/js/datatables.init.js?v=v2.1.0'
                            ];
		$this->view->timesheets = $this->model->timesheets();
		$this->view->render('hr/timesheets');
	}
    
    public function view_timesheet() {
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
        $this->view->viewTimeSheet = $this->model->viewTimeSheet();
        if(empty($this->view->viewTimeSheet)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        $this->view->render('hr/view_timesheet');
    }
    
    public function edit_ts_record() {
        $this->view->staticTitle = array(_t('View Timesheet Record'));
        $this->view->editTSRecord = $this->model->editTSRecord();
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
        if(empty($this->view->editTSRecord)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        $this->view->render('hr/edit_ts_record');
    }
	
	public function positions($id) {
        $this->view->staticTitle = array(_t('View Employee Positions'));
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
        $this->view->positions = $this->model->positions($id);
		if(empty($this->view->positions)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        $this->view->render('hr/positions');
    }
	
	public function runPayGrade() {
		$data = [];
		$data['grade'] = isPostSet('grade');
		$data['minimum_salary'] = isPostSet('minimum_salary');
		$data['maximum_salary'] = isPostSet('maximum_salary');
		$data['addDate'] = isPostSet('addDate');
		$data['addedBy'] = isPostSet('addedBy');
		$this->model->runPayGrade($data);
	}
	
	public function runEditPayGrade() {
		$data = [];
		$data['grade'] = isPostSet('grade');
		$data['minimum_salary'] = isPostSet('minimum_salary');
		$data['maximum_salary'] = isPostSet('maximum_salary');
		$data['ID'] = isPostSet('ID');
		$this->model->runEditPayGrade($data);
	}
	
	public function runJobTitle() {
		$data = [];
		$data['pay_grade'] = isPostSet('pay_grade');
		$data['title'] = isPostSet('title');
		$data['hourly_wage'] = isPostSet('hourly_wage');
		$data['weekly_hours'] = isPostSet('weekly_hours');
		$data['addDate'] = isPostSet('addDate');
		$data['addedBy'] = isPostSet('addedBy');
		$this->model->runJobTitle($data);
	}
	
	public function runEditJobTitle() {
		$data = [];
		$data['pay_grade'] = isPostSet('pay_grade');
		$data['title'] = isPostSet('title');
		$data['hourly_wage'] = isPostSet('hourly_wage');
		$data['weekly_hours'] = isPostSet('weekly_hours');
		$data['ID'] = isPostSet('ID');
		$this->model->runEditJobTitle($data);
	}
	
	public function runTimeSheet() {
		$data = [];
        $data['ID'] = isPostSet('ID');
		$data['employeeID'] = isPostSet('employeeID');
		$data['status'] = isPostSet('status');
        //$data['week'] = isPostSet('week');
        //$data['staffID'] = isPostSet('staffID');
		$this->model->runTimeSheet($data);
	}
    
    public function runEditTimeSheet() {
    	$start = isPostSet('workDay').' '.isPostSet('startTime');
		$end = isPostSet('workDay').' '.isPostSet('endTime');
        $data = [];
        $data['ID'] = isPostSet('ID');
        $data['workWeek'] = isPostSet('workWeek');
        $data['startDateTime'] = $start;
        $data['endDateTime'] = $end;
        $data['note'] = isPostSet('note');
        $data['staffID'] = isPostSet('staffID');
        $this->model->runEditTimeSheet($data);
    }
	
	public function runEditEmployee() {
		$data = [];
		$data['jobStatus'] = isPostSet('jobStatusCode');
		$data['type'] = isPostSet('staffType');
		$data['supervisor'] = isPostSet('supervisorID');
		$data['job'] = isPostSet('jobID');
		$data['building'] = isPostSet('buildingCode');
		$data['office'] = isPostSet('officeCode');
		$data['phone'] = isPostSet('office_phone');
		$data['school'] = isPostSet('schoolCode');
		$data['dept'] = isPostSet('deptCode');
		$data['hire'] = isPostSet('hireDate');
		$data['start'] = isPostSet('startDate');
		$data['end'] = isPostSet('endDate');
		$data['status'] = isPostSet('status');
		$data['staffID'] = isPostSet('staffID');
		$data['meta'] = isPostSet('sMetaID');
		$this->model->runEditEmployee($data);
	}
	
	public function runPosition() {
		$data = [];
		$data['jobStatus'] = isPostSet('jobStatusCode');
		$data['type'] = isPostSet('staffType');
		$data['supervisor'] = isPostSet('supervisorID');
		$data['job'] = isPostSet('jobID');
		$data['hire'] = isPostSet('hireDate');
		$data['start'] = isPostSet('startDate');
		$data['end'] = isPostSet('endDate');
		$data['staffID'] = isPostSet('staffID');
		$data['addDate'] = isPostSet('addDate');
		$data['approvedBy'] = isPostSet('approvedBy');
		$this->model->runPosition($data);
	}
	
	public function runEditPosition() {
		$data = [];
		$data['jobStatus'] = isPostSet('jobStatusCode');
		$data['type'] = isPostSet('staffType');
		$data['supervisor'] = isPostSet('supervisorID');
		$data['job'] = isPostSet('jobID');
		$data['hire'] = isPostSet('hireDate');
		$data['start'] = isPostSet('startDate');
		$data['end'] = isPostSet('endDate');
		$data['staffID'] = isPostSet('staffID');
		$data['meta'] = isPostSet('sMetaID');
		$this->model->runEditPosition($data);
	}
    
    public function search() {
        $this->model->search();
    }

}