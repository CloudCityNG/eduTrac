<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * Add Role View
 *  
 * PHP 5
 *
 * eduTrac(tm) : Student Information System (http://edutrac.org/)
 * Copyright 2013, eduTrac, LLC (http://edutrac.org/)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2013, eduTrac, LLC (http://edutrac.org/)
 * @link http://edutrac.org/ eduTrac(tm) Project
 * @since eduTrac(tm) v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

use \eduTrac\Classes\Libraries\ACL as ACL;
$cRole = new ACL();

?>

<ul class="breadcrumb">
	<li><?php _e( _t( 'You are here') ); ?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><a href="<?=BASE_URL;?>role/<?=bm();?>" class="glyphicons rotation_lock"><i></i> <?php _e( _t( 'Manage Roles' ) ); ?></a></li>
	<li class="divider"></li>
	<li><?php _e( _t( 'Add Role' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Add Role' ) ); ?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>role/editSaveRole/" id="validateSubmitForm" method="post" autocomplete="off">
		
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
							<div class="controls"><input class="span12" id="roleName" name="roleName" type="text" required /></div>
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
									$rPerms = $cRole->getRolePerms(isGetSet('roleID'));
        							$aPerms = $cRole->getAllPerms('full');
        							foreach ($aPerms as $k => $v) {
        								echo '<tr><td>'._h($v['Name']).'</td>';
										
										echo "<td class=\"center\"><input type=\"radio\" class=\"radio\" name=\"perm_" . _h($v['ID']) . "\" id=\"perm_" . _h($v['ID']) . "_1\" value=\"1\"";
                						if ($rPerms[_h($v['Key'])]['value'] === true && isGetSet('roleID') != '') { echo " checked=\"checked\""; }
                						echo " /></td>";
										 
										echo "<td class=\"center\"><input type=\"radio\" class=\"radio\" name=\"perm_" . _h($v['ID']) . "\" id=\"perm_" . _h($v['ID']) . "_0\" value=\"0\"";
                						if ($rPerms[_h($v['Key'])]['value'] != true && isGetSet('roleID') != '') { echo " checked=\"checked\""; }
                						echo " /></td>";
										
										echo "<td class=\"center\"><input type=\"radio\" class=\"radio\" name=\"perm_" . _h($v['ID']) . "\" id=\"perm_" . _h($v['ID']) . "_X\" value=\"X\"";
                						if (isGetSet('roleID') == '' || !array_key_exists(_h($v['Key']),$rPerms)) { echo " checked=\"checked\""; }
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