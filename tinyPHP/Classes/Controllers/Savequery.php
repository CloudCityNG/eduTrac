<?php namespace tinyPHP\Classes\Controllers;
/**
 *
 * Save Query Controller
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
 * @since   eduTrac(tm) v 1.0.0
 * @package Controller
 * @author  Joshua Parker <josh@7mediaws.org>
 */

if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');

class Savequery extends \tinyPHP\Classes\Core\Controller {

	public function __construct() {
		parent::__construct();
        if(!hasPermission('access_save_query_screens')) { redirect( BASE_URL . 'dashboard/' ); }
	}
	
	public function index() {
		$this->view->staticTitle = array('List Saved Queries');
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
        $this->view->queryList = $this->model->queryList();
		$this->view->render('savequery/index');
	}
    
    public function add() {
        $this->view->staticTitle = array('Create Save Queries');
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
        $this->view->render('savequery/add');
    }
    
    public function view($id) {
        $this->view->staticTitle = array('View Saved Query');
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
        $this->view->query = $this->model->query($id);
        
        if(empty($this->view->query)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        $this->view->render('savequery/view');
    }
	
	public function save() {
        if (strstra(strtolower(isPostSet('savedQuery')), forbidden_keyword())) {
            redirect( BASE_URL . 'error/SQL/' );
            exit();
        }
		$data = array();
		$data['personID'] = isPostSet('personID');
		$data['savedQueryName'] = isPostSet('savedQueryName');
		$data['savedQuery'] = isPostSet('savedQuery');
        $data['purgeQuery'] = isPostSet('purgeQuery');
		$this->model->save($data);
	}
    
    public function edit() {
        if (strstra(strtolower(isPostSet('savedQuery')), forbidden_keyword())) {
            redirect( BASE_URL . 'error/SQL/' );
            exit();
        }
        $data = array();
        $data['personID'] = isPostSet('personID');
        $data['savedQueryName'] = isPostSet('savedQueryName');
        $data['savedQuery'] = isPostSet('savedQuery');
        $data['purgeQuery'] = isPostSet('purgeQuery');
        $data['savedQueryID'] = isPostSet('savedQueryID');
        $this->model->edit($data);
    }
    
    public function delete($id) {
        $this->model->delete($id);
    }
	
}