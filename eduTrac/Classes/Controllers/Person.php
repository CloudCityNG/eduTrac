<?php namespace eduTrac\Classes\Controllers;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Person Controller
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

class Person extends \eduTrac\Classes\Core\Controller {
    
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
	    if(!hasPermission('access_person_screen')) { redirect( BASE_URL . 'dashboard/' ); }
	    $this->view->staticTitle = array(_t('Search Person'));
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
        $this->view->render('person/index');
    }
    
    public function add() {
        if(!hasPermission('add_person')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array(_t('Add New Person'));
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
        $this->view->render('person/add');
    }
    
    public function addr_form($id) {
        if(!hasPermission('add_address')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array(_t('Add Address Form'));
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
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('person/addr_form');
    }
    
    public function view($id) {
        if(!hasPermission('access_person_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array(_t('View Person'));
        $this->view->person = $this->model->person($id);
        $this->view->addr = $this->model->addr($id);
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
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        $this->view->message = $this->model->message;
        $this->view->render('person/view');
    }
    
    public function addr_sum($id) {
        if(!hasPermission('access_person_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array(_t('Address Summary'));
        $this->view->person = $this->model->person($id);
        $this->view->addrSum = $this->model->addrSum($id);
        
        if(empty($this->view->addrSum)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('person/addr_sum');
    }
    
    public function view_addr($id) {
        if(!hasPermission('access_person_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array(_t('View Address'));
        $this->view->addr = $this->model->editAddr($id);
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
        if(empty($this->view->addr)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('person/view_addr');
    }
    
    public function role($id) {
        if(!hasPermission('access_user_role_screen')) { redirect( BASE_URL . 'dashboard/' ); }
		$this->view->staticTitle = array(_t('User Roles'));
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
        $this->view->role = $this->model->rolePerm($id);
        if(empty($this->view->role)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        $this->view->render('person/role');
    }
    
    public function perms($id) {
        if(!hasPermission('access_user_permission_screen')) { redirect( BASE_URL . 'dashboard/' ); }
		$this->view->staticTitle = array(_t('User Permissions'));
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
        $this->view->perms = $this->model->rolePerm($id);
        if(empty($this->view->perms)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        $this->view->render('person/perms');
    }
    
    public function runRolePerm() {
        if(!hasPermission('access_user_permission_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = array();
        $data['personID'] = isPostSet('personID');
        $this->model->runRolePerm($data);       
    }
    
    public function runAddAddress() {
        if(!hasPermission('add_address')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = array();
        $data['address1'] = isPostSet('address1');
        $data['address2'] = isPostSet('address2');
        $data['city'] = isPostSet('city');
        $data['state'] = isPostSet('state');
        $data['zip'] = isPostSet('zip');
        $data['country'] = isPostSet('country');
        $data['addressType'] = isPostSet('addressType');
        $data['startDate'] = isPostSet('startDate');
        $data['endDate'] = isPostSet('endDate');
        $data['addressStatus'] = isPostSet('addressStatus');
        $data['addDate'] = isPostSet('addDate');
        $data['addedBy'] = isPostSet('addedBy');
        $data['phone1'] = isPostSet('phone1');
        $data['phone2'] = isPostSet('phone2');
        $data['ext1'] = isPostSet('ext1');
        $data['ext2'] = isPostSet('ext2');
        $data['phoneType1'] = isPostSet('phoneType1');
        $data['phoneType2'] = isPostSet('phoneType2');
        $data['email2'] = isPostSet('email2');
        $data['personID'] = isPostSet('personID');
        $this->model->runAddAddress($data);
    }
    
    public function runEditAddress() {
        if(!hasPermission('add_address')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = array();
        $data['address1'] = isPostSet('address1');
        $data['address2'] = isPostSet('address2');
        $data['city'] = isPostSet('city');
        $data['state'] = isPostSet('state');
        $data['zip'] = isPostSet('zip');
        $data['country'] = isPostSet('country');
        $data['addressType'] = isPostSet('addressType');
        $data['startDate'] = isPostSet('startDate');
        $data['endDate'] = isPostSet('endDate');
        $data['addressStatus'] = isPostSet('addressStatus');
        $data['phone1'] = isPostSet('phone1');
        $data['phone2'] = isPostSet('phone2');
        $data['ext1'] = isPostSet('ext1');
        $data['ext2'] = isPostSet('ext2');
        $data['phoneType1'] = isPostSet('phoneType1');
        $data['phoneType2'] = isPostSet('phoneType2');
        $data['email2'] = isPostSet('email2');
        $data['addressID'] = isPostSet('addressID');
        $this->model->runEditAddress($data);
    }
    
    public function runPerson() {
        if(!hasPermission('add_person')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = array();
        $data['uname'] = isPostSet('uname');
        $data['personType'] = isPostSet('personType');
        $data['prefix'] = isPostSet('prefix');
        $data['fname'] = isPostSet('fname');
        $data['lname'] = isPostSet('lname');
        $data['mname'] = isPostSet('mname');
        $data['address1'] = isPostSet('address1');
        $data['address2'] = isPostSet('address2');
        $data['city'] = isPostSet('city');
        $data['state'] = isPostSet('state');
        $data['zip'] = isPostSet('zip');
        $data['country'] = isPostSet('country');
        $data['phone'] = isPostSet('phone');
        $data['email'] = isPostSet('email');
        $data['ssn'] = isPostSet('ssn');
        $data['dob'] = isPostSet('dob');
        $data['veteran'] = isPostSet('veteran');
        $data['ethnicity'] = isPostSet('ethnicity');
        $data['gender'] = isPostSet('gender');
        $data['emergency_contact'] = isPostSet('emergency_contact');
        $data['emergency_contact_phone'] = isPostSet('emergency_contact_phone');
        $this->model->runPerson($data);
    }
    
    public function runEditPerson() {
        if(!hasPermission('add_person')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = array();
        $data['personType'] = isPostSet('personType');
        $data['prefix'] = isPostSet('prefix');
        $data['fname'] = isPostSet('fname');
        $data['lname'] = isPostSet('lname');
        $data['mname'] = isPostSet('mname');
        $data['email'] = isPostSet('email');
        $data['ssn'] = isPostSet('ssn');
        $data['dob'] = isPostSet('dob');
        $data['veteran'] = isPostSet('veteran');
        $data['ethnicity'] = isPostSet('ethnicity');
        $data['gender'] = isPostSet('gender');
        $data['emergency_contact'] = isPostSet('emergency_contact');
        $data['emergency_contact_phone'] = isPostSet('emergency_contact_phone');
        $data['personID'] = isPostSet('personID');
        $this->model->runEditPerson($data);
    }
    
    public function runUsernameCheck() {
        if(!hasPermission('add_person')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = array();
        $data['uname'] = isPostSet('uname');
        $this->model->runUsernameCheck($data);
    }
    
    public function resetPassword($id) {
        $this->model->resetPassword($id);
    }
    
    public function search() {
        $this->model->search();
    }
	
}