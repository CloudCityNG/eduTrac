<?php namespace eduTrac\Classes\Models;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Install Model
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

use \eduTrac\Classes\Core\Session;
class InstallModel {
    
    private $_now;
    private $_dbhost;
    private $_dbuser;
    private $_dbpass;
    private $_dbname;
    private $_connect;
    private $_error;
    private $_product = 'eduTrac ERP';
    private $_company = '7 Media Web Solutions, LLC';
    private $_version = '4.1.5';
    
    public function __construct() {
    	Session::init();
    	$this->_now = date('Y-m-d h:m:s');
		$this->_dbhost = Session::get('dbhost');
        $this->_dbuser = Session::get('dbuser');
        $this->_dbpass = Session::get('dbpass');
        $this->_dbname = Session::get('dbname');
		
		try {
            $this->_connect = new \PDO("mysql:host=$this->_dbhost;dbname=$this->_dbname", $this->_dbuser, $this->_dbpass);
            $this->_connect->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->_connect->prepare('SET NAMES utf8');
            $this->_connect->prepare('SET CHARACTER SET utf8');
        } catch(\PDOException $e) {
            $this->_error = 'ERROR: ' . $e->getMessage();
            return $this->_error;
        }
    }
	
	public function runCheckDB() {
		$_SESSION['error_message'] = [];
		if(!$this->_connect) {
			$_SESSION['error_message'][] = _t( 'Unable to establish a database connection.' );
			redirect(Session::get('installurl') . 'install/?step=3');
		} else {
			redirect(Session::get('installurl') . 'install/?step=4');
		}
	}
	
	public function runInstallData() {
		$_SESSION['error_message'] = [];
		if($this->_connect) {
			set_time_limit(0);
			$q = file_get_contents(SYS_PATH . 'Application/Views/install/data/install.sql');
			$this->_connect->exec($q);
			redirect(Session::get('installurl') . 'install/?step=5');
		} else {
			$_SESSION['error_message'][] = _t( 'Unable to establish a database connection.' );
			redirect(Session::get('installurl') . 'install/?step=3');
		}
	}
	
