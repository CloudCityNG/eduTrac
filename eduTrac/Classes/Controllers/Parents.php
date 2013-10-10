<?php namespace eduTrac\Classes\Controllers;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Parents Controller
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
 * @since       1.0.2
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */

class Parents extends \eduTrac\Classes\Core\Controller {

	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
	    if(!hasPermission('access_parent_screen')) { redirect( BASE_URL . 'dashboard/' ); }
		$this->view->staticTitle = array('Search Parent');
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
		$this->view->render('parents/index');
	}
    
    public function view($id) {
        if(!hasPermission('access_parent_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array('View Parent');
        $this->view->css = array( 
                                'theme/scripts/plugins/forms/select2/select2.css',
                                'theme/scripts/plugins/forms/multiselect/css/multi-select.css',
                                'theme/scripts/plugins/tables/DataTables/media/css/DT_bootstrap.css',
                                'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/css/TableTools.css',
                                'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/css/ColVis.css',
                                );
        $this->view->js = array( 
                                'theme/scripts/plugins/forms/select2/select2.js',
                                'theme/scripts/plugins/forms/multiselect/js/jquery.multi-select.js',
                                'theme/scripts/plugins/forms/jquery-inputmask/dist/jquery.inputmask.bundle.min.js',
                                'theme/scripts/plugins/tables/DataTables/media/js/jquery.dataTables.min.js',
                                'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/js/TableTools.min.js',
                                'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/js/ColVis.min.js',
                                'theme/scripts/plugins/tables/DataTables/media/js/DT_bootstrap.js',
                                'theme/scripts/demo/tables.js',
                                'theme/scripts/demo/form_elements.js'
                                );
        $this->view->Parent = $this->model->Parent($id);
        $this->view->address = $this->model->address($id);
        $this->view->children = $this->model->children($id);
        
        if(empty($this->view->Parent)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('parents/view');
    }
    
    public function connect() {
        if(!hasPermission('create_par_record')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array('Parent/Student Connection');
        $this->view->css = array( 
                                'theme/scripts/plugins/forms/select2/select2.css',
                                'theme/scripts/plugins/forms/multiselect/css/multi-select.css',
                                );
        $this->view->js = array( 
                                'theme/scripts/plugins/forms/select2/select2.js',
                                'theme/scripts/plugins/forms/multiselect/js/jquery.multi-select.js',
                                'theme/scripts/plugins/forms/jquery-inputmask/dist/jquery.inputmask.bundle.min.js',
                                'theme/scripts/demo/form_elements.js'
                                );
        $this->view->render('parents/connect');
    }
    
    public function portal() {
        if(!hasPermission('access_parent_portal')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array('Parent Portal');
        $this->view->render('parents/portal');
    }
    
    public function children() {
        if(!hasPermission('access_parent_portal')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array('Children');
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
        $this->view->childPortal = $this->model->childPortal();
        $this->view->render('parents/children');
    }
    
    public function grades($id) {
        if(!hasPermission('access_parent_portal')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array('Grades');
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
        $this->view->grades = $this->model->grades($id);
        if(empty($this->view->grades)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        $this->view->render('parents/grades');
    }
    
    public function progress($id) {
        if(!hasPermission('access_parent_portal')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array('Progress Reports');
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
        $this->view->progress = $this->model->progress($id);
        if(empty($this->view->progress)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        $this->view->render('parents/progress');
    }
    
    public function view_progress($id) {
        if(!hasPermission('access_parent_portal')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array('View Progress Report');
        $this->view->css = array( 
                                'theme/scripts/plugins/forms/select2/select2.css',
                                'theme/scripts/plugins/forms/multiselect/css/multi-select.css',
                                );
        $this->view->js = array( 
                                'theme/scripts/plugins/forms/select2/select2.js',
                                'theme/scripts/plugins/forms/multiselect/js/jquery.multi-select.js',
                                'theme/scripts/plugins/forms/jquery-inputmask/dist/jquery.inputmask.bundle.min.js',
                                'theme/scripts/demo/form_elements.js'
                                );
        $this->view->viewProgress = $this->model->viewProgress($id);
        if(empty($this->view->viewProgress)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        $this->view->render('parents/view_progress');
    }
    
    public function runParent($id) {
        if(!hasPermission('create_par_record')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->model->runParent($id);
    }
    
     public function runEditParent() {
         if(!hasPermission('create_par_record')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = array();
        $data['status'] = isPostSet('status');
        $data['parentID'] = isPostSet('parentID');
        $this->model->runEditParent($data);
    }
    
    public function runParLookup() {
        if(!hasPermission('create_par_record')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = array();
        $data['parentID'] = isPostSet('parentID');
        $this->model->runParLookup($data);
    }
    
    public function runChildLookup() {
        if(!hasPermission('create_par_record')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = array();
        $data['childID'] = isPostSet('childID');
        $this->model->runChildLookup($data);
    }
    
    public function runConnection() {
        if(!hasPermission('create_par_record')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = [];
        $data['parentID'] = isPostSet('parentID');
        $data['childID'] = isPostSet('childID');
        $this->model->runConnection($data);
    }
    
    public function search() {
        if(!hasPermission('access_parent_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->model->search();
    }
    
    public function deleteConnection($id) {
        $this->model->deleteConnection($id);
    }
	
}