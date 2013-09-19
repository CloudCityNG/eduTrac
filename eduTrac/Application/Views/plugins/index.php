<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Plugins View
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

<ul class="breadcrumb">
	<li><?php _e( _t( 'You are here' ) ); ?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><?php _e( _t( 'Plugins' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Plugins' ) ); ?></h3>
<div class="innerLR">

	<!-- Widget -->
	<div class="widget widget-heading-simple widget-body-gray">
		<div class="widget-body">
        
			<!-- Table -->
			<table class="dynamicTable tableTools table table-striped table-bordered table-condensed table-white">
			
				<!-- Table heading -->
				<thead>
					<tr>
						<th class="center"><?php _e( _t( 'Plugin' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Description' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Action' ) ); ?></th>
					</tr>
				</thead>
				<!-- // Table heading END -->
				
				<!-- Table body -->
				<tbody>
                <?php // Set our plugins dir
            		$plugins_header = Hooks::get_plugins_header(APP_PATH . 'Plugins/');
        		
        			// Let's read the content of the array
        			foreach($plugins_header as $plugin) {
        			if(Hooks::is_plugin_activated($plugin['filename']) == true)
        				echo '<tr>';
        			else
        				echo '<tr class="separated gradeX">';
        							
        			// Display the plugin information
        			echo '<td class="center">'.$plugin['Name'].'</td>';
        			echo '<td>'.$plugin['Description'];
        			echo '<br /><br />';
        			echo 'Version '.$plugin['Version'];
        			echo ' By <a href="'.$plugin['AuthorURI'].'">'.$plugin['Author']. '</a> ';
        			echo ' | <a href="' .$plugin['PluginURI'].'">Visit plugin site</a></td>';
        			
        				if(Hooks::is_plugin_activated($plugin['filename']) == true) {
        					echo '<td class="center"><a href="'.BASE_URL.'plugins/deactivate/?id='.urlencode($plugin['filename']).'" title="Deactivate" class="btn btn-circle"><i class="icon-minus-sign"></i></a></td>';
        				} else {
        					echo '<td class="center"><a href="'.BASE_URL.'plugins/activate/?id='.urlencode($plugin['filename']).'" title="Activate" class="btn btn-circle"><i class="icon-plus-sign"></i></a></td>';
        				}
        				
        				echo '</tr>';
        		} ?>
				</tbody>
				<!-- // Table body END -->
				
			</table>
			<!-- // Table END -->
			
		</div>
	</div>
	
	<!-- // Widget END -->
	
</div>	
	
		
		</div>
		<!-- // Content END -->