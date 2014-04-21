<?php namespace eduTrac\Classes\Controllers;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Form Controller
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

class Form extends \eduTrac\Classes\Core\Controller {
	
    private $_auth;
    
	public function __construct() {
		parent::__construct();
        $this->_auth = new \eduTrac\Classes\Libraries\Cookies();
        if(!hasPermission('access_forms')) { redirect( BASE_URL . 'dashboard/' ); }
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
		redirect( BASE_URL . 'dashboard/' );
	}
	
	/* Begins semester methods */
	public function semester() {
		$this->view->staticTitle = array(_t('Semester'));
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
        $this->view->semesterList = $this->model->semesterList();
		$this->view->render('form/semester');
	}
	
	public function view_semester($id) {
		$this->view->staticTitle = array(_t('View Semester'));
		$this->view->sem = $this->model->semester($id);
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
		if(empty($this->view->sem)) {
			redirect( BASE_URL . 'error/invalid_record/' );
		}
		
		$this->view->render('form/view_semester');
	}
	
	public function runSemester() {
		$data = array();
		$data['acadYearCode'] = isPostSet('acadYearCode');
        $data['semCode'] = isPostSet('semCode');
        $data['semName'] = isPostSet('semName');
		$data['semStartDate'] = isPostSet('semStartDate');
		$data['semEndDate'] = isPostSet('semEndDate');
		$data['active'] = isPostSet('active');
		$this->model->runSemester($data);
	}
	
	public function runEditSemester() {
		$data = array();
		$data['acadYearCode'] = isPostSet('acadYearCode');
		$data['semCode'] = isPostSet('semCode');
        $data['semName'] = isPostSet('semName');
		$data['semStartDate'] = isPostSet('semStartDate');
		$data['semEndDate'] = isPostSet('semEndDate');
		$data['active'] = isPostSet('active');
		$data['semesterID'] = isPostSet('semesterID');
		$this->model->runEditSemester($data);
	}
	
	public function deleteSemester($id) {
		$this->model->deleteSemester($id);
	}
	/* Ends semester methods */
	
	/* Begins term methods */
	public function term() {
		$this->view->staticTitle = array(_t('Term'));
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
        $this->view->termList = $this->model->termList();
		$this->view->render('form/term');	
	}
	
	public function view_term($id) {
		$this->view->staticTitle = array(_t('View Term'));
		$this->view->term = $this->model->term($id);
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
		if(empty($this->view->term)) {
			redirect( BASE_URL . 'error/invalid_record/' );
		}
		
		$this->view->render('form/view_term');
	}
	
	public function runTerm() {
		$data = array();
		$data['semCode'] = isPostSet('semCode');
        $data['termCode'] = isPostSet('termCode');
        $data['termName'] = isPostSet('termName');
        $data['reportingTerm'] = isPostSet('reportingTerm');
        $data['termStartDate'] = isPostSet('termStartDate');
        $data['termEndDate'] = isPostSet('termEndDate');
        $data['dropAddEndDate'] = isPostSet('dropAddEndDate');
        $data['active'] = isPostSet('active');
		$this->model->runTerm($data);
	}
	
	public function runEditTerm() {
		$data = array();
		$data['semCode'] = isPostSet('semCode');
        $data['termCode'] = isPostSet('termCode');
		$data['termName'] = isPostSet('termName');
        $data['reportingTerm'] = isPostSet('reportingTerm');
		$data['termStartDate'] = isPostSet('termStartDate');
		$data['termEndDate'] = isPostSet('termEndDate');
        $data['dropAddEndDate'] = isPostSet('dropAddEndDate');
		$data['active'] = isPostSet('active');
		$data['termID'] = isPostSet('termID');
		$this->model->runEditTerm($data);
	}
	
	public function deleteTerm($id) {
		$this->model->deleteTerm($id);
	}
	/* Ends term methods */
	
	/* Begin academic year */
	public function acad_year() {
		$this->view->staticTitle = array(_t('Academic Year'));
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
        $this->view->acadYearList = $this->model->acadYearList();
		$this->view->render('form/acad_year');
	}
	
