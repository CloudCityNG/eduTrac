<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Login View
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
?>

			<h1 class="glyphicons lock"><?php _e( _t( 'eduTrac' ) ); ?> <i></i></h1>
		
			<!-- Box -->
			<div class="widget widget-heading-simple widget-body-gray">
				
				<div class="widget-body">
				
					<!-- Form -->
					<form method="post" action="<?=BASE_URL;?>index/runLogin/" autocomplete="off">
						<label><?php _e( _t( 'Username' ) ); ?></label>
						<input type="text" class="input-block-level" name="uname" placeholder="Your Username" required /> 
						<label><?php _e( _t( 'Password' ) ); ?></label>
						<input type="password" class="input-block-level margin-none" name="password" placeholder="Your Password" required />
						<div class="separator bottom"></div> 
						<div class="row-fluid">
							<div class="span8">
								<div class="uniformjs"><label class="checkbox"><input type="checkbox" name="rememberme" /><?php _e( _t( 'Remember me' ) ); ?></label></div>
							</div>
							<div class="span4 center">
								<button class="btn btn-block btn-inverse" type="submit"><?php _e( _t( 'Sign in' ) ); ?></button>
							</div>
						</div>
					</form>
					<!-- // Form END -->
							
				</div>
			</div>
			<!-- // Box END -->
			
			<div class="innerT center">
				<p>Having troubles? <a href="<?=_h(Hooks::get_option('help_desk'));?>">Get Help</a></p>
			</div>
			
		</div>
		
	</div>