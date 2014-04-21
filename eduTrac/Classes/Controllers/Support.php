<?php namespace eduTrac\Classes\Controllers;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Support Controller
 *  
 * PHP 5.4+
 *
 * eduTrac(tm) : Student Information System (http://www.7mediaws.org/)
 * @copyright (c) 2013 7 Media Web Solutions, LLC
 * 
 * @license     http://edutrac.7mediaws.org/general/edutrac_erp_commercial_license/ Commercial License
 * @link        http://www.7mediaws.org/
 * @since       3.0.0
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */

class Support extends \eduTrac\Classes\Core\Controller {
    
    private $_auth;

	public function __construct() {
		parent::__construct();
        $this->_auth = new \eduTrac\Classes\Libraries\Cookies();
        if(!$this->_auth->isUserLoggedIn()) { redirect( BASE_URL ); }
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
		$this->view->staticTitle = array(_t('Online Documentation'));
		$this->view->render('support/index');
	}
	
}