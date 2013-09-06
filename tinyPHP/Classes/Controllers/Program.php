<?php namespace tinyPHP\Classes\Controllers;
/**
 *
 * Academic Program Controller
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

class Program extends \tinyPHP\Classes\Core\Controller {

	public function __construct() {
		parent::__construct();
	}
    
    public function index() {
        if(!hasPermission('access_acad_prog_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array('Search Program');
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
        $this->view->render('program/index');
    }
	
    public function add() {
        if(!hasPermission('add_acad_prog')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array('Add Program');
        $this->view->css = array( 
                                'theme/scripts/plugins/forms/select2/select2.css',
                                'theme/scripts/plugins/forms/multiselect/css/multi-select.css'
                                );
        $this->view->js = array( 
                                'theme/scripts/plugins/forms/select2/select2.js',
                                'theme/scripts/plugins/forms/multiselect/js/jquery.multi-select.js',
                                'theme/scripts/plugins/forms/jquery-inputmask/dist/jquery.inputmask.bundle.min.js',
                                'theme/scripts/demo/form_elements.js',
                                );
        $this->view->render('program/add');
    }
    
    public function view($id) {
        if(!hasPermission('access_acad_prog_screen')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array('View Program');
        $this->view->css = array( 
                                'theme/scripts/plugins/forms/select2/select2.css',
                                'theme/scripts/plugins/forms/multiselect/css/multi-select.css'
                                );
        $this->view->js = array( 
                                'theme/scripts/plugins/forms/select2/select2.js',
                                'theme/scripts/plugins/forms/multiselect/js/jquery.multi-select.js',
                                'theme/scripts/plugins/forms/jquery-inputmask/dist/jquery.inputmask.bundle.min.js',
                                'theme/scripts/demo/form_elements.js',
                                );
        $this->view->prog = $this->model->prog($id);
        
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
        $data['statusDate'] = isPostSet('statusDate');
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