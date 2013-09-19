<?php namespace eduTrac\Classes\Controllers;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Application Controller
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

class Application extends \eduTrac\Classes\Core\Controller {

	public function __construct() {
		parent::__construct();
        if(!hasPermission('access_application_screen')) { redirect( BASE_URL . 'dashboard/' ); }
	}
	
	public function index() {
		$this->view->staticTitle = array('Search Applications');
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
		$this->view->render('application/index');
	}
    
    public function add($id) {
        if(!hasPermission('create_application')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array('Add Application');
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
        $this->view->address = $this->model->address($id);
        
        if(empty($this->view->person)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        $this->view->render('application/add');
    }
    
    public function view($id) {
        if(!hasPermission('create_application')) { redirect( BASE_URL . 'dashboard/' ); }
        $this->view->staticTitle = array('View Application');
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
        $this->view->appl = $this->model->appl($id);
        $this->view->applAddr = $this->model->applAddr($id);
        $this->view->inst = $this->model->inst($id);
        
        if(empty($this->view->appl)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('application/view');
    }
    
    public function runApplication() {
        if(!hasPermission('create_application')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = [];
        $data['acadProgID'] = isPostSet('acadProgID');
        $data['startTerm'] = isPostSet('startTerm');
        $data['admitStatus'] = isPostSet('admitStatus');
        $data['PSAT_Verbal'] = isPostSet('PSAT_Verbal');
        $data['PSAT_Math'] = isPostSet('PSAT_Math');
        $data['SAT_Verbal'] = isPostSet('SAT_Verbal');
        $data['SAT_Math'] = isPostSet('SAT_Math');
        $data['ACT_English'] = isPostSet('ACT_English');
        $data['ACT_Math'] = isPostSet('ACT_Math');
        $data['instID'] = isPostSet('instID');
        $data['fromDate'] = isPostSet('fromDate');
        $data['toDate'] = isPostSet('toDate');
        $data['GPA'] = isPostSet('GPA');
        $data['personID'] = isPostSet('personID');
        $this->model->runApplication($data);
    }
    
    public function runEditApplication() {
        if(!hasPermission('create_application')) { redirect( BASE_URL . 'dashboard/' ); }
        $data = [];
        $data['acadProgID'] = isPostSet('acadProgID');
        $data['startTerm'] = isPostSet('startTerm');
        $data['admitStatus'] = isPostSet('admitStatus');
        $data['PSAT_Verbal'] = isPostSet('PSAT_Verbal');
        $data['PSAT_Math'] = isPostSet('PSAT_Math');
        $data['SAT_Verbal'] = isPostSet('SAT_Verbal');
        $data['SAT_Math'] = isPostSet('SAT_Math');
        $data['ACT_English'] = isPostSet('ACT_English');
        $data['ACT_Math'] = isPostSet('ACT_Math');
        $data['instID'] = isPostSet('instID');
        $data['fromDate'] = isPostSet('fromDate');
        $data['toDate'] = isPostSet('toDate');
        $data['GPA'] = isPostSet('GPA');
        $data['personID'] = isPostSet('personID');
        $data['applID'] = isPostSet('applID');
        $data['instAttID'] = isPostSet('instAttID');
        $this->model->runEditApplication($data);
    }
    
    public function search() {
        $this->model->search();
    }
        
}