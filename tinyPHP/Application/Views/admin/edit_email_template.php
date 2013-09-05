<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * Edit Email Templates View
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
	<li><a href="<?php echo BASE_URL; ?>admin/dashboard/" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><a href="<?php echo BASE_URL; ?>admin/manage_email_templates/" class="glyphicons e-mail"><i></i> <?php _e( _t( 'Email Templates' ) ); ?></a></li>
	<li class="divider"></li>
	<li><?php _e( _t( 'Edit Email Template' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Edit Email Template' ) ); ?></h3>
<div class="innerLR">
	
	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?php echo BASE_URL; ?>admin/runTemplate/" id="validateSubmitForm" method="post">
		
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
						
						<?php if($this->emailTemp != '') : foreach($this->emailTemp as $key => $value) { ?>
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="email_name"><font color="red">*</font> <?php _e( _t( 'Email Name' ) ); ?></label>
							<div class="controls"><input class="span12" id="email_name" name="email_name" type="text" value="<?php echo clean($value['email_name']); ?>" required/></div>
						</div>
						<!-- // Group END -->
					
						<!-- Group -->
						<div class="control-group row-fluid">
							<div class="control-group">
								<label class="control-label" for="email_value"><font color="red">*</font> <?php _e( _t( 'Template' ) ); ?></label>
								<div class="controls">
									<textarea id="id1" class="wysihtml5 span12" rows="20" name="email_value" required><?php echo clean($value['email_value']); ?></textarea>
								</div>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="semester"><?php _e( _t( 'Last Update' ) ); ?></label>
							<div class="controls"><input class="span12" type="text" disabled value="<?php echo date('D, M d, o @ h:i A',clean(strtotime($value['LastUpdate']))); ?>" /></div>
						</div>
						<!-- // Group END -->
						<?php } endif; ?>
						
					</div>
					<!-- // Column END -->
					
				</div>
				<!-- // Row END -->
			
				<hr class="separator" />
				
				<!-- Form actions -->
				<div class="form-actions">
					<input id="email_id" name="email_id" type="hidden" value="<?php if($this->emailTemp != '') : foreach($this->emailTemp as $key => $value) { echo $value['email_id']; } endif; ?>" />
					<button type="submit" name="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?php _e( _t( 'Submit' ) ); ?></button>
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