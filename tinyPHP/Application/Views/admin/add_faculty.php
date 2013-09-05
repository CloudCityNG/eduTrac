<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * Add Faculty View
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

use \tinyPHP\Classes\Libraries\ID;

?>

<ul class="breadcrumb">
	<li><?php _e( _t( 'You are here') ); ?></li>
	<li><a href="<?php echo BASE_URL; ?>admin/" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><a href="<?php echo BASE_URL; ?>admin/manage_faculty/" class="glyphicons vcard"><i></i> <?php _e( _t( 'Faculty' ) ); ?></a></li>
	<li class="divider"></li>
	<li><?php _e( _t( 'Add Faculty' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Add Faculty' ) ); ?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?php echo BASE_URL; ?>admin/runFaculty" id="validateSubmitForm" method="post" autocomplete="off">
		
		<!-- Widget -->
		<div class="widget widget-heading-simple widget-body-gray">
		
			<!-- Widget heading -->
			<div class="widget-head">
				<h4 class="heading"><font color="red">*</font> <?php _e( _t( 'Indicates field is required.' ) ); ?></h4>
			</div>
			<!-- // Widget heading END -->
			
			<div class="widget-body">
			
				<!-- Row -->
				<div class="row-fluid">
					
					<!-- Column -->
					<div class="span6">
					
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="uname"><font color="red">*</font> <?php _e( _t( 'Username' ) ); ?></label>
							<div class="controls"><input class="span12" id="uname" name="uname" type="text" required /></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="fname"><font color="red">*</font> <?php _e( _t( 'First Name' ) ); ?></label>
							<div class="controls"><input class="span12" id="fname" name="fname" type="text" required /></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="lname"><font color="red">*</font> <?php _e( _t( 'Last Name' ) ); ?></label>
							<div class="controls"><input class="span12" id="lname" name="lname" type="text" required /></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="email"><font color="red">*</font> <?php _e( _t( 'Email' ) ); ?></label>
							<div class="controls"><input class="span12" id="email" name="email" type="email" required /></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="password"><font color="red">*</font> <?php _e( _t( 'Password' ) ); ?></label>
							<div class="controls"><input class="span12" id="password" name="password" type="password" required /></div>
						</div>
						<!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
					<!-- Column -->
					<div class="span6">
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="facid"><font color="red">*</font> <?php _e( _t( 'Faculty ID' ) ); ?></label>
							<div class="controls"><input class="span12" id="facid" name="facid" type="text" value="<?php echo ID::num(5); ?>" required /></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="School"><font color="red">*</font> <?php _e( _t( 'School' ) ); ?></label>
							<div class="controls">
								<select name="school" required>
									<option value=""><?php _e( _t( '---------------- School ----------------' ) ); ?></option>
                            		<?php echo school_list(); ?>
                            	</select>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="type"><font color="red">*</font> <?php _e( _t( 'Instructor Type' ) ); ?></label>
							<div class="controls">
								<select name="type" required>
									<option value=""><?php _e( _t( '---------- Instructor Type ----------' ) ); ?></option>
                            		<option value="teacher"><?php _e( _t( 'Teacher' ) ); ?></option>
                            		<option value="substitute"><?php _e( _t( 'Substitute' ) ); ?></option>
                            	</select>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<div class="controls">
								<div class="widget-body uniformjs">
									<label class="checkbox">
										<input type="checkbox" class="checkbox" name="welcome_email" />
										<?php _e( _t( 'Send welcome email?' ) ); ?>
									</label>
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