<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * Manage Permissions View
 *  
 * PHP 5
 *
 * eGrades(tm) : Online Grading System (http://egrades.org/)
 * Copyright 2013, 7 Media Web Solutions, LLC (http://www.7mediaws.org/)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2013, 7 Media Web Solutions, LLC (http://www.7mediaws.org/)
 * @link http://egrades.org/ eGrades(tm) Project
 * @since eGrades(tm) v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

use \tinyPHP\Classes\Libraries\Hooks;

?>

<ul class="breadcrumb">
	<li><?php _e( _t( 'You are here') ); ?></li>
	<li><a href="<?php echo BASE_URL; ?>admin/" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
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
						<th class="center"><?php _e( _t( 'Name' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Description' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Version' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Author Site' ) ); ?></th>
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
						echo '<tr>'."\n";
					else
						echo '<tr class="separated">'."\n";
									
					// Display the plugin information
					echo '<td class="center">'.$plugin['Name'].'</td>'."\n";
					echo '<td>'.$plugin['Description'].'</td>'."\n";
					echo '<td class="center">'.$plugin['Version'].'</td>'."\n";
					echo '<td class="center"><a href="'.$plugin['AuthorURI'].'" title="'.$plugin['Author'].'\'s Website" class="btn btn-circle"><i class="icon-external-link"></i></a></td>'."\n";
					
						if(Hooks::is_plugin_activated($plugin['filename']) == true) {
							echo '<td class="center"><a class="activated" href="'.BASE_URL.'admin/plugins/deactivate/?id='.urlencode($plugin['filename']).'">Deactivate</a></td>';
						} else {
							echo '<td class="center"><a href="'.BASE_URL.'admin/plugins/activate/?id='.urlencode($plugin['filename']).'">Activate</a></td>';
						}
						
						echo '</tr>'."\n";
				} ?>
				</tbody>
				<!-- // Table body END -->
				
			</table>
			<!-- // Table END -->
			
		</div>
	</div>
	<div class="separator bottom"></div>
	<!-- // Widget END -->
	
</div>	
	
		
		</div>
		<!-- // Content END -->