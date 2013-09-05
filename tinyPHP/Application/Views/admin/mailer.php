<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * Mailer View
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

if(isset($_GET['group'])) {
    $term = strtolower(isPostSet('group'));
    switch($term) {
        case 'admins':
            echo "admins";
            break;
        case 'faculty':
            echo "faculty";
            break;
		case 'parents':
            echo "parents";
            break;
        case 'students':
            echo "students";
            break;
    }
}

?>

<ul class="breadcrumb">
	<li><?php _e( _t( 'You are here' ) ); ?></li>
	<li><a href="<?php echo BASE_URL; ?>admin/dashboard/" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><?php _e( _t( 'Send Email' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Send Email' ) ); ?></h3>
<div class="innerLR">
	
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
					<div class="span10">
						<!-- Group -->
						<div class="control-group">
							<form class="form-horizontal margin-none" action="" method="get" onchange="this.form.submit();">
								<label class="control-label" for="mail_group"><font color="red">*</font> <?php _e( _t( 'Email Group' ) ); ?></label>
								<div class="controls">
								    <select id="group" name="group" required>
								    	<option value=""><?php _e( _t( '---- Select Email Group ----' ) ); ?></option>
								        <option value="admins"<?php if(isGetSet('group') == 'admins') echo ' selected="selected"'; ?>><?php _e( _t( 'Admins' ) ); ?></option>
								        <option value="faculty"<?php if(isGetSet('group') == 'faculty') echo ' selected="selected"'; ?>><?php _e( _t( 'Faculty' ) ); ?></option>
								        <option value="parents"<?php if(isGetSet('group') == 'parents') echo ' selected="selected"'; ?>><?php _e( _t( 'Parents' ) ); ?></option>
								        <option value="students"<?php if(isGetSet('group') == 'students') echo ' selected="selected"'; ?>><?php _e( _t( 'Students' ) ); ?></option>
								    </select>
								    <button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?php _e( _t( 'Submit' ) ); ?></button>
							   </div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	
	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?php echo BASE_URL; ?>admin/runMailer/" id="validateSubmitForm" method="post">
		
		<!-- Widget -->
		<div class="widget widget-heading-simple widget-body-gray">
			
			<div class="widget-body">
			
				<!-- Row -->
				<div class="row-fluid">
					
					<!-- Column -->
					<div class="span10">
						
						<!-- Group -->
						<div class="control-group">
							
							<?php if(isGetSet('group') == 'admins') { ?>
							
							<label class="control-label" for="email"><font color="red">*</font> <?php _e( _t( 'Email To' ) ); ?></label>
							<div class="controls">
								<select name="admins" required>
							    	<option value=""><?php _e( _t( '---- Select Admin Email ----' ) ); ?></option>
							    	<?php sysMailer('admins'); ?>
							        <option value="all"><?php _e( _t( 'All' ) ); ?></option>
							    </select>
							</div>
							
							<?php } elseif(isGetSet('group') == 'faculty') { ?>
							
							<label class="control-label" for="email"><font color="red">*</font> <?php _e( _t( 'Email To' ) ); ?></label>
							<div class="controls">
							    <select name="faculty" required>
							    	<option value=""><?php _e( _t( '---- Select Faculty Email ----' ) ); ?></option>
							    	<?php sysMailer('faculty'); ?>
							        <option value="all"><?php _e( _t( 'All' ) ); ?></option>
							    </select>
							 </div>
							 
							 <?php } elseif(isGetSet('group') == 'parents') { ?>
							 
							 <label class="control-label" for="email"><font color="red">*</font> <?php _e( _t( 'Email To' ) ); ?></label>
							 <div class="controls">
							    <select name="parents" required>
							    	<option value=""><?php _e( _t( '---- Select Parent Email ----' ) ); ?></option>
							    	<?php sysMailer('parents'); ?>
							        <option value="all"><?php _e( _t( 'All' ) ); ?></option>
							    </select>
							 </div>
							 
							 <?php } elseif(isGetSet('group') == 'students') { ?>
							 
							 <label class="control-label" for="email"><font color="red">*</font> <?php _e( _t( 'Email To' ) ); ?></label>
							 <div class="controls">
							    <select name="students" required>
							    	<option value=""><?php _e( _t( '---- Select Student Email ----' ) ); ?></option>
							    	<?php sysMailer('students'); ?>
							        <option value="all"><?php _e( _t( 'All' ) ); ?></option>
							    </select>
							 </div>
							 
							 <?php } ?>
							 
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="subject"><font color="red">*</font> <?php _e( _t( 'Email Subject' ) ); ?></label>
							<div class="controls"><input class="span12" id="subject" name="subject" type="text" required/></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="admin_email"><font color="red">*</font> <?php _e( _t( 'Email From' ) ); ?></label>
							<div class="controls"><input class="span12" id="admin_email" name="admin_email" disabled type="text" value="<?php echo Hooks::get_option(clean('admin_email')); ?>" required/></div>
						</div>
						<!-- // Group END -->
					
						<!-- Group -->
						<div class="control-group row-fluid">
							<div class="control-group">
								<label class="control-label" for="email_message"><font color="red">*</font> <?php _e( _t( 'Email Text' ) ); ?></label>
								<div class="controls">
									<textarea id="id1" class="wysihtml5 span12" rows="20" name="email_message" required></textarea>
								</div>
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
					<button type="submit" name="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?php _e( _t( 'Send Email' ) ); ?></button>
				</div>
				<!-- // Form actions END -->
				
			</div>
		</div>
		<!-- // Widget END -->
		
	</form>
	<!-- // Form END -->
	<div class="separator bottom"></div>
	<!-- // Widget END -->
	
</div>	
	
		
		</div>
		<!-- // Content END -->