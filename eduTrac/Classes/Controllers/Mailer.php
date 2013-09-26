<?php namespace eduTrac\Classes\Controllers;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Mailer Controller
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

class Mailer extends \eduTrac\Classes\Core\Controller {

	public function __construct() {
		parent::__construct();
        if(!hasPermission('access_email_template_screen')) { redirect( BASE_URL . 'dashboard/' ); }
	}
	
	public function index() {
		$this->view->staticTitle = array('Email Templates');
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
		$this->view->cmgmtList = $this->model->cmgmtList();
		$this->view->render('mailer/index');
	}
    
    public function add() {
        $this->view->staticTitle = array('Add Email Template');
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
        $this->view->deptID = $this->model->deptID();
        $this->view->render('mailer/add');
    }
    
    public function view($id) {
        $this->view->staticTitle = array('View Email Template');
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
        $this->view->emailTemp = $this->model->emailTemp($id);
        $this->view->deptID = $this->model->deptID();
        
        if(empty($this->view->emailTemp)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        
        $this->view->render('mailer/view');
    }
    
    public function schedule() {
        $this->view->staticTitle = array('Schedule Mailer');
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
        $this->view->cmgmtList = $this->model->cmgmtList();
        $this->view->render('mailer/schedule');
    }
    
    public function queue() {
        $this->view->staticTitle = array('Email Queue');
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
        $this->view->queue = $this->model->queue();
        $this->view->render('mailer/queue');
    }
    
    public function runTemplate() {
        $data = [];
        $data['email_key'] = isPostSet('email_key');
        $data['email_name'] = isPostSet('email_name');
        $data['email_value'] = isPostSet('email_value');
        $data['deptID'] = isPostSet('deptID');
        $this->model->runTemplate($data);
    }
    
    public function runEditTemplate() {
        $data = [];
        $data['email_key'] = isPostSet('email_key');
        $data['email_name'] = isPostSet('email_name');
        $data['email_value'] = isPostSet('email_value');
        $data['deptID'] = isPostSet('deptID');
        $data['etID'] = isPostSet('etID');
        $this->model->runEditTemplate($data);
    }
    
    public function runSchedule() {
        $data = [];
        $data['personID'] = isPostSet('personID');
        $data['fromName'] = isPostSet('fromName');
        $data['fromEmail'] = isPostSet('fromEmail');
        $data['queryID'] = isPostSet('queryID');
        $data['subject'] = isPostSet('subject');
        $data['etID'] = isPostSet('etID');
        $this->model->runSchedule($data);
    }
    
    public function deleteQueue($id) {
        $this->model->deleteQueue($id);
    }
    
}