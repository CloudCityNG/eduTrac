<?php namespace eduTrac\Classes\Controllers;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Institution Controller
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

class Institution extends \eduTrac\Classes\Core\Controller {

	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
        if(!hasPermission('access_institutions_screen')) { redirect( BASE_URL . 'dashboard/' ); }
		$this->view->staticTitle = array('Institutions');
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
		$this->view->render('institution/index');
	}
    
    public function add() {
        if(!hasPermission('add_institution')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array('Add Institution');
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
        $this->view->render('institution/add');
    }
    
    public function view($id) {
        if(!hasPermission('access_institutions_screen')) { redirect( BASE_URL . 'dashboard/' ); }
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
        
        $this->view->render('institution/view');
    }
    
    public function runInstitution() {
        if(!hasPermission('add_institution')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = [];
        $data['ficeCode'] = isPostSet('ficeCode');
        $data['instType'] = isPostSet('instType');
        $data['instName'] = isPostSet('instName');
        $data['city'] = isPostSet('city');
        $data['state'] = isPostSet('state');
        $this->model->runInstitution($data);
    }
    
    public function runEditInstitution() {
        if(!hasPermission('add_institution')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = [];
        $data['ficeCode'] = isPostSet('ficeCode');
        $data['instType'] = isPostSet('instType');
        $data['instName'] = isPostSet('instName');
        $data['city'] = isPostSet('city');
        $data['state'] = isPostSet('state');
        $data['institutionID'] = isPostSet('institutionID');
        $this->model->runEditInstitution($data);
    }
        
}