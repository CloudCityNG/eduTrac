<?php namespace eduTrac\Classes\Controllers;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Cron Controller
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

class Cron extends \eduTrac\Classes\Core\Controller {
	
    private $_log;

	public function __construct() {
		parent::__construct();
        $this->_log = new \eduTrac\Classes\Libraries\Log();
        if(!hasPermission('access_cronjob_screen')) { redirect( BASE_URL . 'dashboard/' ); }
	}
	
	public function index() {
		$this->view->staticTitle = array('Cron Jobs');
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
        $this->view->cronList = $this->model->cronList();
		$this->view->render('cron/index');
	}
    
    public function add() {
        $this->view->staticTitle = array('Add Cron Job');
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
        $this->view->render('cron/add');
    }
    
    public function view($id) {
        $this->view->staticTitle = array('View Cron Job');
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
        $this->view->cron = $this->model->cron($id);
        
        if(empty($this->view->cron)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('cron/view');
    }
    
    public function fireCron() {
        if ( isGetSet('image') ) {
        header("Content-Type: image/gif");
        header("Content-Length: 49");
        echo pack('H*', '47494638396101000100910000000000ffffffffffff00000021f90405140002002c00000000010001000002025401003b');
        }
        $this->view->render('cron/fire_cron'); 
    }
    
    public function activityLog() {
        $this->_log->purgeLog();
    }
    
    public function runStuTerms() {
        $this->model->runStuTerms();
    }
    
    public function runStuLoad() {
        $this->model->runStuLoad();
    }
    
    public function runGraduation() {
        $this->model->runGraduation();
    }
    
    public function runTermGPA() {
        $this->model->runTermGPA();
    }
    
    public function runDBBackup() {
        $this->model->runDBBackup();
    }
    
    public function updateTermGPA() {
        $this->model->updateTermGPA();
    }
    
    public function updateStuTerms() {
        $this->model->updateStuTerms();
    }
    
    public function updateStuLoad() {
        $this->model->updateStuLoad();
    }
    
    public function purgeErrorLog() {
        $this->model->purgeErrorLog();
    }
    
    public function purgeSavedQuery() {
        $this->model->purgeSavedQuery();
    }
    
    public function purgeCronLogs() {
        $this->model->purgeCronLogs();
    }
    
    public function runEditCron() {
        $data = [];
        $data['id'] = isPostSet('id');
        $data['name'] = isPostSet('name');
        $data['scriptpath'] = isPostSet('scriptpath');
        $data['minutes'] = isPostSet('minutes');
        $data['hours'] = isPostSet('hours');
        $data['days'] = isPostSet('days');
        $data['weeks'] = isPostSet('weeks');
        $data['time_last_fired'] = isPostSet('time_last_fired');
        $data['run_only_once'] = isPostSet('run_only_once');
        $this->model->runEditCron($data);
    }
    
}