	public function runInstallAdmin() {
		if($this->_connect) {
		/**
		 * Set two minutes to install the database.
		 * If it takes longer than two minutes, then 
		 * something is wrong.
		 */
		set_time_limit(0);
			
        $sql = [];
        
        $sql[] = "INSERT INTO `person` (`personID`, `uname`, `password`, `fname`, `lname`, `email`,`personType`,`approvedDate`,`approvedBy`) VALUES ('', '".Session::get('uname')."', '".Session::get('password')."', '".Session::get('fname')."', '".Session::get('lname')."', '".Session::get('email')."', 'STA', '".$this->_now."', '1');";
		
		$sql[] = "INSERT INTO `person_roles` VALUES(1, 1, 8, '".$this->_now."');";
		
		$sql[] = "INSERT INTO `staff` VALUES(1, 1, 'NULL', 'NULL', 'NULL', '', 'NULL', 'A', '".$this->_now."', 1, '".$this->_now."');";
		
		$sql[] = "INSERT INTO `address` VALUES(00000000001, 00000001, '10 Eliot Street', '#2', 'Somerville', 'MA', '02143', 'US', 'P', '".$this->_now."', '0000-00-00', 'C', '6718997836', '', '', '', 'CEL', '', 'support@edutrac.org', '', '".$this->_now."', 00000001, '".$this->_now."');";
		
		$sql[] = "INSERT INTO `job` VALUES(1, 1, 'IT Support', '34.00', 40, NULL, '".$this->_now."', 00000001, '".$this->_now."');";
		
		$sql[] = "INSERT INTO `staff_meta` VALUES(1, 'FT', 1, 00000001, 00000001, 'STA', '2011-02-01', '2011-02-01', NULL, '".$this->_now."', 00000001, '".$this->_now."');";
                  
        $sql[] = "INSERT INTO `et_option` VALUES(1, 'dbversion', '00030');";
        
        $sql[] = "INSERT INTO `et_option` VALUES(2, 'system_email', '".Session::get('email')."');";
        
        $sql[] = "INSERT INTO `et_option` VALUES(3, 'enable_ssl', '0');";
        
        $sql[] = "INSERT INTO `et_option` VALUES(4, 'site_title', '".Session::get('sitetitle')."');";
        
        $sql[] = "INSERT INTO `et_option` VALUES(5, 'cookieexpire', '604800');";
        
        $sql[] = "INSERT INTO `et_option` VALUES(6, 'cookiepath', '/');";
        
        $sql[] = "INSERT INTO `et_option` VALUES(7, 'hold_file_loc', '/Applications/MAMP/_HOLD_/');";
        
        $sql[] = "INSERT INTO `et_option` VALUES(8, 'enable_benchmark', '0');";
        
        $sql[] = "INSERT INTO `et_option` VALUES(9, 'maintenance_mode', '0');";
        
        $sql[] = "INSERT INTO `et_option` VALUES(10, 'enable_cron_log', '0');";
        
        $sql[] = "INSERT INTO `et_option` VALUES(11, 'current_term_code', '');";
        
        $sql[] = "INSERT INTO `et_option` VALUES(12, 'hour_display', '12');";
        
        $sql[] = "INSERT INTO `et_option` VALUES(13, 'limit_query_size', '30');";
        
        $sql[] = "INSERT INTO `et_option` VALUES(14, 'week_start', '0');";
        
        $sql[] = "INSERT INTO `et_option` VALUES(15, 'startTime', '08:00 AM');";
        
        $sql[] = "INSERT INTO `et_option` VALUES(16, 'endTime', '05:00 PM');";
        
        $sql[] = "INSERT INTO `et_option` VALUES(17, 'bullets_display', '0');";
        
        $sql[] = "INSERT INTO `et_option` VALUES(18, 'enable_reserve_email', '1');";
        
        $sql[] = "INSERT INTO `et_option` VALUES(19, 'reserve_from_email', 'test@gmail.com');";
        
        $sql[] = "INSERT INTO `et_option` VALUES(20, 'reserve_reply_email', '');";
        
        $sql[] = "INSERT INTO `et_option` VALUES(21, 'open_registration', '1');";
        
        $sql[] = "INSERT INTO `et_option` VALUES(22, 'help_desk', 'http://www.7mediaws.org/client/');";
        
        $sql[] = "INSERT INTO `et_option` VALUES(23, 'enable_cron_jobs', 0);";
        
        $sql[] = "INSERT INTO `et_option` VALUES(24, 'reset_password_text', '<b>eduTrac Password Reset</b><br>Password &amp; Login Information<br><br>You or someone else requested a new password to the eduTrac online system. If you did not request this change, please contact the administrator as soon as possible @ #adminemail#.&nbsp; To log into the eduTrac system, please visit #url# and login with your username and password.<br><br>FULL NAME:&nbsp; #fname# #lname#<br>USERNAME:&nbsp; #uname#<br>PASSWORD:&nbsp; #password#<br><br>If you need further assistance, please read the documentation at #helpdesk#.<br><br>KEEP THIS IN A SAFE AND SECURE LOCATION.<br><br>Thank You,<br>eduTrac Web Team<br>');";
        
        $sql[] = "INSERT INTO `cronjob` VALUES(1, '".Session::get('siteurl')."cron/activityLog/', 'Purge Activity Log', NULL, 0, 0, 0, 0);";
        
        $sql[] = "INSERT INTO `cronjob` VALUES(2, '".Session::get('siteurl')."cron/runStuTerms/', 'Create Student Terms Record', NULL, 0, 0, 0, 0);";
        
        $sql[] = "INSERT INTO `cronjob` VALUES(3, '".Session::get('siteurl')."cron/runStuLoad/', 'Create Student Load Record', NULL, 0, 0, 0, 0);";
        
        $sql[] = "INSERT INTO `cronjob` VALUES(4, '".Session::get('siteurl')."cron/updateStuTerms/', 'Update Student Terms', NULL, 0, 0, 0, 0);";
        
        $sql[] = "INSERT INTO `cronjob` VALUES(5, '".Session::get('siteurl')."cron/updateStuLoad/', 'Update Student Load', NULL, 0, 0, 0, 0);";
        
        $sql[] = "INSERT INTO `cronjob` VALUES(6, '".Session::get('siteurl')."cron/runEmailHold/', 'Process Email Hold Table', NULL, 0, 0, 0, 0);";
        
        $sql[] = "INSERT INTO `cronjob` VALUES(7, '".Session::get('siteurl')."cron/runEmailQueue/', 'Process Email Queue', NULL, 0, 0, 0, 0);";
        
        $sql[] = "INSERT INTO `cronjob` VALUES(8, '".Session::get('siteurl')."cron/purgeEmailHold/', 'Purge Email Hold', NULL, 0, 0, 0, 0);";
        
        $sql[] = "INSERT INTO `cronjob` VALUES(9, '".Session::get('siteurl')."cron/purgeEmailQueue/', 'Purge Email Queue', NULL, 0, 0, 0, 0);";
        
        $sql[] = "INSERT INTO `cronjob` VALUES(10, '".Session::get('siteurl')."cron/runGraduation/', 'Process Graduation', NULL, 0, 0, 0, 0);";
        
        $sql[] = "INSERT INTO `cronjob` VALUES(11, '".Session::get('siteurl')."cron/runTermGPA/', 'Create Student Term GPA Record', NULL, 0, 0, 0, 0);";
        
        $sql[] = "INSERT INTO `cronjob` VALUES(12, '".Session::get('siteurl')."cron/updateTermGPA/', 'Update Term GPA', NULL, 0, 0, 0, 0);";
        
        $sql[] = "INSERT INTO `cronjob` VALUES(13, '".Session::get('siteurl')."cron/purgeErrorLog/', 'Purge Error Log', NULL, 0, 0, 0, 0);";
        
        $sql[] = "INSERT INTO `cronjob` VALUES(14, '".Session::get('siteurl')."cron/purgeSavedQuery/', 'Purge Saved Queries', 86400, 1380595419, 0, 0, 0);";
        
        $sql[] = "INSERT INTO `cronjob` VALUES(15, '".Session::get('siteurl')."cron/purgeCronLogs/', 'Purge Cron Logs', 86400, 1380595404, 0, 0, 0);";
        
        $sql[] = "INSERT INTO `cronjob` VALUES(16, '".Session::get('siteurl')."cron/runDBBackup/', 'Backup Database', NULL, 0, 0, 0, 0);";
        
        foreach($sql as $query) {
            $this->_connect->exec($query);
        }
		redirect(Session::get('installurl') . 'install/?step=6');
		}
    }
    
