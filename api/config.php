<?php
/**
 * eduTrac API Config File
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

require("../eduTrac/Config/constants.php");
$args = array( 
            'name' => DB_NAME,
            'username' => DB_USER,
            'password' => DB_PASS,
            'server' => 'localhost',
            'port' => 3306,
            'type' => 'mysql',
            'table_blacklist' => array(
                                        'nslc_hold_file','activity_log',
                                        'error','cronjob','cronlog',
                                        'email_template','nslc_setup',
                                        'et_option','plugin','saved_query'
                                      ),
            'column_blacklist' => array('auth_token','ssn'),
);

register_db_api( 'erp', $args );