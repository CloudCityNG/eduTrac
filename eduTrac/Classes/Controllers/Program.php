<?php namespace eduTrac\Classes\Controllers;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Academic Program Controller
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

class Program extends \eduTrac\Classes\Core\Controller {

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
        if(!hasPermission('access_acad_prog_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array(_t('Search Program'));
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
        $this->view->render('program/index');
    }
	
    public function add() {
        if(!hasPermission('add_acad_prog')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array(_t('Add Program'));
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
        $this->view->render('program/add');
    }
    
    public function view($id) {
        if(!hasPermission('access_acad_prog_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array(_t('View Program'));
        $this->view->prog = $this->model->prog($id);
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
        if(empty($this->view->prog)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('program/view');
    }
    
    public function runProg() {
        if(!hasPermission('add_acad_prog')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = array();
        $data['acadProgCode'] = isPostSet('acadProgCode');
        $data['acadProgTitle'] = isPostSet('acadProgTitle');
        $data['programDesc'] = isPostSet('programDesc');
        $data['currStatus'] = isPostSet('currStatus');
        $data['statusDate'] = isPostSet('statusDate');
        $data['approvedBy'] = isPostSet('approvedBy');
        $data['approvedDate'] = isPostSet('approvedDate');
        $data['deptCode'] = isPostSet('deptCode');
        $data['schoolCode'] = isPostSet('schoolCode');
        $data['acadYearCode'] = isPostSet('acadYearCode');
        $data['startDate'] = isPostSet('startDate');
        $data['endDate'] = isPostSet('endDate');
        $data['degreeCode'] = isPostSet('degreeCode');
        $data['ccdCode'] = isPostSet('ccdCode');
        $data['majorCode'] = isPostSet('majorCode');
        $data['minorCode'] = isPostSet('minorCode');
        $data['specCode'] = isPostSet('specCode');
        $data['acadLevelCode'] = isPostSet('acadLevelCode');
        $data['cipCode'] = isPostSet('cipCode');
        $data['locationCode'] = isPostSet('locationCode');
        $this->model->runProg($data);
    }
    
    public function runEditProg() {
        if(!hasPermission('add_acad_prog')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = array();
        $data['acadProgCode'] = isPostSet('acadProgCode');
        $data['acadProgTitle'] = isPostSet('acadProgTitle');
        $data['programDesc'] = isPostSet('programDesc');
        $data['currStatus'] = isPostSet('currStatus');
        $data['deptCode'] = isPostSet('deptCode');
        $data['schoolCode'] = isPostSet('schoolCode');
        $data['acadYearCode'] = isPostSet('acadYearCode');
        $data['startDate'] = isPostSet('startDate');
        $data['endDate'] = isPostSet('endDate');
        $data['degreeCode'] = isPostSet('degreeCode');
        $data['ccdCode'] = isPostSet('ccdCode');
        $data['majorCode'] = isPostSet('majorCode');
        $data['minorCode'] = isPostSet('minorCode');
        $data['specCode'] = isPostSet('specCode');
        $data['acadLevelCode'] = isPostSet('acadLevelCode');
        $data['cipCode'] = isPostSet('cipCode');
        $data['locationCode'] = isPostSet('locationCode');
        $data['acadProgID'] = isPostSet('acadProgID');
        $this->model->runEditProg($data);
    }
    
    public function search() {
        if(!hasPermission('access_acad_prog_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = array();
        $data['prog'] = isPostSet('prog');
        $this->model->search($data);
    }
	
}