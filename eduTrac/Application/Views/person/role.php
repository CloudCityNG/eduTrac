<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Manage Person Role View
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

?>

<ul class="breadcrumb">
	<li><?=_t( 'You are here');?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?=_t( 'Dashboard' );?></a></li>
	<li class="divider"></li>
	<li><a href="<?=BASE_URL;?>person/<?=bm();?>" class="glyphicons search"><i></i> <?=_t( 'Search Person' );?></a></li>
	<li class="divider"></li>
	<li><?=_t( 'Manage Person Role' );?></li>
</ul>

<h3><?=get_name(_h($this->role[0]['personID']));?>: <?=_h($this->role[0]['personID']);?></h3>
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
							<th><?=_t( 'Role' );?></th>
							<th><?=_t( 'Member' );?></th>
							<th><?=_t( 'Not Member' );?></th>
						</tr>
					</thead>
					<!-- // Table heading END -->
				
					<!-- Table body -->
					<tbody>
						<?php 
						$roleACL = new ACL(_h((int)$this->role[0]['personID']));
							$role = $roleACL->getAllRoles('full');
							foreach ($role as $k => $v) {
								echo '<tr><td>'._h($v['Name']).'</td>';
								
								echo "<td class=\"center\"><input type=\"radio\" name=\"role_" . _h($v['ID']) . "\" id=\"role_" . _h($v['ID']) . "_1\" value=\"1\"";
    							if ($roleACL->userHasRole(_h($v['ID']))) { echo " checked=\"checked\""; }
    							echo " /></td>";
								 
								echo "<td class=\"center\"><input type=\"radio\" name=\"role_" . _h($v['ID']) . "\" id=\"role_" . _h($v['ID']) . "_0\" value=\"0\"";
    							if (!$roleACL->userHasRole(_h($v['ID']))) { echo " checked=\"checked\""; }
    							echo " /></td></tr>";
							}
						?>
					</tbody>
					<!-- // Table body END -->
		
			</table>
			<!-- // Table END -->
			
				<hr class="separator" />
				
				<!-- Form actions -->
				<div class="form-actions">
					<input type="hidden" name="action" value="saveRoles" />
					<input type="hidden" name="personID" value="<?=_h($this->role[0]['personID']);?>" />
					<button type="submit" name="Submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?=_t( 'Save' );?></button>
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