	public function view_acad_year($id) {
		$this->view->staticTitle = array(_t('View Academic Year'));
		$this->view->acadYear = $this->model->acadYear($id);
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
		if(empty($this->view->acadYear)) {
			redirect( BASE_URL . 'error/invalid_record/' );
		}
		
		$this->view->render('form/view_acad_year');
	}
	
	public function runAcadYear() {
		$data = array();
		$data['acadYearCode'] = isPostSet('acadYearCode');
        $data['acadYearDesc'] = isPostSet('acadYearDesc');
		$this->model->runAcadYear($data);
	}
	
	public function runEditAcadYear() {
		$data = array();
		$data['acadYearCode'] = isPostSet('acadYearCode');
        $data['acadYearDesc'] = isPostSet('acadYearDesc');
		$data['acadYearID'] = isPostSet('acadYearID');
		$this->model->runEditAcadYear($data);
	}
	
	public function deleteAcadYear($id) {
		$this->model->deleteAcadYear($id);
	}
	/* End academic year */
	
	/* Begin department */
	public function department() {
		$this->view->staticTitle = array(_t('Department'));
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
        $this->view->deptList = $this->model->deptList();
		$this->view->render('form/department');
	}
	
	public function view_department($id) {
		$this->view->staticTitle = array(_t('View Department'));
		$this->view->dept = $this->model->dept($id);
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
		if(empty($this->view->dept)) {
			redirect( BASE_URL . 'error/invalid_record/' );
		}
		
		$this->view->render('form/view_department');
	}
	
	public function runDept() {
		$data = array();
		$data['deptCode'] = isPostSet('deptCode');
        $data['deptTypeCode'] = isPostSet('deptTypeCode');
		$data['deptName'] = isPostSet('deptName');
		$data['deptDesc'] = isPostSet('deptDesc');
		$this->model->runDept($data);
	}
	
	public function runEditDept() {
		$data = array();
		$data['deptCode'] = isPostSet('deptCode');
        $data['deptTypeCode'] = isPostSet('deptTypeCode');
		$data['deptName'] = isPostSet('deptName');
		$data['deptDesc'] = isPostSet('deptDesc');
		$data['deptID'] = isPostSet('deptID');
		$this->model->runEditDept($data);
	}
	
	public function deleteDept($id) {
		$this->model->deleteDept($id);
	}
	/* End department */
	
	/* Begin student load rule */
	public function student_load_rule() {
		$this->view->staticTitle = array(_t('Student Load Rules'));
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
        $this->view->credLoadList = $this->model->credLoadList();
		$this->view->render('form/student_load_rule');
	}
	
	public function view_student_load_rule($id) {
		$this->view->staticTitle = array(_t('View Student Load Rule'));
		$this->view->sl = $this->model->sl($id);
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
		if(empty($this->view->sl)) {
			redirect( BASE_URL . 'error/invalid_record/' );
		}
		
		$this->view->render('form/view_student_load_rule');
	}
	
	public function runStuLoadRule() {
		$data = array();
		$data['status'] = isPostSet('status');
		$data['min_cred'] = isPostSet('min_cred');
		$data['max_cred'] = isPostSet('max_cred');
        $data['term'] = isPostSet('term');
        $data['acadLevelCode'] = isPostSet('acadLevelCode');
        $data['active'] = isPostSet('active');
		$this->model->runStuLoadRule($data);
	}
	
	public function runEditStuLoadRule() {
		$data = array();
		$data['status'] = isPostSet('status');
        $data['min_cred'] = isPostSet('min_cred');
        $data['max_cred'] = isPostSet('max_cred');
        $data['term'] = isPostSet('term');
        $data['acadLevelCode'] = isPostSet('acadLevelCode');
        $data['active'] = isPostSet('active');
        $data['slrID'] = isPostSet('slrID');
		$this->model->runEditStuLoadRule($data);
	}
	
	public function deleteStuLoadRule($id) {
		$this->model->deleteStuLoadRule($id);
	}
	/* End student load rule */
	
