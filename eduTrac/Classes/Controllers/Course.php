<?php namespace eduTrac\Classes\Controllers;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Course Controller
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

class Course extends \eduTrac\Classes\Core\Controller {
	
	private $_auth;

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
		if(!hasPermission('access_course_screen')) { redirect( BASE_URL . 'dashboard/' ); }
		$this->view->staticTitle = array(_t('Search Course'));
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
		$this->view->render('course/index');
	}
    
    public function add() {
        if(!hasPermission('add_course')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array(_t('Add Course'));
		$this->view->less = [ 'less/admin/module.admin.page.form_elements.less' ];
		$this->view->css = [ 'css/admin/module.admin.page.form_elements.min.css' ];
        $this->view->js = [ 
                            'components/modules/admin/forms/elements/bootstrap-select/assets/lib/js/bootstrap-select.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-select/assets/custom/js/bootstrap-select.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/lib/js/select2.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/custom/js/select2.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/lib/js/bootstrap-datepicker.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/custom/js/bootstrap-datepicker.init.js?v=v2.1.0',
                            'components/modules/admin/forms/editors/wysihtml5/assets/lib/js/wysihtml5-0.3.0_rc2.min.js?v=v2.1.0',
                            'components/modules/admin/forms/editors/wysihtml5/assets/lib/js/bootstrap-wysihtml5-0.0.2.js?v=v2.1.0',
                            'components/modules/admin/forms/editors/wysihtml5/assets/custom/wysihtml5.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-maxlength/bootstrap-maxlength.min.js',
                            'components/modules/admin/forms/elements/bootstrap-maxlength/custom/js/custom.js'
                            ];
        $this->view->render('course/add');
    }
    
    public function view($id) {
        if(!hasPermission('access_course_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array(_t('View Course'));
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
                            'components/modules/admin/forms/editors/wysihtml5/assets/lib/js/wysihtml5-0.3.0_rc2.min.js?v=v2.1.0',
                            'components/modules/admin/forms/editors/wysihtml5/assets/lib/js/bootstrap-wysihtml5-0.0.2.js?v=v2.1.0',
                            'components/modules/admin/forms/editors/wysihtml5/assets/custom/wysihtml5.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-maxlength/bootstrap-maxlength.min.js',
                            'components/modules/admin/forms/elements/bootstrap-maxlength/custom/js/custom.js'
                            ];
        if(empty($this->view->crse)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('course/view');
    }
    
    public function addnl_info($id) {
        if(!hasPermission('access_course_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array(_t('Additional Course Info'));
        $this->view->addnl = $this->model->crse($id);
        $this->view->crseList = $this->model->crseList();
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
        
        $this->view->render('course/addnl_info');
    }
    
    public function runCourse() {
        if(!hasPermission('add_course')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = array();
        $data['courseNumber'] = isPostSet('courseNumber');
        //$data['courseCode'] = isPostSet('courseCode');
        $data['subjectCode'] = isPostSet('subjectCode');
        $data['deptCode'] = isPostSet('deptCode');
        $data['courseDesc'] = isPostSet('courseDesc');
        $data['minCredit'] = isPostSet('minCredit');
        //$data['maxCredit'] = isPostSet('maxCredit');
        //$data['increCredit'] = isPostSet('increCredit');
        $data['courseLevelCode'] = isPostSet('courseLevelCode');
        $data['acadLevelCode'] = isPostSet('acadLevelCode');
        $data['courseShortTitle'] = isPostSet('courseShortTitle');
        $data['courseLongTitle'] = isPostSet('courseLongTitle');
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
        //$data['courseCode'] = isPostSet('courseCode');
        $data['subjectCode'] = isPostSet('subjectCode');
        $data['deptCode'] = isPostSet('deptCode');
        $data['courseDesc'] = isPostSet('courseDesc');
        $data['minCredit'] = isPostSet('minCredit');
        //$data['maxCredit'] = isPostSet('maxCredit');
        //$data['increCredit'] = isPostSet('increCredit');
        $data['courseLevelCode'] = isPostSet('courseLevelCode');
        $data['acadLevelCode'] = isPostSet('acadLevelCode');
        $data['courseShortTitle'] = isPostSet('courseShortTitle');
        $data['courseLongTitle'] = isPostSet('courseLongTitle');
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