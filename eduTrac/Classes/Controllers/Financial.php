<?php namespace eduTrac\Classes\Controllers;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Financial Controller
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
 * @since       1.0.3
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */

class Financial extends \eduTrac\Classes\Core\Controller {

	public function __construct() {
		parent::__construct();
        if(!hasPermission('access_financial')) { redirect( BASE_URL . 'dashboard/' ); }
	}
	
	public function index() {
		$this->view->staticTitle = array('Search Invoice');
		$this->view->css = array( 
								'theme/scripts/plugins/tables/DataTables/media/css/DT_bootstrap.css',
								'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/css/TableTools.css',
								'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/css/ColVis.css'
								);
								
		$this->view->js = array( 
								'theme/scripts/plugins/tables/DataTables/media/js/jquery.dataTables.min.js',
								'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/js/TableTools.min.js',
								'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/js/ColVis.min.js',
								'theme/scripts/plugins/tables/DataTables/media/js/DT_bootstrap.js',
								'theme/scripts/demo/tables.js'
								);
        $this->view->search = $this->model->search();
		$this->view->render('financial/index');
	}
    
    public function billing_table() {
        $this->view->staticTitle = array('Billing Table');
        $this->view->css = array( 
                                'theme/scripts/plugins/forms/select2/select2.css',
                                'theme/scripts/plugins/forms/multiselect/css/multi-select.css',
                                'theme/scripts/plugins/tables/DataTables/media/css/DT_bootstrap.css',
                                'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/css/TableTools.css',
                                'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/css/ColVis.css'
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
        $this->view->billingTable = $this->model->billingTable();
        $this->view->render('financial/billing_table');
    }
    
    public function create_invoice() {
        $this->view->staticTitle = array('Add Fees');
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
        $this->view->render('financial/create_invoice');
    }
    
    public function view_invoice($id) {
        $this->view->staticTitle = array('View Invoice');
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
        $this->view->invoice = $this->model->invoice($id);
        $this->view->address = $this->model->address($id);
        $this->view->beginBalance = $this->model->beginBalance($id);
        $this->view->endBalance = $this->model->endBalance($id);
        $this->view->payment = $this->model->payment($id);
        
        if(empty($this->view->invoice)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('financial/view_invoice');
    }
    
    public function runBillTable() {
        $data = [];
        $data['name'] = isPostSet('name');
        $data['amount'] = isPostSet('amount');
        $data['status'] = isPostSet('status');
        $data['ID'] = isPostSet('ID');
        $data['update'] = isPostSet('update');
        $this->model->runBillTable($data);
    }
    
    public function runEditBillTable() {
        $data = [];
        $data['name'] = isPostSet('name');
        $data['amount'] = isPostSet('amount');
        $data['status'] = isPostSet('status');
        $data['ID'] = isPostSet('ID');
        $this->model->runEditBillTable($data);
    }
    
    public function runStuLookup() {
        $data = [];
        $data['stuID'] = isPostSet('stuID');
        $this->model->runStuLookup($data);
    }
    
    public function runInvoice() {
        $data = [];
        $data['stuID'] = isPostSet('stuID');
        $data['termID'] = isPostSet('termID');
        $data['feeID'] = isPostSet('feeID');
        $this->model->runInvoice($data);
    }
    
    public function search() {
        $this->model->search();
    }
    
    public function deleteFee($id) {
        $this->model->deleteFee($id);
    }
        
}