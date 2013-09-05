<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * Add Role View
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

use \tinyPHP\Classes\Libraries\ACL as ACL;
$eRole = new ACL();

?>

<ul class="breadcrumb">
	<li><?php _e( _t( 'You are here') ); ?></li>
	<li><a href="<?php echo BASE_URL; ?>admin/" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><a href="<?php echo BASE_URL; ?>admin/manage_roles/" class="glyphicons rotation_lock"><i></i> <?php _e( _t( 'Manage Roles' ) ); ?></a></li>
	<li class="divider"></li>
	<li><?php _e( _t( 'Edit Role' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Edit Role' ) ); ?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?php echo BASE_URL; ?>admin/editSaveRole/" id="validateSubmitForm" method="post" autocomplete="off">
		
		<!-- Widget -->
		<div class="widget widget-heading-simple widget-body-gray">
		
			<!-- Widget heading -->
			<div class="widget-head">
				<h4 class="heading"><font color="red">*</font> <?php _e( _t( 'Indicates field is required' ) ); ?></h4>
			</div>
			<!-- // Widget heading END -->
			
			<div class="widget-body">
					
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="roleName"><font color="red">*</font> <?php _e( _t( 'Role Name' ) ); ?></label>
							<div class="controls"><input class="span12" id="roleName" name="roleName" type="text" value="<?php _e( $eRole->getRoleNameFromID(isGetSet('roleID')) ); ?>" required /></div>
						</div>
						<!-- // Group END -->
						
						<!-- Table -->
						<table class="dynamicTable tableTools table table-striped table-bordered table-condensed table-white">
						
							<!-- Table heading -->
							<thead>
								<tr>
									<th><?php _e( _t( 'Permission' ) ); ?></th>
									<th><?php _e( _t( 'Allow' ) ); ?></th>
									<th><?php _e( _t( 'Deny' ) ); ?></th>
									<th><?php _e( _t( 'Ignore' ) ); ?></th>
								</tr>
							</thead>
							<!-- // Table heading END -->
						
							<!-- Table body -->
							<tbody>
								<?php 
									$rPerms = $eRole->getRolePerms(isGetSet('roleID'));
        							$aPerms = $eRole->getAllPerms('full');
        							foreach ($aPerms as $k => $v) {
        								echo '<tr><td>'.$v['Name'].'</td>'."\n";
										
										echo "<td class=\"center\"><input type=\"radio\" class=\"radio\" name=\"perm_" . $v['ID'] . "\" id=\"perm_" . $v['ID'] . "_1\" value=\"1\"";
                						if ($rPerms[$v['Key']]['value'] === true && isGetSet('roleID') != '') { echo " checked=\"checked\""; }
                						echo " /></td>\n";
										 
										echo "<td class=\"center\"><input type=\"radio\" class=\"radio\" name=\"perm_" . $v['ID'] . "\" id=\"perm_" . $v['ID'] . "_0\" value=\"0\"";
                						if ($rPerms[$v['Key']]['value'] != true && isGetSet('roleID') != '') { echo " checked=\"checked\""; }
                						echo " /></td>\n";
										
										echo "<td class=\"center\"><input type=\"radio\" class=\"radio\" name=\"perm_" . $v['ID'] . "\" id=\"perm_" . $v['ID'] . "_X\" value=\"X\"";
                						if (isGetSet('roleID') == '' || !array_key_exists($v['Key'],$rPerms)) { echo " checked=\"checked\""; }
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
					<input type="hidden" name="action" value="saveRole" />
					<input type="hidden" name="roleID" value="<?php echo isGetSet('roleID'); ?>" />
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