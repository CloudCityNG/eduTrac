<?php namespace eduTrac\Classes\Controllers;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * NSLC Controller
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

class Nslc extends \eduTrac\Classes\Core\Controller {

	public function __construct() {
		parent::__construct();
        if(!hasPermission('access_nslc')) { redirect( BASE_URL . 'dashboard/' ); }
	}
	
	public function index() {
	    $this->view->staticTitle = array('Search NSLC File');
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
        $this->view->render('nslc/index');
	}
    
    public function correction($id) {
        $this->view->staticTitle = array('NSLC Correction');
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
        $this->view->correct = $this->model->correct($id);
        if(empty($this->view->correct)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        $this->view->render('nslc/correction');
    }
	
	public function setup() {
		$this->view->staticTitle = array('NSLC Setup');
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
        $this->view->setup = $this->model->setup();
		$this->view->render('nslc/setup');
	}
	
	public function extraction() {
	    $this->view->staticTitle = array('NSLC Extraction');
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
		$this->view->staticTitle = array('NSLC Date Extraction');
		$this->view->render('nslc/extraction');
	}
	
	public function download() {
		$this->view->staticTitle = array('Download NSLC File');
		$this->view->render('nslc/download');
	}
    
    public function purge() {
        $this->view->staticTitle = array('NSLC Purge');
        $this->view->render('nslc/purge');
    }
    
    public function error_report() {
        $this->view->render('bh',true);
        $this->view->render('nslc/error_report',true);
        $this->view->render('bf',true);
    }
    
    public function verification() {
        $this->view->staticTitle = array('NSLC Verification');
        $this->view->render('nslc/verification');
    }
    
    public function verification_report() {
        $this->view->nslc = $this->model->nslc();
        $this->view->render('bh',true);
        $this->view->render('nslc/verification_report',true);
        $this->view->render('bf',true);
    }
    
    public function runPurge() {
        $this->model->runPurge();
    }
    
    public function runSetup() {
        $data = array();
        $data['branch'] = isPostSet('branch');
        $data['termCode'] = isPostSet('termCode');
        $data['termStartDate'] = isPostSet('termStartDate');
        $data['termEndDate'] = isPostSet('termEndDate');
        $data['ID'] = isPostSet('ID');
        $this->model->runSetup($data);
    }
    
    public function runTermLookup() {
        $data = array();
        $data['termCode'] = isPostSet('termCode');
        $this->model->runTermLookup($data);
    }
	
	public function runExtraction() {
        $data = array();
        $data['savedQueryID'] = isPostSet('savedQueryID');
		$this->model->runExtraction($data);
	}
    
    public function search() {
        $this->model->search();
    }
	
}