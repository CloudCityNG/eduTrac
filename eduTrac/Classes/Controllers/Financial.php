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
 * @since       1.0.4
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */

class Financial extends \eduTrac\Classes\Core\Controller {

	public function __construct() {
		parent::__construct();
        if(!hasPermission('access_student_accounts')) { redirect( BASE_URL . 'dashboard/' ); }
	}
	
	public function index() {
		$this->view->staticTitle = array('Search Bill');
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
	
	public function account_chart() {
		$this->view->staticTitle = array('Chart of Accounts');
		$this->view->css = array( 
								'theme/scripts/plugins/tables/DataTables/media/css/DT_bootstrap.css',
								'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/css/TableTools.css',
								'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/css/ColVis.css',
								'theme/scripts/plugins/forms/select2/select2.css',
                                'theme/scripts/plugins/forms/multiselect/css/multi-select.css'
								);
								
		$this->view->js = array( 
								'theme/scripts/plugins/tables/DataTables/media/js/jquery.dataTables.min.js',
								'theme/scripts/plugins/tables/DataTables/extras/TableTools/media/js/TableTools.min.js',
								'theme/scripts/plugins/tables/DataTables/extras/ColVis/media/js/ColVis.min.js',
								'theme/scripts/plugins/tables/DataTables/media/js/DT_bootstrap.js',
								'theme/scripts/demo/tables.js',
								'theme/scripts/plugins/forms/select2/select2.js',
                                'theme/scripts/plugins/forms/multiselect/js/jquery.multi-select.js',
                                'theme/scripts/plugins/forms/jquery-inputmask/dist/jquery.inputmask.bundle.min.js',
                                'theme/scripts/demo/form_elements.js'
								);
        $this->view->glAccount = $this->model->glAccount();
		$this->view->render('financial/account_chart');
	}
	
	public function journal_entries() {
		$this->view->staticTitle = array('General Journal Entries');
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
        $this->view->jentry = $this->model->jentry();
		$this->view->render('financial/journal_entries');
	}
	
	public function add_jentry() {
        $this->view->staticTitle = array('Add General Journal Entry');
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
        $this->view->render('financial/add_jentry');
    }
	
	public function jentry_filter() {
        $this->view->staticTitle = array('Filter General Journal Entries');
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
        $this->view->render('financial/jentry_filter');
    }
	
	public function gl_filter() {
        $this->view->staticTitle = array('Filter General Ledger');
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
        $this->view->render('financial/gl_filter');
    }
	
	public function view_jentry($id) {
		$this->view->jentry = $this->model->viewjEntry($id);
		$this->view->jentryTrans = $this->model->viewjEntryTrans($id);
		if(empty($this->view->jentry)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
		$this->view->render('bh',true);
        $this->view->render('financial/view_jentry',true);
		$this->view->render('bf',true);
    }
	
	public function jentries() {
		$this->view->jefilter = $this->model->jefilter();
		$this->view->jefilterSum = $this->model->jefilterSum();
		$this->view->render('bh',true);
        $this->view->render('financial/jentries',true);
		$this->view->render('bf',true);
    }
	
	public function gl_summary() {
		$this->view->glfilter = $this->model->glfilter();
		$this->view->glfilterSum = $this->model->glfilterSum();
		$this->view->render('bh',true);
        $this->view->render('financial/gl_summary',true);
		$this->view->render('bf',true);
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
    
    public function create_bill() {
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
        $this->view->render('financial/create_bill');
    }
    
    public function batch() {
        $this->view->staticTitle = array('Add Batch Fees');
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
        $this->view->render('financial/batch');
    }
    
    public function view_bill($id) {
        $this->view->staticTitle = array('View Bill');
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
        $this->view->bill = $this->model->bill($id);
        $this->view->address = $this->model->address($id);
        $this->view->beginBalance = $this->model->beginBalance($id);
        $this->view->courseFees = $this->model->courseFees($id);
        $this->view->sumRefund = $this->model->sumRefund($id);
        $this->view->sumPayments = $this->model->sumPayments($id);
        $this->view->refund = $this->model->refund($id);
        $this->view->payment = $this->model->payment($id);
        
        if(empty($this->view->bill)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('financial/view_bill');
    }
    
    public function add_payment() {
        $this->view->staticTitle = array('Add Payment');
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
        $this->view->render('financial/add_payment');
    }
    
    public function issue_refund() {
        $this->view->staticTitle = array('Issue Refund');
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
        $this->view->render('financial/issue_refund');
    }
	
	public function runGLAccount() {
        $data = [];
        $data['gl_acct_number'] = isPostSet('gl_acct_number');
        $data['gl_acct_name'] = isPostSet('gl_acct_name');
        $data['gl_acct_type'] = isPostSet('gl_acct_type');
        $data['gl_acct_memo'] = isPostSet('gl_acct_memo');
        $this->model->runGLAccount($data);
    }

	public function runEditGLAccount() {
        $data = [];
        $data['gl_acct_number'] = isPostSet('gl_acct_number');
        $data['gl_acct_name'] = isPostSet('gl_acct_name');
        $data['gl_acct_type'] = isPostSet('gl_acct_type');
        $data['gl_acct_memo'] = isPostSet('gl_acct_memo');
		$data['id'] = isPostSet('id');
        $this->model->runEditGLAccount($data);
    }
	
	public function runjEntry() {
		$data = [];
		$data['gl_jentry_date'] = isPostSet('gl_jentry_date');
		$data['gl_jentry_title'] = isPostSet('gl_jentry_title');
		$data['gl_jentry_manual_id'] = isPostSet('gl_jentry_manual_id');
		$data['gl_jentry_description'] = isPostSet('gl_jentry_description');
		$data['glacctID'] = isPostSet('glacctID');
		$data['gl_trans_memo'] = isPostSet('gl_trans_memo');
		$data['amount'] = isPostSet('amount');
		$this->model->runjEntry($data);
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
    
    public function runBill() {
        $data = [];
        $data['stuID'] = isPostSet('stuID');
        $data['termID'] = isPostSet('termID');
        $data['feeID'] = isPostSet('feeID');
        $this->model->runBill($data);
    }
    
    public function runBatch() {
        $data = [];
        $data['population'] = isPostSet('population');
        $data['stu_program'] = isPostSet('stu_program');
        $data['major'] = isPostSet('major');
        $data['acadLevelCode'] = isPostSet('acadLevelCode');
        $data['termID'] = isPostSet('termID');
        $data['feeID'] = isPostSet('feeID');
        $this->model->runBatch($data);
    }
    
    public function runPayment() {
        $data = [];
        $data['stuID'] = isPostSet('stuID');
        $data['termID'] = isPostSet('termID');
        $data['amount'] = isPostSet('amount');
        $data['paymentTypeID'] = isPostSet('paymentTypeID');
        $data['checkNum'] = isPostSet('checkNum');
        $data['comment'] = isPostSet('comment');
        $this->model->runPayment($data);
    }
    
    public function runRefund() {
        $data = [];
        $data['stuID'] = isPostSet('stuID');
        $data['termID'] = isPostSet('termID');
        $data['amount'] = isPostSet('amount');
        $data['comment'] = isPostSet('comment');
        $this->model->runRefund($data);
    }
    
    public function search() {
        $this->model->search();
    }
    
    public function deleteFee($id) {
        $this->model->deleteFee($id);
    }
    
    public function deletePayment($id) {
        $this->model->deletePayment($id);
    }
    
    public function deleteRefund($id) {
        $this->model->deleteRefund($id);
    }
        
}