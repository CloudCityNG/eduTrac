<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Manage Person Permissions View
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

use \eduTrac\Classes\Libraries\ACL as ACL;

?>

<ul class="breadcrumb">
	<li><?php _e( _t( 'You are here') ); ?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><a href="<?=BASE_URL;?>person/<?=bm();?>" class="glyphicons search"><i></i> <?php _e( _t( 'Search Person' ) ); ?></a></li>
	<li class="divider"></li>
	<li><?php _e( _t( 'Manage Person Permissions' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Manage Permissions for -' ) ); ?> <?=get_name(_h($this->perms[0]['personID']));?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>person/runRolePerm/" id="validateSubmitForm" method="post" autocomplete="off">
		
		<!-- Widget -->
		<div class="widget widget-heading-simple widget-body-gray">
			
			<div class="widget-body">
						
				<!-- Table -->
				<table class="dynamicTable tableTools table table-striped table-bordered table-condensed table-white">
				
					<!-- Table heading -->
					<thead>
						<tr>
							<th><?php _e( _t( 'Permission' ) ); ?></th>
							<th><?php _e( _t( 'Status' ) ); ?></th>
						</tr>
					</thead>
					<!-- // Table heading END -->
				
					<!-- Table body -->
					<tbody>
						<?php 
						$permACL = new ACL(_h($this->perms[0]['personID']));
							$rPerms = $permACL->perms;
						    $aPerms = $permACL->getAllPerms('full');
							foreach ($aPerms as $k => $v) {
								echo '<tr><td>'._h($v['Name']).'</td>';
								
								echo '<td class="center"><select name="perm_' . _h($v['ID']) . '">';
								echo '<option value="1"';
									if ($permACL->hasPermission(_h($v['Key'])) && $rPerms[_h($v['Key'])]['inheritted'] != true) { echo ' selected="selected"'; }
										echo '>Allow</option>';
										echo '<option value="0"';
									if ($rPerms[_h($v['Key'])]['value'] === false && $rPerms[_h($v['Key'])]['inheritted'] != true) { echo ' selected="selected"'; }
										echo '>Deny</option>';
										echo '<option value="x"';
									if ($rPerms[_h($v['Key'])]['inheritted'] == true || !array_key_exists(_h($v['Key']),$rPerms)) {
										echo ' selected="selected"';
										if ($rPerms[_h($v['Key'])]['value'] === true ) {
											$iVal = '(Allow)';
										} else {
											$iVal = '(Deny)';
										}
									}
								echo '>Inherit ' . $iVal . '</option>';
		            			echo '</select></td></tr>';
							}
						?>
					</tbody>
					<!-- // Table body END -->
		
			</table>
			<!-- // Table END -->
			
				<hr class="separator" />
				
				<!-- Form actions -->
				<div class="form-actions">
					<input type="hidden" name="action" value="savePerms" />
					<input type="hidden" name="personID" value="<?=_h($this->perms[0]['personID']);?>" />
					<button type="submit" name="Submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?php _e( _t( 'Save' ) ); ?></button>
				</div>
				<!-- // Form actions END -->
				
			</div>
		</div>
		<!-- // Widget END -->
		
	</form>
	<!-- // Form END -->
	
</div>	
	
		
		</div>
		<!-- // Content END -->