<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Upgrade View
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

use \eduTrac\Classes\Libraries\Hooks;
use \eduTrac\Classes\Core\DB;
$file = BASE_PATH . 'eduTrac/Application/Views/upgrade/sql/'.Hooks::get_option('dbversion').'.sql';
?>

<div class="innerLR errorView">
	
	<!-- Widget -->
	<div class="widget widget-heading-simple widget-body-gray">
		
		<div class="widget-body">
			
				<!-- Row -->
				<div class="row-fluid">

                    <?php if(Hooks::get_option('dbversion') < upgradeDB(0)) { ?>
					<!-- Alert -->
					<div class="alert alert-primary center">
						<strong><?php _e( _t( 'Warning!' ) ); ?></strong> <?php _e( _t( 'Hey admin, your database is out of date and currently at 
                        version ' . Hooks::get_option('dbversion') . ' Click the button below to upgrade your database. 
                        When the upgrade is complete, <a href="'.BASE_URL.'dashboard/"><font color="orange">click here</font></a> to return to the dashboard. 
                        If you are behind on a few versions, you may be redirected to this page again until the system is fully up to date.' ) ); ?>
					</div>
					<!-- // Alert END -->
                    <!-- Form -->
                        <form class="form-horizontal margin-none" action="<?=BASE_URL;?>upgrade/" id="validateSubmitForm" method="post">
                            <input type="hidden" name="upgradeDB" value="1" />
                            <button type="submit" name="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><? _e( _t( 'Submit' ) ); ?></button>
                        </form>
                    <!-- // Form END -->
                    
                    <?php } else { ?>
                    
                    <!-- Alert -->
    				<div class="alert alert-success center">
						<strong><?php _e( _t( 'Hey admin, you database is currently up to date. There is nothing else here to see. 
                        <a href="'.BASE_URL.'dashboard/"><font color="orange">Click here</font></a> to return to the dashboard.' ) ); ?>
					</div>
					<!-- // Alert END -->
                    
                    <?php } ?>
                    
                    <?php
                        if(isPostSet('upgradeDB') == 1) {
                            upgradeSQL($file);
                        }
                    ?>
			
				</div>
		
		</div>
	
	</div>
	
</div>	
	
		
		</div>
		<!-- // Content END -->