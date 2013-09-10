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
 * @since       1.0.0
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */

class Person extends \eduTrac\Classes\Core\Controller {
    
    public function __construct() {
        parent::__construct();
    }
	
	public function index() {
	    if(!hasPermission('access_person_screen')) { redirect( BASE_URL . 'dashboard/' ); }
	    $this->view->staticTitle = array('Search Person');
        $this->view->css = array( 
                                'theme/scripts/plugins/tables/DataTables/media/css/DT_bootstrap.css',
                                'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/css/TableTools.css',
                                'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/css/ColVis.css',
                                );
                                
        $this->view->js = array( 
                                'theme/scripts/plugins/tables/DataTables/media/js/jquery.dataTables.min.js',
                                'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/js/TableTools.min.js',
                                'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/js/ColVis.min.js',
                                'theme/scripts/plugins/tables/DataTables/media/js/DT_bootstrap.js',
                                'theme/scripts/demo/tables.js'
                                );
                                
        $this->view->search = $this->model->search();
        $this->view->render('person/index');
    }
    
    public function add() {
        if(!hasPermission('add_person')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array('Add New Person');
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
        $this->view->render('person/add');
    }
    
    public function addr_form($id) {
        if(!hasPermission('add_address')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array('Add Address Form');
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
                                
        $this->view->person = $this->model->person($id);
        
        if(empty($this->view->person)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('person/addr_form');
    }
    
    public function view($id) {
        if(!hasPermission('access_person_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array('View Person');
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
        $this->view->person = $this->model->person($id);
        $this->view->addr = $this->model->addr($id);
        
        if(empty($this->view->person)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('person/view');
    }
    
    public function addr_sum($id) {
        if(!hasPermission('access_person_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array('Address Summary');
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
        $this->view->person = $this->model->person($id);
        $this->view->addrSum = $this->model->addrSum($id);
        
        if(empty($this->view->addrSum)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('person/addr_sum');
    }
    
    public function edit_addr($id) {
        if(!hasPermission('add_address')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array('Edit Address');
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
        $this->view->addr = $this->model->editAddr($id);
        
        if(empty($this->view->addr)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('person/edit_addr');
    }
    
    public function role($id) {
        if(!hasPermission('access_user_role_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->css = array( 
                                'theme/scripts/plugins/tables/DataTables/media/css/DT_bootstrap.css',
                                'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/css/TableTools.css',
                                'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/css/ColVis.css',
                                );
                                
        $this->view->js = array( 
                                'theme/scripts/plugins/tables/DataTables/media/js/jquery.dataTables.min.js',
                                'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/js/TableTools.min.js',
                                'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/js/ColVis.min.js',
                                'theme/scripts/plugins/tables/DataTables/media/js/DT_bootstrap.js',
                                'theme/scripts/demo/tables.js'
                                );
        $this->view->role = $this->model->rolePerm($id);
        if(empty($this->view->role)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        $this->view->render('person/role');
    }
    
    public function perms($id) {
        if(!hasPermission('access_user_permission_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->css = array( 
                                'theme/scripts/plugins/tables/DataTables/media/css/DT_bootstrap.css',
                                'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/css/TableTools.css',
                                'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/css/ColVis.css',
                                );
                                
        $this->view->js = array( 
                                'theme/scripts/plugins/tables/DataTables/media/js/jquery.dataTables.min.js',
                                'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/js/TableTools.min.js',
                                'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/js/ColVis.min.js',
                                'theme/scripts/plugins/tables/DataTables/media/js/DT_bootstrap.js',
                                'theme/scripts/demo/tables.js'
                                );
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
	
}