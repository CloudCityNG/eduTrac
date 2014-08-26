<?php
/**
 * eduTrac API Main File
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

/**
 * These are already defined, so please do not edit these. 
 * They are only here to suppress errors that may occur with 
 * including the main constants.php file.
 */
defined( 'DS' )                 or define( 'DS', '' );
defined( 'BASE_PATH' )          or define( 'BASE_PATH', '' );
defined( 'APP_FOLDER' )         or define( 'APP_FOLDER', '' );
defined( 'SYS_PATH' )           or define( 'SYS_PATH', '' );
defined( 'APP_PATH' )           or define( 'APP_PATH', '' );
defined( 'LOCALE_DIR' )         or define( 'LOCALE_DIR', '' );
defined( 'DROPINS' )            or define( 'DROPINS', '' );
defined( 'DEFAULT_LOCALE' )     or define( 'DEFAULT_LOCALE', '' );
defined( 'ENCODING' )           or define( 'ENCODING', '' );
defined( 'CURRENT_VERSION' )    or define( 'CURRENT_VERSION', '' );
defined( 'CURRENT_EG_VERSION' ) or define( 'CURRENT_EG_VERSION', '' );

include dirname( __FILE__ ) . '/includes/compatibility.php';
include dirname( __FILE__ ) . '/includes/functions.php';
include dirname( __FILE__ ) . '/includes/class.db-api.php';
include dirname( __FILE__ ) . '/config.php';

if (!isset($_GET['auth_token']) || ($_GET['auth_token'] != AUTH_TOKEN)) {
   die('Authentication is required to access the API.');
}

$query = $db_api->parse_query();
$db_api->set_db( $query['db'] );
$results = $db_api->query( $query );

$renderer = 'render_' . $query['format'];
$db_api->$renderer( $results, $query );