	/* Begin degrees */
	public function degree() {
		$this->view->staticTitle = array(_t('Degree'));
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
        $this->view->degreeList = $this->model->degreeList();
		$this->view->render('form/degree');
	}
	
	public function view_degree($id) {
		$this->view->staticTitle = array(_t('View Degree'));
		$this->view->degree = $this->model->degree($id);
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
		if(empty($this->view->degree)) {
			redirect( BASE_URL . 'error/invalid_record/' );
		}
		
		$this->view->render('form/view_degree');
	}
	
	public function runDegree() {
		$data = array();
		$data['degreeCode'] = isPostSet('degreeCode');
		$data['degreeName'] = isPostSet('degreeName');
		$this->model->runDegree($data);
	}
	
	public function runEditDegree() {
		$data = array();
		$data['degreeCode'] = isPostSet('degreeCode');
		$data['degreeName'] = isPostSet('degreeName');
		$data['degreeID'] = isPostSet('degreeID');
		$this->model->runEditDegree($data);
	}
	
	public function deleteDegree($id) {
		$this->model->deleteDegree($id);
	}
	/* End degrees */
	
	/* Begin majors */
	public function major() {
		$this->view->staticTitle = array(_t('Major'));
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
        $this->view->majorList = $this->model->majorList();
		$this->view->render('form/major');
	}
	
	public function view_major($id) {
		$this->view->staticTitle = array(_t('View Major'));
		$this->view->major = $this->model->major($id);
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
		if(empty($this->view->major)) {
			redirect( BASE_URL . 'error/invalid_record/' );
		}
		
		$this->view->render('form/view_major');
	}
	
	public function runMajor() {
		$data = array();
		$data['majorCode'] = isPostSet('majorCode');
		$data['majorName'] = isPostSet('majorName');
		$this->model->runMajor($data);
	}
	
	public function runEditMajor() {
		$data = array();
		$data['majorCode'] = isPostSet('majorCode');
		$data['majorName'] = isPostSet('majorName');
		$data['majorID'] = isPostSet('majorID');
		$this->model->runEditMajor($data);
	}
	
	public function deleteMajor($id) {
		$this->model->deleteMajor($id);
	}
	/* End majors */
	
	/* Begin minors */
	public function minor() {
		$this->view->staticTitle = array(_t('Minor'));
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
        $this->view->minorList = $this->model->minorList();
		$this->view->render('form/minor');
	}
	
	public function view_minor($id) {
		$this->view->staticTitle = array(_t('View Minor'));
		$this->view->minor = $this->model->minor($id);
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
		if(empty($this->view->minor)) {
			redirect( BASE_URL . 'error/invalid_record/' );
		}
		
		$this->view->render('form/view_minor');
	}
	
	public function runMinor() {
		$data = array();
		$data['minorCode'] = isPostSet('minorCode');
		$data['minorName'] = isPostSet('minorName');
		$this->model->runMinor($data);
	}
	
	public function runEditMinor() {
		$data = array();
		$data['minorCode'] = isPostSet('minorCode');
		$data['minorName'] = isPostSet('minorName');
		$data['minorID'] = isPostSet('minorID');
		$this->model->runEditMinor($data);
	}
	
	public function deleteMinor($id) {
		$this->model->deleteMinor($id);
	}
	/* End minors */
	
	/* Begin CCD */
    public function ccd() {
        $this->view->staticTitle = array(_t('CCD'));
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
        $this->view->ccdList = $this->model->ccdList();
        $this->view->render('form/ccd');
    }
    
