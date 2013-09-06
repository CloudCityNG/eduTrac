<?php namespace tinyPHP\Classes\Controllers;
/**
 *
 * Form Controller
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

class Form extends \tinyPHP\Classes\Core\Controller {
	
    private $_auth;
    
	public function __construct() {
		parent::__construct();
        $this->_auth = new \tinyPHP\Classes\Libraries\Cookies();
        if(!hasPermission('access_forms')) { redirect( BASE_URL . 'dashboard/' ); }
	}
	
	public function index() {
		redirect( BASE_URL . 'dashboard/' );
	}
	
	/* Begins semester methods */
	public function semester() {
		$this->view->staticTitle = array('Semester');
        $this->view->css = array( 
                                'theme/scripts/plugins/forms/select2/select2.css',
                                'theme/scripts/plugins/forms/multiselect/css/multi-select.css',
                                'theme/scripts/plugins/tables/DataTables/media/css/DT_bootstrap.css',
                                'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/css/TableTools.css',
                                'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/css/ColVis.css'
                                );
		$this->view->js = array( 
								'theme/scripts/plugins/tables/DataTables/media/js/jquery.dataTables.min.js',
                                'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/js/TableTools.min.js',
                                'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/js/ColVis.min.js',
                                'theme/scripts/plugins/tables/DataTables/media/js/DT_bootstrap.js',
                                'theme/scripts/demo/tables.js',
								'theme/scripts/plugins/forms/select2/select2.js',
								'theme/scripts/plugins/forms/multiselect/js/jquery.multi-select.js',
								'theme/scripts/plugins/forms/jquery-inputmask/dist/jquery.inputmask.bundle.min.js',
								'theme/scripts/demo/form_elements.js'
								);
        $this->view->semesterList = $this->model->semesterList();
		$this->view->render('form/semester');
	}
	
	public function view_semester($id) {
		$this->view->staticTitle = array('View Semester');
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
		$this->view->sem = $this->model->semester($id);
		
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
		$this->view->staticTitle = array('Term');
        $this->view->css = array( 
                                'theme/scripts/plugins/forms/select2/select2.css',
                                'theme/scripts/plugins/forms/multiselect/css/multi-select.css',
                                'theme/scripts/plugins/tables/DataTables/media/css/DT_bootstrap.css',
                                'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/css/TableTools.css',
                                'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/css/ColVis.css'
                                );
        $this->view->js = array( 
                                'theme/scripts/plugins/tables/DataTables/media/js/jquery.dataTables.min.js',
                                'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/js/TableTools.min.js',
                                'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/js/ColVis.min.js',
                                'theme/scripts/plugins/tables/DataTables/media/js/DT_bootstrap.js',
                                'theme/scripts/demo/tables.js',
                                'theme/scripts/plugins/forms/select2/select2.js',
                                'theme/scripts/plugins/forms/multiselect/js/jquery.multi-select.js',
                                'theme/scripts/plugins/forms/jquery-inputmask/dist/jquery.inputmask.bundle.min.js',
                                'theme/scripts/demo/form_elements.js'
                                );
        $this->view->termList = $this->model->termList();
		$this->view->render('form/term');	
	}
	
	public function view_term($id) {
		$this->view->staticTitle = array('View Term');
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
		$this->view->term = $this->model->term($id);
		
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
		$this->view->staticTitle = array('Academic Year');
		$this->view->css = array( 
                                'theme/scripts/plugins/forms/select2/select2.css',
                                'theme/scripts/plugins/forms/multiselect/css/multi-select.css',
                                'theme/scripts/plugins/tables/DataTables/media/css/DT_bootstrap.css',
                                'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/css/TableTools.css',
                                'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/css/ColVis.css'
                                );
        $this->view->js = array( 
                                'theme/scripts/plugins/tables/DataTables/media/js/jquery.dataTables.min.js',
                                'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/js/TableTools.min.js',
                                'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/js/ColVis.min.js',
                                'theme/scripts/plugins/tables/DataTables/media/js/DT_bootstrap.js',
                                'theme/scripts/demo/tables.js',
                                'theme/scripts/plugins/forms/select2/select2.js',
                                'theme/scripts/plugins/forms/multiselect/js/jquery.multi-select.js',
                                'theme/scripts/plugins/forms/jquery-inputmask/dist/jquery.inputmask.bundle.min.js',
                                'theme/scripts/demo/form_elements.js'
                                );
        $this->view->acadYearList = $this->model->acadYearList();
		$this->view->render('form/acad_year');
	}
	
	public function view_acad_year($id) {
		$this->view->staticTitle = array('View Academic Year');
		$this->view->js = array( 
								'theme/scripts/plugins/forms/select2/select2.js',
								'theme/scripts/plugins/forms/multiselect/js/jquery.multi-select.js',
								'theme/scripts/plugins/forms/jquery-inputmask/dist/jquery.inputmask.bundle.min.js',
								'theme/scripts/demo/form_elements.js'
								);
		$this->view->acadYear = $this->model->acadYear($id);
		
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
		$this->view->staticTitle = array('Department');
        $this->view->css = array( 
                                'theme/scripts/plugins/forms/select2/select2.css',
                                'theme/scripts/plugins/forms/multiselect/css/multi-select.css',
                                'theme/scripts/plugins/tables/DataTables/media/css/DT_bootstrap.css',
                                'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/css/TableTools.css',
                                'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/css/ColVis.css'
                                );
        $this->view->js = array( 
                                'theme/scripts/plugins/tables/DataTables/media/js/jquery.dataTables.min.js',
                                'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/js/TableTools.min.js',
                                'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/js/ColVis.min.js',
                                'theme/scripts/plugins/tables/DataTables/media/js/DT_bootstrap.js',
                                'theme/scripts/demo/tables.js',
                                'theme/scripts/plugins/forms/select2/select2.js',
                                'theme/scripts/plugins/forms/multiselect/js/jquery.multi-select.js',
                                'theme/scripts/plugins/forms/jquery-inputmask/dist/jquery.inputmask.bundle.min.js',
                                'theme/scripts/demo/form_elements.js'
                                );
        $this->view->deptList = $this->model->deptList();
		$this->view->render('form/department');
	}
	
	public function view_department($id) {
		$this->view->staticTitle = array('View Department');
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
		$this->view->dept = $this->model->dept($id);
		
		if(empty($this->view->dept)) {
			redirect( BASE_URL . 'error/invalid_record/' );
		}
		
		$this->view->render('form/view_department');
	}
	
	public function runDept() {
		$data = array();
		$data['deptCode'] = isPostSet('deptCode');
        $data['deptType'] = isPostSet('deptType');
		$data['deptName'] = isPostSet('deptName');
		$data['deptDesc'] = isPostSet('deptDesc');
		$this->model->runDept($data);
	}
	
	public function runEditDept() {
		$data = array();
		$data['deptCode'] = isPostSet('deptCode');
        $data['deptType'] = isPostSet('deptType');
		$data['deptName'] = isPostSet('deptName');
		$data['deptDesc'] = isPostSet('deptDesc');
		$data['deptID'] = isPostSet('deptID');
		$this->model->runEditDept($data);
	}
	
	public function deleteDept($id) {
		$this->model->deleteDept($id);
	}
	/* End department */
	
	/* Begin credit Load */
	public function credit_load() {
		$this->view->staticTitle = array('Credit Load');
		$this->view->css = array( 
                                'theme/scripts/plugins/forms/select2/select2.css',
                                'theme/scripts/plugins/forms/multiselect/css/multi-select.css',
                                'theme/scripts/plugins/tables/DataTables/media/css/DT_bootstrap.css',
                                'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/css/TableTools.css',
                                'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/css/ColVis.css'
                                );
        $this->view->js = array( 
                                'theme/scripts/plugins/tables/DataTables/media/js/jquery.dataTables.min.js',
                                'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/js/TableTools.min.js',
                                'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/js/ColVis.min.js',
                                'theme/scripts/plugins/tables/DataTables/media/js/DT_bootstrap.js',
                                'theme/scripts/demo/tables.js',
                                'theme/scripts/plugins/forms/select2/select2.js',
                                'theme/scripts/plugins/forms/multiselect/js/jquery.multi-select.js',
                                'theme/scripts/plugins/forms/jquery-inputmask/dist/jquery.inputmask.bundle.min.js',
                                'theme/scripts/demo/form_elements.js'
                                );
        $this->view->credLoadList = $this->model->credLoadList();
		$this->view->render('form/credit_load');
	}
	
	public function view_credit_load($id) {
		$this->view->staticTitle = array('View Credit Load');
		$this->view->js = array( 
								'theme/scripts/plugins/forms/select2/select2.js',
								'theme/scripts/plugins/forms/multiselect/js/jquery.multi-select.js',
								'theme/scripts/plugins/forms/jquery-inputmask/dist/jquery.inputmask.bundle.min.js',
								'theme/scripts/demo/form_elements.js'
								);
		$this->view->cl = $this->model->cl($id);
		
		if(empty($this->view->cl)) {
			redirect( BASE_URL . 'error/invalid_record/' );
		}
		
		$this->view->render('form/view_credit_load');
	}
	
	public function runCredLoad() {
		$data = array();
		$data['credLoadCode'] = isPostSet('credLoadCode');
		$data['credLoadName'] = isPostSet('credLoadName');
		$data['credLoadCreds'] = isPostSet('credLoadCreds');
		$this->model->runCredLoad($data);
	}
	
	public function runEditCredLoad() {
		$data = array();
		$data['credLoadCode'] = isPostSet('credLoadCode');
		$data['credLoadName'] = isPostSet('credLoadName');
		$data['credLoadCreds'] = isPostSet('credLoadCreds');
		$data['credLoadID'] = isPostSet('credLoadID');
		$this->model->runEditCredLoad($data);
	}
	
	public function deleteCredLoad($id) {
		$this->model->deleteCredLoad($id);
	}
	/* End credit load */
	
	/* Begin degrees */
	public function degree() {
		$this->view->staticTitle = array('Degree');
		$this->view->css = array( 
                                'theme/scripts/plugins/forms/select2/select2.css',
                                'theme/scripts/plugins/forms/multiselect/css/multi-select.css',
                                'theme/scripts/plugins/tables/DataTables/media/css/DT_bootstrap.css',
                                'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/css/TableTools.css',
                                'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/css/ColVis.css'
                                );
        $this->view->js = array( 
                                'theme/scripts/plugins/tables/DataTables/media/js/jquery.dataTables.min.js',
                                'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/js/TableTools.min.js',
                                'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/js/ColVis.min.js',
                                'theme/scripts/plugins/tables/DataTables/media/js/DT_bootstrap.js',
                                'theme/scripts/demo/tables.js',
                                'theme/scripts/plugins/forms/select2/select2.js',
                                'theme/scripts/plugins/forms/multiselect/js/jquery.multi-select.js',
                                'theme/scripts/plugins/forms/jquery-inputmask/dist/jquery.inputmask.bundle.min.js',
                                'theme/scripts/demo/form_elements.js'
                                );
        $this->view->degreeList = $this->model->degreeList();
		$this->view->render('form/degree');
	}
	
	public function view_degree($id) {
		$this->view->staticTitle = array('View Degree');
		$this->view->js = array( 
								'theme/scripts/plugins/forms/select2/select2.js',
								'theme/scripts/plugins/forms/multiselect/js/jquery.multi-select.js',
								'theme/scripts/plugins/forms/jquery-inputmask/dist/jquery.inputmask.bundle.min.js',
								'theme/scripts/demo/form_elements.js'
								);
		$this->view->degree = $this->model->degree($id);
		
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
		$this->view->staticTitle = array('Major');
		$this->view->css = array( 
                                'theme/scripts/plugins/forms/select2/select2.css',
                                'theme/scripts/plugins/forms/multiselect/css/multi-select.css',
                                'theme/scripts/plugins/tables/DataTables/media/css/DT_bootstrap.css',
                                'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/css/TableTools.css',
                                'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/css/ColVis.css'
                                );
        $this->view->js = array( 
                                'theme/scripts/plugins/tables/DataTables/media/js/jquery.dataTables.min.js',
                                'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/js/TableTools.min.js',
                                'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/js/ColVis.min.js',
                                'theme/scripts/plugins/tables/DataTables/media/js/DT_bootstrap.js',
                                'theme/scripts/demo/tables.js',
                                'theme/scripts/plugins/forms/select2/select2.js',
                                'theme/scripts/plugins/forms/multiselect/js/jquery.multi-select.js',
                                'theme/scripts/plugins/forms/jquery-inputmask/dist/jquery.inputmask.bundle.min.js',
                                'theme/scripts/demo/form_elements.js'
                                );
        $this->view->majorList = $this->model->majorList();
		$this->view->render('form/major');
	}
	
	public function view_major($id) {
		$this->view->staticTitle = array('View Major');
		$this->view->js = array( 
								'theme/scripts/plugins/forms/select2/select2.js',
								'theme/scripts/plugins/forms/multiselect/js/jquery.multi-select.js',
								'theme/scripts/plugins/forms/jquery-inputmask/dist/jquery.inputmask.bundle.min.js',
								'theme/scripts/demo/form_elements.js'
								);
		$this->view->major = $this->model->major($id);
		
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
		$this->view->staticTitle = array('Minor');
		$this->view->css = array( 
                                'theme/scripts/plugins/forms/select2/select2.css',
                                'theme/scripts/plugins/forms/multiselect/css/multi-select.css',
                                'theme/scripts/plugins/tables/DataTables/media/css/DT_bootstrap.css',
                                'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/css/TableTools.css',
                                'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/css/ColVis.css'
                                );
        $this->view->js = array( 
                                'theme/scripts/plugins/tables/DataTables/media/js/jquery.dataTables.min.js',
                                'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/js/TableTools.min.js',
                                'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/js/ColVis.min.js',
                                'theme/scripts/plugins/tables/DataTables/media/js/DT_bootstrap.js',
                                'theme/scripts/demo/tables.js',
                                'theme/scripts/plugins/forms/select2/select2.js',
                                'theme/scripts/plugins/forms/multiselect/js/jquery.multi-select.js',
                                'theme/scripts/plugins/forms/jquery-inputmask/dist/jquery.inputmask.bundle.min.js',
                                'theme/scripts/demo/form_elements.js'
                                );
        $this->view->minorList = $this->model->minorList();
		$this->view->render('form/minor');
	}
	
	public function view_minor($id) {
		$this->view->staticTitle = array('View Minor');
		$this->view->js = array( 
								'theme/scripts/plugins/forms/select2/select2.js',
								'theme/scripts/plugins/forms/multiselect/js/jquery.multi-select.js',
								'theme/scripts/plugins/forms/jquery-inputmask/dist/jquery.inputmask.bundle.min.js',
								'theme/scripts/demo/form_elements.js'
								);
		$this->view->minor = $this->model->minor($id);
		
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
        $this->view->staticTitle = array('CCD');
        $this->view->css = array( 
                                'theme/scripts/plugins/forms/select2/select2.css',
                                'theme/scripts/plugins/forms/multiselect/css/multi-select.css',
                                'theme/scripts/plugins/tables/DataTables/media/css/DT_bootstrap.css',
                                'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/css/TableTools.css',
                                'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/css/ColVis.css'
                                );
        $this->view->js = array( 
                                'theme/scripts/plugins/tables/DataTables/media/js/jquery.dataTables.min.js',
                                'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/js/TableTools.min.js',
                                'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/js/ColVis.min.js',
                                'theme/scripts/plugins/tables/DataTables/media/js/DT_bootstrap.js',
                                'theme/scripts/demo/tables.js',
                                'theme/scripts/plugins/forms/select2/select2.js',
                                'theme/scripts/plugins/forms/multiselect/js/jquery.multi-select.js',
                                'theme/scripts/plugins/forms/jquery-inputmask/dist/jquery.inputmask.bundle.min.js',
                                'theme/scripts/demo/form_elements.js'
                                );
        $this->view->ccdList = $this->model->ccdList();
        $this->view->render('form/ccd');
    }
    
    public function view_ccd($id) {
        $this->view->staticTitle = array('View CCD');
        $this->view->js = array( 
                                'theme/scripts/plugins/forms/select2/select2.js',
                                'theme/scripts/plugins/forms/multiselect/js/jquery.multi-select.js',
                                'theme/scripts/plugins/forms/jquery-inputmask/dist/jquery.inputmask.bundle.min.js',
                                'theme/scripts/demo/form_elements.js'
                                );
        $this->view->ccd = $this->model->ccd($id);
        
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
        $this->view->staticTitle = array('CIP');
        $this->view->css = array( 
                                'theme/scripts/plugins/forms/select2/select2.css',
                                'theme/scripts/plugins/forms/multiselect/css/multi-select.css',
                                'theme/scripts/plugins/tables/DataTables/media/css/DT_bootstrap.css',
                                'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/css/TableTools.css',
                                'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/css/ColVis.css'
                                );
        $this->view->js = array( 
                                'theme/scripts/plugins/tables/DataTables/media/js/jquery.dataTables.min.js',
                                'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/js/TableTools.min.js',
                                'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/js/ColVis.min.js',
                                'theme/scripts/plugins/tables/DataTables/media/js/DT_bootstrap.js',
                                'theme/scripts/demo/tables.js',
                                'theme/scripts/plugins/forms/select2/select2.js',
                                'theme/scripts/plugins/forms/multiselect/js/jquery.multi-select.js',
                                'theme/scripts/plugins/forms/jquery-inputmask/dist/jquery.inputmask.bundle.min.js',
                                'theme/scripts/demo/form_elements.js'
                                );
        $this->view->cipList = $this->model->cipList();
        $this->view->render('form/cip');
    }
    
    public function view_cip($id) {
        $this->view->staticTitle = array('View CIP');
        $this->view->js = array( 
                                'theme/scripts/plugins/forms/select2/select2.js',
                                'theme/scripts/plugins/forms/multiselect/js/jquery.multi-select.js',
                                'theme/scripts/plugins/forms/jquery-inputmask/dist/jquery.inputmask.bundle.min.js',
                                'theme/scripts/demo/form_elements.js'
                                );
        $this->view->cip = $this->model->cip($id);
        
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
        $this->view->staticTitle = array('Location');
        $this->view->css = array( 
                                'theme/scripts/plugins/forms/select2/select2.css',
                                'theme/scripts/plugins/forms/multiselect/css/multi-select.css',
                                'theme/scripts/plugins/tables/DataTables/media/css/DT_bootstrap.css',
                                'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/css/TableTools.css',
                                'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/css/ColVis.css'
                                );
        $this->view->js = array( 
                                'theme/scripts/plugins/tables/DataTables/media/js/jquery.dataTables.min.js',
                                'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/js/TableTools.min.js',
                                'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/js/ColVis.min.js',
                                'theme/scripts/plugins/tables/DataTables/media/js/DT_bootstrap.js',
                                'theme/scripts/demo/tables.js',
                                'theme/scripts/plugins/forms/select2/select2.js',
                                'theme/scripts/plugins/forms/multiselect/js/jquery.multi-select.js',
                                'theme/scripts/plugins/forms/jquery-inputmask/dist/jquery.inputmask.bundle.min.js',
                                'theme/scripts/demo/form_elements.js'
                                );
        $this->view->locList = $this->model->locList();
        $this->view->render('form/location');
    }
    
    public function view_location($id) {
        $this->view->staticTitle = array('View Location');
        $this->view->js = array( 
                                'theme/scripts/plugins/forms/select2/select2.js',
                                'theme/scripts/plugins/forms/multiselect/js/jquery.multi-select.js',
                                'theme/scripts/plugins/forms/jquery-inputmask/dist/jquery.inputmask.bundle.min.js',
                                'theme/scripts/demo/form_elements.js'
                                );
        $this->view->location = $this->model->location($id);
        
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
        $this->view->staticTitle = array('Building');
        $this->view->css = array( 
                                'theme/scripts/plugins/forms/select2/select2.css',
                                'theme/scripts/plugins/forms/multiselect/css/multi-select.css',
                                'theme/scripts/plugins/tables/DataTables/media/css/DT_bootstrap.css',
                                'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/css/TableTools.css',
                                'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/css/ColVis.css'
                                );
        $this->view->js = array( 
                                'theme/scripts/plugins/tables/DataTables/media/js/jquery.dataTables.min.js',
                                'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/js/TableTools.min.js',
                                'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/js/ColVis.min.js',
                                'theme/scripts/plugins/tables/DataTables/media/js/DT_bootstrap.js',
                                'theme/scripts/demo/tables.js',
                                'theme/scripts/plugins/forms/select2/select2.js',
                                'theme/scripts/plugins/forms/multiselect/js/jquery.multi-select.js',
                                'theme/scripts/plugins/forms/jquery-inputmask/dist/jquery.inputmask.bundle.min.js',
                                'theme/scripts/demo/form_elements.js'
                                );
        $this->view->buildList = $this->model->buildList();
        $this->view->render('form/building');
    }
    
    public function view_building($id) {
        $this->view->staticTitle = array('View Building');
        $this->view->js = array( 
                                'theme/scripts/plugins/forms/select2/select2.js',
                                'theme/scripts/plugins/forms/multiselect/js/jquery.multi-select.js',
                                'theme/scripts/plugins/forms/jquery-inputmask/dist/jquery.inputmask.bundle.min.js',
                                'theme/scripts/demo/form_elements.js'
                                );
        $this->view->build = $this->model->build($id);
        
        if(empty($this->view->build)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('form/view_building');
    }
    
    public function runBuilding() {
        $data = array();
        $data['buildingCode'] = isPostSet('buildingCode');
        $data['buildingName'] = isPostSet('buildingName');
        $this->model->runBuilding($data);
    }
    
    public function runEditBuilding() {
        $data = array();
        $data['buildingCode'] = isPostSet('buildingCode');
        $data['buildingName'] = isPostSet('buildingName');
        $data['buildingID'] = isPostSet('buildingID');
        $this->model->runEditBuilding($data);
    }
    
    public function deleteBuilding($id) {
        $this->model->deleteBuilding($id);
    }
    /* End Building */
    
    /* Begin Room */
    public function room() {
        $this->view->staticTitle = array('Add Room');
        $this->view->css = array( 
                                'theme/scripts/plugins/forms/select2/select2.css',
                                'theme/scripts/plugins/forms/multiselect/css/multi-select.css',
                                'theme/scripts/plugins/tables/DataTables/media/css/DT_bootstrap.css',
                                'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/css/TableTools.css',
                                'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/css/ColVis.css'
                                );
        $this->view->js = array( 
                                'theme/scripts/plugins/tables/DataTables/media/js/jquery.dataTables.min.js',
                                'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/js/TableTools.min.js',
                                'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/js/ColVis.min.js',
                                'theme/scripts/plugins/tables/DataTables/media/js/DT_bootstrap.js',
                                'theme/scripts/demo/tables.js',
                                'theme/scripts/plugins/forms/select2/select2.js',
                                'theme/scripts/plugins/forms/multiselect/js/jquery.multi-select.js',
                                'theme/scripts/plugins/forms/jquery-inputmask/dist/jquery.inputmask.bundle.min.js',
                                'theme/scripts/demo/form_elements.js'
                                );
        $this->view->roomList = $this->model->roomList();
        $this->view->render('form/room');
    }
    
    public function view_room($id) {
        $this->view->staticTitle = array('View Room');
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
        $this->view->room = $this->model->room($id);
        
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
        $this->view->staticTitle = array('Add Specialization');
        $this->view->css = array( 
                                'theme/scripts/plugins/forms/select2/select2.css',
                                'theme/scripts/plugins/forms/multiselect/css/multi-select.css',
                                'theme/scripts/plugins/tables/DataTables/media/css/DT_bootstrap.css',
                                'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/css/TableTools.css',
                                'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/css/ColVis.css'
                                );
        $this->view->js = array( 
                                'theme/scripts/plugins/tables/DataTables/media/js/jquery.dataTables.min.js',
                                'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/js/TableTools.min.js',
                                'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/js/ColVis.min.js',
                                'theme/scripts/plugins/tables/DataTables/media/js/DT_bootstrap.js',
                                'theme/scripts/demo/tables.js',
                                'theme/scripts/plugins/forms/select2/select2.js',
                                'theme/scripts/plugins/forms/multiselect/js/jquery.multi-select.js',
                                'theme/scripts/plugins/forms/jquery-inputmask/dist/jquery.inputmask.bundle.min.js',
                                'theme/scripts/demo/form_elements.js'
                                );
        $this->view->specList = $this->model->specList();
        $this->view->render('form/specialization');
    }
    
    public function view_specialization($id) {
        $this->view->staticTitle = array('View Specialization');
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
        $this->view->specialization = $this->model->specialization($id);
        
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
        $this->view->staticTitle = array('Class Year');
        $this->view->css = array( 
                                'theme/scripts/plugins/forms/select2/select2.css',
                                'theme/scripts/plugins/forms/multiselect/css/multi-select.css',
                                'theme/scripts/plugins/tables/DataTables/media/css/DT_bootstrap.css',
                                'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/css/TableTools.css',
                                'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/css/ColVis.css'
                                );
        $this->view->js = array( 
                                'theme/scripts/plugins/tables/DataTables/media/js/jquery.dataTables.min.js',
                                'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/js/TableTools.min.js',
                                'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/js/ColVis.min.js',
                                'theme/scripts/plugins/tables/DataTables/media/js/DT_bootstrap.js',
                                'theme/scripts/demo/tables.js',
                                'theme/scripts/plugins/forms/select2/select2.js',
                                'theme/scripts/plugins/forms/multiselect/js/jquery.multi-select.js',
                                'theme/scripts/plugins/forms/jquery-inputmask/dist/jquery.inputmask.bundle.min.js',
                                'theme/scripts/demo/form_elements.js'
                                );
        $this->view->yearList = $this->model->yearList();
        $this->view->render('form/class_year');
    }
    
    public function view_class_year($id) {
        $this->view->staticTitle = array('View Class Year');
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
        $this->view->year = $this->model->year($id);
        
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
        $this->view->staticTitle = array('Subject');
        $this->view->css = array( 
                                'theme/scripts/plugins/forms/select2/select2.css',
                                'theme/scripts/plugins/forms/multiselect/css/multi-select.css',
                                'theme/scripts/plugins/tables/DataTables/media/css/DT_bootstrap.css',
                                'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/css/TableTools.css',
                                'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/css/ColVis.css'
                                );
        $this->view->js = array( 
                                'theme/scripts/plugins/tables/DataTables/media/js/jquery.dataTables.min.js',
                                'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/js/TableTools.min.js',
                                'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/js/ColVis.min.js',
                                'theme/scripts/plugins/tables/DataTables/media/js/DT_bootstrap.js',
                                'theme/scripts/demo/tables.js',
                                'theme/scripts/plugins/forms/select2/select2.js',
                                'theme/scripts/plugins/forms/multiselect/js/jquery.multi-select.js',
                                'theme/scripts/plugins/forms/jquery-inputmask/dist/jquery.inputmask.bundle.min.js',
                                'theme/scripts/demo/form_elements.js'
                                );
        $this->view->subjList = $this->model->subjList();
        $this->view->render('form/subject');
    }
    
    public function view_subject($id) {
        $this->view->staticTitle = array('View Subject');
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
        $this->view->subj = $this->model->subj($id);
        
        if(empty($this->view->subj)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('form/view_subject');
    }
    
    public function runSubj() {
        $data = array();
        $data['subjCode'] = isPostSet('subjCode');
        $data['subjName'] = isPostSet('subjName');
        $this->model->runSubj($data);
    }
    
    public function runEditSubj() {
        $data = array();
        $data['subjCode'] = isPostSet('subjCode');
        $data['subjName'] = isPostSet('subjName');
        $data['subjectID'] = isPostSet('subjectID');
        $this->model->runEditSubj($data);
    }
    
    public function deleteSubj($id) {
        $this->model->deleteSubj($id);
    }
    /* End Subject */
    
    /* Begin Subject */
    public function school() {
        $this->view->staticTitle = array('School');
        $this->view->css = array( 
                                'theme/scripts/plugins/forms/select2/select2.css',
                                'theme/scripts/plugins/forms/multiselect/css/multi-select.css',
                                'theme/scripts/plugins/tables/DataTables/media/css/DT_bootstrap.css',
                                'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/css/TableTools.css',
                                'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/css/ColVis.css'
                                );
        $this->view->js = array( 
                                'theme/scripts/plugins/tables/DataTables/media/js/jquery.dataTables.min.js',
                                'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/js/TableTools.min.js',
                                'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/js/ColVis.min.js',
                                'theme/scripts/plugins/tables/DataTables/media/js/DT_bootstrap.js',
                                'theme/scripts/demo/tables.js',
                                'theme/scripts/plugins/forms/select2/select2.js',
                                'theme/scripts/plugins/forms/multiselect/js/jquery.multi-select.js',
                                'theme/scripts/plugins/forms/jquery-inputmask/dist/jquery.inputmask.bundle.min.js',
                                'theme/scripts/demo/form_elements.js'
                                );
        $this->view->schoolList = $this->model->schoolList();
        $this->view->render('form/school');
    }
    
    public function view_school($id) {
        $this->view->staticTitle = array('View School');
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
        $this->view->school = $this->model->school($id);
        
        if(empty($this->view->school)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('form/view_school');
    }
    
    public function runSchool() {
        $data = array();
        $data['schoolCode'] = isPostSet('schoolCode');
        $data['schoolName'] = isPostSet('schoolName');
        $data['buildingCode'] = isPostSet('buildingCode');
        $this->model->runSchool($data);
    }
    
    public function runEditSchool() {
        $data = array();
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
        $this->view->staticTitle = array('Institution');
        $this->view->css = array( 
                                'theme/scripts/plugins/forms/select2/select2.css',
                                'theme/scripts/plugins/forms/multiselect/css/multi-select.css',
                                'theme/scripts/plugins/tables/DataTables/media/css/DT_bootstrap.css',
                                'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/css/TableTools.css',
                                'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/css/ColVis.css'
                                );
        $this->view->js = array( 
                                'theme/scripts/plugins/tables/DataTables/media/js/jquery.dataTables.min.js',
                                'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/js/TableTools.min.js',
                                'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/js/ColVis.min.js',
                                'theme/scripts/plugins/tables/DataTables/media/js/DT_bootstrap.js',
                                'theme/scripts/demo/tables.js',
                                'theme/scripts/plugins/forms/select2/select2.js',
                                'theme/scripts/plugins/forms/multiselect/js/jquery.multi-select.js',
                                'theme/scripts/plugins/forms/jquery-inputmask/dist/jquery.inputmask.bundle.min.js',
                                'theme/scripts/demo/form_elements.js'
                                );
        $this->view->instList = $this->model->instList();
        $this->view->render('form/institution');
    }
    
    public function view_institution($id) {
        $this->view->staticTitle = array('View Institution');
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
        $this->view->inst = $this->model->inst($id);
        
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
	
}