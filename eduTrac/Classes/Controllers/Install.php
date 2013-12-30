<?php namespace eduTrac\Classes\Controllers;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Install Controller
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
 * @since       1.1.3
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */

use \eduTrac\Classes\Core\Session;
class Install extends \eduTrac\Classes\Core\Controller {
    
    public function __construct() {
    	Session::init();
        parent::__construct();
        # Did we run it again?
        if(file_exists(SYS_PATH . 'Config/.installer.lock'))
        {
            redirect( BASE_URL );
        }
        
        if(isGetSet('step') === null)
        {
            redirect(Session::get('installurl') . 'install/?step=1');
        }
    }
    
    public function index() {
        $this->view->staticTitle = array('eduTrac Installer');
        $this->view->render('bh',true);
        $this->view->render('install/index',true);
        $this->view->render('bf',true);
		/**
		 * Reset error message to null to not confuse 
		 * the user.
		 */
		Session::set('error_message', null);
    }
    
    public function runInstall() {
        Session::set('dbhost',isPostSet('dbhost'));
        Session::set('dbuser',isPostSet('dbuser'));
        Session::set('dbpass',isPostSet('dbpass'));
        Session::set('dbname',isPostSet('dbname'));
		redirect(Session::get('installurl') . 'install/?step=3');
    }
	
	public function runInstallDB() {
        Session::set('sitetitle',isPostSet('sitetitle'));
        Session::set('siteurl',isPostSet('siteurl'));
        Session::set('uname',isPostSet('uname'));
        Session::set('fname',isPostSet('fname'));
        Session::set('lname',isPostSet('lname'));
        Session::set('password',et_hash_password(isPostSet('password')));
        Session::set('email',isPostSet('email'));
        $this->model->runInstallDB();
    }
	
	public function runInstallFinish() {
        $this->model->runInstallFinish();
    }
    
}