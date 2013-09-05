<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * Edit Student View
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
?>

<ul class="breadcrumb">
	<li><?php _e( _t( 'You are here' ) ); ?></li>
	<li><a href="<?php echo BASE_URL; ?>admin/" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><a href="<?php echo BASE_URL; ?>admin/manage_students/" class="glyphicons group"><i></i> <?php _e( _t( 'Students' ) ); ?></a></li>
	<li class="divider"></li>
	<li><?php _e( _t( 'Edit Student' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Edit Student' ) ); ?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?php echo BASE_URL; ?>admin/editStudent" id="validateSubmitForm" method="post" autocomplete="off">
		
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
					<?php if($this->student != '') : foreach($this->student as $key => $value) { ?>
					<!-- Column -->
					<div class="span6">
					
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="username"><?php _e( _t( 'Student ID' ) ); ?></label>
							<div class="controls"><input class="span12" type="text" disabled value="<?php echo clean($value['sid']); ?>" /></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="uname"><?php _e( _t( 'Username' ) ); ?></label>
							<div class="controls"><input class="span12" id="uname" type="text" disabled value="<?php echo clean($value['uname']); ?>" /></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="lastname"><font color="red">*</font> <?php _e( _t( 'School' ) ); ?></label>
							<div class="controls">
								<select name="schoolid" required>
									<option value=""><?php _e( _t( '---------------- School ----------------' ) ); ?></option>
                            		<?php echo school_selected($value['schoolid']); ?>
                            	</select>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="fname"><font color="red">*</font> <?php _e( _t( 'First Name' ) ); ?></label>
							<div class="controls"><input class="span12" id="fname" name="fname" type="text" value="<?php echo clean($value['fname']); ?>" required /></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="lname"><font color="red">*</font> <?php _e( _t( 'Last Name' ) ); ?></label>
							<div class="controls"><input class="span12" id="lname" name="lname" type="text" value="<?php echo clean($value['lname']); ?>" required /></div>
						</div>
						<!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
					<!-- Column -->
					<div class="span6">
					
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="password"><?php _e( _t( 'Grade Year' ) ); ?></label>
							<div class="controls"><input class="span12" id="grade" name="grade" type="text" value="<?php echo clean($value['grade']); ?>" /></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="confirm_password"><?php _e( _t( 'Password' ) ); ?></label>
							<div class="controls"><input class="span12" id="password" name="password" type="password" /></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="email"><?php _e( _t( 'Email Address' ) ); ?></label>
							<div class="controls"><input class="span12" id="email" name="email" type="email" value="<?php echo clean($value['email']); ?>" /></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="email"><?php _e( _t( 'Last Update' ) ); ?></label>
							<div class="controls"><input class="span12" type="text" disabled value="<?php echo date("D, M d, o @ g:i A",clean($value['lastupdate'])); ?>" /></div>
						</div>
						<!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					<?php } endif; ?>
				</div>
				<!-- // Row END -->
			
				<hr class="separator" />
				
				<!-- Form actions -->
				<div class="form-actions">
					<input class="span12" name="sid" type="hidden" value="<?php echo clean($value['sid']); ?>" />
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