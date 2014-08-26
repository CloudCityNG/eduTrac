<?php namespace eduTrac\Classes\Controllers;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Error Controller
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

class Error extends \eduTrac\Classes\Core\Controller {
	
	private $_auth;

	public function __construct() {
		parent::__construct();
		$this->_auth = new \eduTrac\Classes\Libraries\Cookies();
        if(!$this->_auth->isUserLoggedIn()) { redirect( BASE_URL . 'dashboard/' ); }
		/**
		 * If user is logged in and the lockscreen cookie is set, 
		 * redirect user to the lock screen until he/she enters 
		 * his/her password to gain access.
		 */
		if(isset($_COOKIE['SCREENLOCK'])) {
			redirect( BASE_URL . 'lock/' );
		}
	}
    
    public function logs() {
        $this->view->staticTitle = array(_t('Error Log'));
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
        $this->view->logs = $this->model->logs();
        $this->view->render('error/logs');
    }
	
	public function index() {
		$this->view->render('error/header',true);
		$this->view->render('error/index',true);
		$this->view->render('error/footer',true);
	}
    
    public function population() {
        $this->view->staticTitle = array(_t('Missing Population'));
        $this->view->render('error/population');
    }
    
    public function import() {
        $this->view->staticTitle = array(_t('Importer Error'));
        $this->view->render('error/import');
    }
    
    public function invalid_record() {
        $this->view->staticTitle = array(_t('Invalid Record'));
        $this->view->render('error/invalid_record');
    }
	
    public function sql() {
        $this->view->staticTitle = array(_t('SQL Restricted Keywords'));
        $this->view->render('error/sql');
    }
    
	public function screen_error() {
		$this->view->staticTitle = array(_t('Screen Error'));
		$this->view->render('error/screen_error');
	}
    
    public function delete_record() {
        $this->view->staticTitle = array(_t('Delete Record Error'));
        $this->view->render('error/delete_record');
    }
    
    public function update_record() {
        $this->view->staticTitle = array(_t('Update Record Error'));
        $this->view->render('error/update_record');
    }
	
	public function save_query() {
		$this->view->staticTitle = array(_t('Save Query'));
		$this->view->render('error/save_query');
	}
    
    public function nslc_purge() {
        $this->view->staticTitle = array(_t('NSLC Purge Error'));
        $this->view->render('error/nslc_purge');
    }
    
    public function nslc_extraction() {
        $this->view->staticTitle = array(_t('NSLC Extraction Error'));
        $this->view->render('error/nslc_extraction');
    }
    
    public function course_registration() {
        $this->view->staticTitle = array(_t('Course Registration Error'));
        $this->view->render('error/course_registration');
    }
    
    public function registration() {
        $this->view->staticTitle = array(_t('Registration Restriction'));
        $this->view->render('error/registration');
    }
    
    public function save_data() {
        $this->view->staticTitle = array(_t('Save Data'));
        $this->view->render('error/save_data');
    }
    
    public function edit_data() {
        $this->view->staticTitle = array(_t('Edit Data'));
        $this->view->render('error/edit_data');
    }
    
    public function reset_password() {
        $this->view->staticTitle = array(_t('Reset Password Error'));
        $this->view->render('error/reset_password');
    }
    
    public function deleteLog($id) {
        $this->model->deleteLog($id);
    }

}