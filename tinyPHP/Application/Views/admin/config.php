<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * System Settings View
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
	<li><?php _e( _t( 'You are here' ) ); ?></li>
	<li><a href="<?php BASE_URL; ?>admin/" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><?php _e( _t( 'System Settings' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'System Settings' ) ); ?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?php echo BASE_URL; ?>admin/runConfig/" id="validateSubmitForm" method="post" autocomplete="off">
		
		<!-- Widget -->
		<div class="widget widget-heading-simple widget-body-gray">
		
			<!-- Widget heading -->
			<div class="widget-head">
				<h4 class="heading"><font color="red">*</font> <?php _e( _t( 'Indicates field is required' ) ); ?></h4>
			</div>
			<!-- // Widget heading END -->
			
			<div class="widget-body">
			
				<!-- Row -->
				<div class="row-fluid">
					<!-- Column -->
					<div class="span6">
					
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><font color="red">*</font> <?php _e( _t( 'District Name' ) ); ?></label>
							<div class="controls">
								<input type="text" name="district_name" value="<?php echo clean(Hooks::get_option('district_name')); ?>" class="span10" required />
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><font color="red">*</font> <?php _e( _t( 'Site Title' ) ); ?></label>
							<div class="controls">
								<input type="text" name="site_title" value="<?php echo clean(Hooks::get_option('site_title')); ?>" class="span10" required />
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><font color="red">*</font> <?php _e( _t( 'Admin Email' ) ); ?></label>
							<div class="controls">
								<input type="text" name="admin_email" value="<?php echo clean(Hooks::get_option('admin_email')); ?>" class="span10" required />
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><?php _e( _t( 'Admin Help Desk URL' ) ); ?></label>
							<div class="controls">
								<input type="text" name="administrator_help_desk_url" value="<?php echo Hooks::get_option('administrator_help_desk_url'); ?>" class="span10" />
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><?php _e( _t( 'Faculty Help Desk URL' ) ); ?></label>
							<div class="controls">
								<input type="text" name="faculty_help_desk_url" value="<?php echo clean(Hooks::get_option('faculty_help_desk_url')); ?>" class="span10" />
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><?php _e( _t( 'Parent Help Desk URL' ) ); ?></label>
							<div class="controls">
								<input type="text" name="parent_help_desk_url" value="<?php echo clean(Hooks::get_option('parent_help_desk_url')); ?>" class="span10" />
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><?php _e( _t( 'Local Subnet' ) ); ?></label>
							<div class="controls">
								<input type="text" name="local_subnet" value="<?php echo clean(Hooks::get_option('local_subnet')); ?>" class="span10" />
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><?php _e( _t( 'Enable SSL' ) ); ?></label>
							<div class="controls">
								<select class="span12" name="enable_ssl">
                            		<option value="1"<?php echo selected( clean(Hooks::get_option( 'enable_ssl' )), '1', false ); ?>><?php _e( _t( "Yes" ) ); ?></option>
                            		<option value="0"<?php echo selected( clean(Hooks::get_option( 'enable_ssl' )), '0', false ); ?>><?php _e( _t( "No" ) ); ?></option>
                            	</select>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><?php _e( _t( 'Auto Generate Student ID\'s' ) ); ?></label>
							<div class="controls">
								<select class="span12" name="generate_student_ids">
            						<option value="1"<?php echo selected( clean(Hooks::get_option( 'generate_student_ids' )), '1', false ); ?>><?php _e( _t( "Yes" ) ); ?></option>
            						<option value="0"<?php echo selected( clean(Hooks::get_option( 'generate_student_ids' )), '0', false ); ?>><?php _e( _t( "No" ) ); ?></option>
            					</select>
							</div>
						</div>
						<!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
					<!-- Column -->
					<div class="span6">
					
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><?php _e( _t( 'Faculty Dashboard News Feed' ) ); ?></label>
							<div class="controls">
								<input type="text" name="faculty_news_feed" value="<?php echo clean(Hooks::get_option('faculty_news_feed')); ?>" class="span10" />
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><?php _e( _t( 'Admin Dashboard News Feed' ) ); ?></label>
							<div class="controls">
								<input type="text" name="admin_news_feed" value="<?php echo clean(Hooks::get_option('admin_news_feed')); ?>" class="span10" />
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><?php _e( _t( 'Student Center Availability' ) ); ?></label>
							<div class="controls">
								<select class="span12" name="student_center_availability">
            						<option value="1"<?php echo selected( clean(Hooks::get_option( 'student_center_availability' )), '1', false ); ?>><?php _e( _t( "Online" ) ); ?></option>
            						<option value="0"<?php echo selected( clean(Hooks::get_option( 'student_center_availability' )), '0', false ); ?>><?php _e( _t( "Offline" ) ); ?></option>
								</select>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><?php _e( _t( 'Parent Center Availability' ) ); ?></label>
							<div class="controls">
								<select class="span12" name="parent_center_availability">
            						<option value="1"<?php echo selected( clean(Hooks::get_option( 'parent_center_availability' )), '1', false ); ?>><?php _e( _t( "Online" ) ); ?></option>
            						<option value="0"<?php echo selected( clean(Hooks::get_option( 'parent_center_availability' )), '0', false ); ?>><?php _e( _t( "Offline" ) ); ?></option>
								</select>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><?php _e( _t( 'Faculty Center Availability' ) ); ?></label>
							<div class="controls">
								<select class="span12" name="faculty_center_availability">
            						<option value="1"<?php echo selected( clean(Hooks::get_option( 'faculty_center_availability' )), '1', false ); ?>><?php _e( _t( "Online" ) ); ?></option>
            						<option value="0"<?php echo selected( clean(Hooks::get_option( 'faculty_center_availability' )), '0', false ); ?>><?php _e( _t( "Offline" ) ); ?></option>
								</select>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><?php _e( _t( 'Parent Can Self Register' ) ); ?></label>
							<div class="controls">
								<select class="span12" name="parent_self_register">
            						<option value="1"<?php echo selected( clean(Hooks::get_option( 'parent_self_register' )), '1', false ); ?>><?php _e( _t( "Enable" ) ); ?></option>
            						<option value="0"<?php echo selected( clean(Hooks::get_option( 'parent_self_register' )), '0', false ); ?>><?php _e( _t( "Disable" ) ); ?></option>
								</select>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><?php _e( _t( 'Cookie TTL' ) ); ?></label>
							<div class="controls">
								<input type="text" name="cookieexpire" value="<?php echo clean(Hooks::get_option('cookieexpire')); ?>" class="input-small" />
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><?php _e( _t( 'Cookie Path' ) ); ?></label>
							<div class="controls">
								<input type="text" name="cookiepath" value="<?php echo clean(Hooks::get_option('cookiepath')); ?>" class="input-small" />
							</div>
						</div>
						<!-- // Group END -->
						
					</div>
					<!-- // Column END -->
				</div>
				<!-- // Row END -->
			
				<hr class="separator" />
				
				<!-- Form actions -->
				<div class="form-actions">
					<button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?php _e( _t( 'Save' ) ); ?></button>
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