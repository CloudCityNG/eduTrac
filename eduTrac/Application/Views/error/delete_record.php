<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Delete Record Error View
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
?>

<div class="innerLR errorView">
	
	<!-- Widget -->
	<div class="widget widget-heading-simple widget-body-white">
		
		<div class="widget-body">
			
				<!-- Row -->
				<div class="row">

					<!-- Alert -->
					<div class="alerts alerts-error center">
						<strong><?=_t( 'Error!' );?></strong> <?=_t( 'Sorry but the system could not delete the record you requested. Please go back and try again. If the issue persists, contact the system administrator.' );?>
					</div>
					<!-- // Alert END -->
			
				</div>
		
		</div>
	
	</div>
	
</div>	
	
		
		</div>
		<!-- // Content END -->