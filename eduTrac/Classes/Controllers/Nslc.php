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
 * @since       3.0.0
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */

class Nslc extends \eduTrac\Classes\Core\Controller {

	public function __construct() {
		parent::__construct();
        if(!hasPermission('access_nslc')) { redirect( BASE_URL . 'dashboard/' ); }
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
	    $this->view->staticTitle = array(_t('Search NSLC File'));
		$this->view->js = array( 
                                'plugins/datable/jquery.dataTables.min.js',
                                'plugins/datable/dataTables.bootstrap.js',
                                'plugins/datable/extras/TableTools/media/js/TableTools.min.js',
                                'js/custom.js'
                                );
        $this->view->search = $this->model->search();
        $this->view->render('nslc/index');
	}
    
    public function correction($id) {
        $this->view->staticTitle = array(_t('NSLC Correction'));
        $this->view->correct = $this->model->correct($id);
        if(empty($this->view->correct)) {
            redirect( BASE_URL . 'error/invalid_record/' );
        }
        $this->view->render('nslc/correction');
    }
	
	public function setup() {
		$this->view->staticTitle = array(_t('NSLC Setup'));
        $this->view->setup = $this->model->setup();
		$this->view->render('nslc/setup');
	}
	
	public function extraction() {
	    $this->view->staticTitle = array(_t('NSLC Extraction'));
		$this->view->render('nslc/extraction');
	}
	
	public function download() {
		$this->view->staticTitle = array(_t('Download NSLC File'));
		$this->view->render('nslc/download');
	}
    
    public function purge() {
        $this->view->staticTitle = array(_t('NSLC Purge'));
        $this->view->render('nslc/purge');
    }
    
    public function error_report() {
        $this->view->render('bh',true);
        $this->view->render('nslc/error_report',true);
        $this->view->render('bf',true);
    }
    
    public function verification() {
        $this->view->staticTitle = array(_t('NSLC Verification'));
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