    public function view_ccd($id) {
        $this->view->staticTitle = array(_t('View CCD'));
        $this->view->ccd = $this->model->ccd($id);
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
        if(empty($this->view->ccd)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('form/view_ccd');
    }
    
    public function runCCD() {
        $data = array();
        $data['ccdCode'] = isPostSet('ccdCode');
        $data['ccdName'] = isPostSet('ccdName');
        $data['addDate'] = isPostSet('addDate');
        $this->model->runCCD($data);
    }
    
    public function runEditCCD() {
        $data = array();
        $data['ccdCode'] = isPostSet('ccdCode');
        $data['ccdName'] = isPostSet('ccdName');
        $data['ccdID'] = isPostSet('ccdID');
        $this->model->runEditCCD($data);
    }
    
    public function deleteCCD($id) {
        $this->model->deleteCCD($id);
    }
    /* End CCD */
    
    /* Begin CIP */
    public function cip() {
        $this->view->staticTitle = array(_t('CIP'));
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
        $this->view->cipList = $this->model->cipList();
        $this->view->render('form/cip');
    }
    
    public function view_cip($id) {
        $this->view->staticTitle = array(_t('View CIP'));
        $this->view->cip = $this->model->cip($id);
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
        if(empty($this->view->cip)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('form/view_cip');
    }
    
    public function runCIP() {
        $data = array();
        $data['cipCode'] = isPostSet('cipCode');
        $data['cipName'] = isPostSet('cipName');
        $this->model->runCIP($data);
    }
    
    public function runEditCIP() {
        $data = array();
        $data['cipCode'] = isPostSet('cipCode');
        $data['cipName'] = isPostSet('cipName');
        $data['cipID'] = isPostSet('cipID');
        $this->model->runEditCIP($data);
    }
    
    public function deleteCIP($id) {
        $this->model->deleteCIP($id);
    }
    /* End CIP */
    
    /* Begin Location */
    public function location() {
        $this->view->staticTitle = array(_t('Location'));
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
        $this->view->locList = $this->model->locList();
        $this->view->render('form/location');
    }
    
    public function view_location($id) {
        $this->view->staticTitle = array(_t('View Location'));
        $this->view->location = $this->model->location($id);
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
        if(empty($this->view->location)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('form/view_location');
    }
    
    public function runLocation() {
        $data = array();
        $data['locationCode'] = isPostSet('locationCode');
        $data['locationName'] = isPostSet('locationName');
        $this->model->runLocation($data);
    }
    
    public function runEditLocation() {
        $data = array();
        $data['locationCode'] = isPostSet('locationCode');
        $data['locationName'] = isPostSet('locationName');
        $data['locationID'] = isPostSet('locationID');
        $this->model->runEditLocation($data);
    }
    
    public function deleteLocation($id) {
        $this->model->deleteLocation($id);
    }
    /* End Location */
    
    /* Begin Building */
    public function building() {
        $this->view->staticTitle = array(_t('Building'));
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
        $this->view->buildList = $this->model->buildList();
        $this->view->render('form/building');
    }
    
    public function view_building($id) {
        $this->view->staticTitle = array(_t('View Building'));
        $this->view->build = $this->model->build($id);
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
        if(empty($this->view->build)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('form/view_building');
    }
    
    public function runBuilding() {
        $data = array();
        $data['buildingCode'] = isPostSet('buildingCode');
        $data['buildingName'] = isPostSet('buildingName');
		$data['locationCode'] = isPostSet('locationCode');
        $this->model->runBuilding($data);
    }
    
    public function runEditBuilding() {
        $data = array();
        $data['buildingCode'] = isPostSet('buildingCode');
        $data['buildingName'] = isPostSet('buildingName');
		$data['locationCode'] = isPostSet('locationCode');
        $data['buildingID'] = isPostSet('buildingID');
        $this->model->runEditBuilding($data);
    }
    
    public function deleteBuilding($id) {
        $this->model->deleteBuilding($id);
    }
    /* End Building */
    
    /* Begin Room */
    public function room() {
        $this->view->staticTitle = array(_t('Add Room'));
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
        $this->view->roomList = $this->model->roomList();
        $this->view->render('form/room');
    }
    
    public function view_room($id) {
        $this->view->staticTitle = array(_t('View Room'));
        $this->view->room = $this->model->room($id);
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
        if(empty($this->view->room)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('form/view_room');
    }
    
    public function runRoom() {
        $data = array();
        $data['roomCode'] = isPostSet('roomCode');
        $data['buildingCode'] = isPostSet('buildingCode');
        $data['roomNumber'] = isPostSet('roomNumber');
        $data['roomCap'] = isPostSet('roomCap');
        $this->model->runRoom($data);
    }
    
    public function runEditRoom() {
        $data = array();
        $data['roomCode'] = isPostSet('roomCode');
        $data['buildingCode'] = isPostSet('buildingCode');
        $data['roomNumber'] = isPostSet('roomNumber');
        $data['roomCap'] = isPostSet('roomCap');
        $data['roomID'] = isPostSet('roomID');
        $this->model->runEditRoom($data);
    }
    
    public function deleteRoom($id) {
        $this->model->deleteRoom($id);
    }
    /* End Room */
    
    /* Begin Specialization */
    public function specialization() {
        $this->view->staticTitle = array(_t('Add Specialization'));
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
        $this->view->specList = $this->model->specList();
        $this->view->render('form/specialization');
    }
    
    public function view_specialization($id) {
        $this->view->staticTitle = array(_t('View Specialization'));
        $this->view->specialization = $this->model->specialization($id);
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
        if(empty($this->view->specialization)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('form/view_specialization');
    }
    
    public function runSpec() {
        $data = array();
        $data['specCode'] = isPostSet('specCode');
        $data['specName'] = isPostSet('specName');
        $this->model->runSpec($data);
    }
    
    public function runEditSpec() {
        $data = array();
        $data['specCode'] = isPostSet('specCode');
        $data['specName'] = isPostSet('specName');
        $data['specID'] = isPostSet('specID');
        $this->model->runEditSpec($data);
    }
    
    public function deleteSpec($id) {
        $this->model->deleteSpec($id);
    }
    /* End Specialization */
    
    /* Begin Class Year */
    public function class_year() {
        $this->view->staticTitle = array(_t('Class Year'));
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
        $this->view->yearList = $this->model->yearList();
        $this->view->render('form/class_year');
    }
    
    public function view_class_year($id) {
        $this->view->staticTitle = array(_t('View Class Year'));
        $this->view->year = $this->model->year($id);
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
        if(empty($this->view->year)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('form/view_class_year');
    }
    
    public function runClassYear() {
        $data = array();
        $data['acadLevelCode'] = isPostSet('acadLevelCode');
        $data['classYear'] = isPostSet('classYear');
        $data['minCredits'] = isPostSet('minCredits');
        $data['maxCredits'] = isPostSet('maxCredits');
        $this->model->runClassYear($data);
    }
    
    public function runEditClassYear() {
        $data = array();
        $data['acadLevelCode'] = isPostSet('acadLevelCode');
        $data['classYear'] = isPostSet('classYear');
        $data['minCredits'] = isPostSet('minCredits');
        $data['maxCredits'] = isPostSet('maxCredits');
        $data['yearID'] = isPostSet('yearID');
        $this->model->runEditClassYear($data);
    }
    
    public function deleteClassYear($id) {
        $this->model->deleteClassYear($id);
    }
    /* End Class Year */
    
    /* Begin Subject */
    public function subject() {
        $this->view->staticTitle = array(_t('Subject'));
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
        $this->view->subjList = $this->model->subjList();
        $this->view->render('form/subject');
    }
    
    public function view_subject($id) {
        $this->view->staticTitle = array(_t('View Subject'));
        $this->view->subj = $this->model->subj($id);
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
        if(empty($this->view->subj)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('form/view_subject');
    }
    
    public function runSubj() {
        $data = array();
        $data['subjectCode'] = isPostSet('subjectCode');
        $data['subjectName'] = isPostSet('subjectName');
        $this->model->runSubj($data);
    }
    
    public function runEditSubj() {
        $data = array();
        $data['subjectCode'] = isPostSet('subjectCode');
        $data['subjectName'] = isPostSet('subjectName');
        $data['subjectID'] = isPostSet('subjectID');
        $this->model->runEditSubj($data);
    }
    
    public function deleteSubj($id) {
        $this->model->deleteSubj($id);
    }
    /* End Subject */
    
    /* Begin Subject */
    public function school() {
        $this->view->staticTitle = array(_t('School'));
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
        $this->view->schoolList = $this->model->schoolList();
        $this->view->render('form/school');
    }
    
    public function view_school($id) {
        $this->view->staticTitle = array(_t('View School'));
        $this->view->school = $this->model->school($id);
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
        if(empty($this->view->school)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('form/view_school');
    }
    
    public function runSchool() {
        $data = array();
        $data['ficeCode'] = isPostSet('ficeCode');
        $data['schoolCode'] = isPostSet('schoolCode');
        $data['schoolName'] = isPostSet('schoolName');
        $data['buildingCode'] = isPostSet('buildingCode');
        $this->model->runSchool($data);
    }
    
    public function runEditSchool() {
        $data = array();
        $data['ficeCode'] = isPostSet('ficeCode');
        $data['schoolCode'] = isPostSet('schoolCode');
        $data['schoolName'] = isPostSet('schoolName');
        $data['schoolID'] = isPostSet('schoolID');
        $data['buildingCode'] = isPostSet('buildingCode');
        $this->model->runEditSchool($data);
    }
    
    public function deleteSchool($id) {
        $this->model->deleteSchool($id);
    }
    /* End Subject */
    
    /* Begin Institution */
    public function institution() {
        $this->view->staticTitle = array(_t('Institution'));
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
        $this->view->instList = $this->model->instList();
        $this->view->render('form/institution');
    }
    
    public function view_institution($id) {
        $this->view->staticTitle = array(_t('View Institution'));
        $this->view->inst = $this->model->inst($id);
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
        if(empty($this->view->inst)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('form/view_institution');
    }
    
    public function runInst() {
        $data = array();
        $data['ficeCode'] = isPostSet('ficeCode');
        $data['instName'] = isPostSet('instName');
        $data['city'] = isPostSet('city');
        $data['state'] = isPostSet('state');
        $this->model->runInst($data);
    }
    
    public function runEditInst() {
        $data = array();
        $data['ficeCode'] = isPostSet('ficeCode');
        $data['instName'] = isPostSet('instName');
        $data['city'] = isPostSet('city');
        $data['state'] = isPostSet('state');
        $data['institutionID'] = isPostSet('institutionID');
        $this->model->runEditInst($data);
    }
    
    public function deleteInst($id) {
        $this->model->deleteInst($id);
    }
    /* End Institution */
    
    /* Begin Grade Scale */
    public function grade_scale() {
        $this->view->staticTitle = array(_t('Grade Scale'));
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
        $this->view->gradeScale = $this->model->gradeScale();
        $this->view->render('form/grade_scale');
    }
    
    public function view_grade_scale($id) {
        $this->view->staticTitle = array(_t('View Grade'));
        $this->view->scale = $this->model->scale($id);
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
        if(empty($this->view->scale)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('form/view_grade_scale');
    }
    
    public function runGradeScale() {
        $data = array();
        $data['grade'] = isPostSet('grade');
        $data['percent'] = isPostSet('percent');
        $data['points'] = isPostSet('points');
        $data['status'] = isPostSet('status');
		$data['description'] = isPostSet('description');
		$data['update'] = isPostSet('update');
		$data['ID'] = isPostSet('ID');
        $this->model->runGradeScale($data);
    }
    
    public function deleteGradeScale($id) {
        $this->model->deleteGradeScale($id);
    }
    /* End Grade Scale */
    
    /* Begin Restriction Code */
    public function rstr_code() {
        $this->view->staticTitle = array(_t('Restriction Codes'));
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
        $this->view->rstrCodeList = $this->model->rstrCodeList();
        $this->view->render('form/rstr_code');
    }
    
    public function view_rstr_code($id) {
        $this->view->staticTitle = array(_t('View Restriction Code'));
        $this->view->rstr = $this->model->rstr($id);
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
        if(empty($this->view->rstr)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('form/view_rstr_code');
    }
    
    public function runRSTRCode() {
        $data = array();
        $data['rstrCode'] = isPostSet('rstrCode');
        $data['description'] = isPostSet('description');
        $data['deptCode'] = isPostSet('deptCode');
        $data['update'] = isPostSet('update');
        $data['rstrCodeID'] = isPostSet('rstrCodeID');
        $this->model->runRSTRCode($data);
    }
    /* End Restriction Code */
	
}