<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Manage Roles View
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

use \eduTrac\Classes\Libraries\ACL as ACL;
$roles = new ACL();

?>

<ul class="breadcrumb">
	<li><?=_t( 'You are here');?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?=_t( 'Dashboard' );?></a></li>
	<li class="divider"></li>
	<li><?=_t( 'Manage Roles' );?></li>
</ul>

<h3><?=_t( 'Manage Roles' );?></h3>
<div class="innerLR">

	<!-- Widget -->
	<div class="widget widget-heading-simple widget-body-gray">
		<div class="widget-body">
		
			<!-- Table -->
			<table class="dynamicTable tableTools table table-striped table-bordered table-condensed table-white">
			
				<!-- Table heading -->
				<thead>
					<tr>
						<th class="text-center"><?=_t( 'ID' );?></th>
						<th class="text-center"><?=_t( 'Name' );?></th>
						<th class="text-center"><?=_t( 'Edit' );?></th>
					</tr>
				</thead>
				<!-- // Table heading END -->
				
				<!-- Table body -->
				<tbody>
				<?php 
					$listRoles = $roles->getAllRoles('full');
					if($listRoles != '') {
						foreach ($listRoles as $k => $v) {
							echo '<tr class="gradeX">'."\n";
							echo '<td>'._h($v['ID']).'</td>'."\n";
							echo '<td>'._h($v['Name']).'</td>'."\n";
							echo '<td class="text-center"><a href="'.BASE_URL.'role/view/?roleID='._h($v['ID']).'" title="View Role" class="btn btn-default"><i class="fa fa-edit"></i></a></td>';
							echo '</tr>';
						}
					}
					
					/*if (count($listRoles) < 1) {
					_e( "No roles yet.<br />" );
					}*/
				?>
					
				</tbody>
				<!-- // Table body END -->
				
			</table>
			<!-- // Table END -->
			
		</div>
	</div>
	<div class="separator bottom"></div>
	<!-- // Widget END -->
	
	<!-- Form actions -->
	<div class="form-actions">
		<button type="submit" name="NewRole" class="btn btn-icon btn-primary glyphicons circle_ok" onclick="window.location='<?=BASE_URL;?>role/add/<?=bm();?>'"><i></i><?=_t( 'New Role' );?></button>
	</div>
	<!-- // Form actions END -->
	
</div>	
	
		
		</div>
		<!-- // Content END -->