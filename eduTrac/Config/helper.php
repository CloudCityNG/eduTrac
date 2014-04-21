<?php if ( ! defined('BASE_PATH')) exit('No direct script access allowed');
/**
 * System Helpers
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


$apphelp = new eduTrac\Classes\Core\Extension();
$apphelp->helper(array('actions','gettext','default','system','auth','installer','filters','elfinder'));