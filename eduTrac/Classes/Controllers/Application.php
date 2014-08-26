<?php namespace eduTrac\Classes\Controllers;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Application Controller
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

class Application extends \eduTrac\Classes\Core\Controller {

	public function __construct() {
		parent::__construct();
        if(!hasPermission('access_application_screen')) { redirect( BASE_URL . 'dashboard/' ); }
	}
	
	public function index() {
		$this->view->staticTitle = array(_t('Search Applications'));
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
		$this->view->render('application/index');
	}
    
    public function add($id) {
        if(!hasPermission('create_application')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array(_t('Add Application'));
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
        $this->view->person = $this->model->person($id);
        $this->view->address = $this->model->address($id);
        
        if(empty($this->view->person)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        $this->view->render('application/add');
    }
    
    public function view($id) {
        if(!hasPermission('create_application')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array(_t('View Application'));
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
        $this->view->appl = $this->model->appl($id);
        $this->view->applAddr = $this->model->applAddr($id);
        $this->view->inst = $this->model->inst($id);
        
        if(empty($this->view->appl)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('application/view');
    }
	
	public function inst_attended() {
        if(!hasPermission('create_application')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array(_t('Institution Attended'));
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
        $this->view->render('application/inst_attended');
    }
    
    public function runApplication() {
        if(!hasPermission('create_application')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = [];
		$data['applDate'] = isPostSet('applDate');
        $data['acadProgCode'] = isPostSet('acadProgCode');
        $data['startTerm'] = isPostSet('startTerm');
        $data['admitStatus'] = isPostSet('admitStatus');
        $data['PSAT_Verbal'] = isPostSet('PSAT_Verbal');
        $data['PSAT_Math'] = isPostSet('PSAT_Math');
        $data['SAT_Verbal'] = isPostSet('SAT_Verbal');
        $data['SAT_Math'] = isPostSet('SAT_Math');
        $data['ACT_English'] = isPostSet('ACT_English');
        $data['ACT_Math'] = isPostSet('ACT_Math');
		$data['addedBy'] = isPostSet('addedBy');
        $data['personID'] = isPostSet('personID');
        $this->model->runApplication($data);
    }
    
    public function runEditApplication() {
        if(!hasPermission('create_application')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = [];
		$data['applDate'] = isPostSet('applDate');
        $data['acadProgCode'] = isPostSet('acadProgCode');
        $data['startTerm'] = isPostSet('startTerm');
        $data['admitStatus'] = isPostSet('admitStatus');
        $data['PSAT_Verbal'] = isPostSet('PSAT_Verbal');
        $data['PSAT_Math'] = isPostSet('PSAT_Math');
        $data['SAT_Verbal'] = isPostSet('SAT_Verbal');
        $data['SAT_Math'] = isPostSet('SAT_Math');
        $data['ACT_English'] = isPostSet('ACT_English');
        $data['ACT_Math'] = isPostSet('ACT_Math');
        $data['fice_ceeb'] = isPostSet('fice_ceeb');
        $data['fromDate'] = isPostSet('fromDate');
        $data['toDate'] = isPostSet('toDate');
		$data['major'] = isPostSet('major');
        $data['GPA'] = isPostSet('GPA');
		$data['degree_awarded'] = isPostSet('degree_awarded');
        $data['degree_conferred_date'] = isPostSet('degree_conferred_date');
        $data['personID'] = isPostSet('personID');
        $data['applID'] = isPostSet('applID');
        $data['instAttID'] = isPostSet('instAttID');
        $this->model->runEditApplication($data);
    }
	
	public function runInstAttended() {
        if(!hasPermission('create_application')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = [];
		$data['personID'] = isPostSet('personID');
        $data['fice_ceeb'] = isPostSet('fice_ceeb');
        $data['fromDate'] = isPostSet('fromDate');
        $data['toDate'] = isPostSet('toDate');
        $data['major'] = isPostSet('major');
		$data['GPA'] = isPostSet('GPA');
        $data['degree_awarded'] = isPostSet('degree_awarded');
        $data['degree_conferred_date'] = isPostSet('degree_conferred_date');
		$data['addDate'] = date('Y-m-d');
		$data['addedBy'] = isPostSet('addedBy');
        $this->model->runInstAttended($data);
    }

	public function runApplicantLookup() {
		$data = [];
		$data['personID'] = isPostSet('personID');
		$this->model->runApplicantLookup($data);
	}
	
	public function deleteInstAttend($id) {
        $this->model->deleteInstAttend($id);
    }
    
    public function search() {
        $this->model->search();
    }
        
}