    public function runInstallFinish() {
    	/**
		 * If the constants.php file does not exist, copy the 
		 * sample file and rename it.
		 */
    	if(!file_exists(SYS_PATH . 'Config/constants.php')) {
        	copy(SYS_PATH . 'Config/constants.sample.php',SYS_PATH . 'Config/constants.php');
        }
        $file = SYS_PATH . 'Config/constants.php';
        $config = file_get_contents($file);
        
        $config = str_replace('{product}', $this->_product, $config);
        $config = str_replace('{company}', $this->_company, $config);
        $config = str_replace('{version}', $this->_version, $config);
        $config = str_replace('{datenow}', $this->_now, $config);
        $config = str_replace('{hostname}', Session::get('dbhost'), $config);
        $config = str_replace('{database}', Session::get('dbname'), $config);
        $config = str_replace('{username}', Session::get('dbuser'), $config);
        $config = str_replace('{password}', Session::get('dbpass'), $config);
        $config = str_replace('{siteurl}', Session::get('siteurl'), $config);
        $config = str_replace('{sitetitle}', Session::get('sitetitle'), $config);
        
        file_put_contents($file, $config);
		
		# Close the database connection
        if ( $this->_connect )
            $this->_connect = null;
		
		# Destroy the session
        Session::destroy();
		
		# Lock the installer and redirect user to login screen
        $path = SYS_PATH . 'Config/.installer.lock';
        file_put_contents($path, "installer lock file");
    }
    
}