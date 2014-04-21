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
 * @since       3.0.0
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */

class Cron extends \eduTrac\Classes\Core\Controller {
	
    private $_log;

	public function __construct() {
		parent::__construct();
        $this->_log = new \eduTrac\Classes\Libraries\Log();
        if(!hasPermission('access_cronjob_screen')) { redirect( BASE_URL . 'dashboard/' ); }
		/**
		 * If user is logged in and the lockscreen cookie is set, 
		 * redirect user to the lock screen until he/she enters 
		 * his/her password to gain access.
		 */
		if(isset($_COOKIE['SCREENLOCK'])) {
			redirect( BASE_URL . 'lock/' );
		}
	}
	
	public function index() {
		$this->view->staticTitle = array(_t('Cron Jobs'));							
		$this->view->less = [ 'less/admin/module.admin.page.form_elements.less','less/admin/module.admin.page.tables.less' ];
		$this->view->css = [ 'css/admin/module.admin.page.form_elements.min.css','css/admin/module.admin.page.tables.min.css' ];
        $this->view->js = [ 
                            'components/modules/admin/forms/elements/bootstrap-select/assets/lib/js/bootstrap-select.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-select/assets/custom/js/bootstrap-select.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/lib/js/select2.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/custom/js/select2.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/lib/js/bootstrap-datepicker.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/custom/js/bootstrap-datepicker.init.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/lib/js/jquery.dataTables.min.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/lib/extras/TableTools/media/js/TableTools.min.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/custom/js/DT_bootstrap.js?v=v2.1.0',
                            'components/modules/admin/tables/datatables/assets/custom/js/datatables.init.js?v=v2.1.0'
                            ];
        $this->view->cronList = $this->model->cronList();
		$this->view->render('cron/index');
	}
    
    public function add() {
        $this->view->staticTitle = array(_t('Add Cron Job'));
        $this->view->render('cron/add');
    }
    
    public function view($id) {
        $this->view->staticTitle = array(_t('View Cron Job'));
        $this->view->cron = $this->model->cron($id);
        $this->view->less = [ 'less/admin/module.admin.page.form_elements.less' ];
		$this->view->css = [ 'css/admin/module.admin.page.form_elements.min.css' ];
        $this->view->js = [ 
                            'components/modules/admin/forms/elements/bootstrap-select/assets/lib/js/bootstrap-select.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-select/assets/custom/js/bootstrap-select.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/lib/js/select2.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/select2/assets/custom/js/select2.init.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/lib/js/bootstrap-datepicker.js?v=v2.1.0',
                            'components/modules/admin/forms/elements/bootstrap-datepicker/assets/custom/js/bootstrap-datepicker.init.js?v=v2.1.0'
                            ];
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
    
    public function runEmailHold() {
        $this->model->runEmailHold();
    }
    
    public function runEmailQueue() {
        $this->model->runEmailQueue();
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
    
    public function purgeEmailHold() {
        $this->model->purgeEmailHold();
    }
    
    public function purgeEmailQueue() {
        $this->model->purgeEmailQueue();
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