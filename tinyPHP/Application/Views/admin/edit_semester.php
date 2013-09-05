<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * Edit Semester View
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
	<li><?php _e( _t( 'You are here') ); ?></li>
	<li><a href="<?php echo BASE_URL; ?>admin/" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><a href="<?php echo BASE_URL; ?>admin/semesters/" class="glyphicons adjust_alt"><i></i> <?php _e( _t( 'Semesters' ) ); ?></a></li>
	<li class="divider"></li>
	<li><?php _e( _t( 'Edit Semester' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Edit Semester' ) ); ?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?php echo BASE_URL; ?>admin/editSemester" id="validateSubmitForm" method="post" autocomplete="off">
		
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
					<?php if($this->semester != '') : foreach($this->semester as $key => $value) { ?>
					<!-- Column -->
					<div class="span6">
					
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="semester"><font color="red">*</font> <?php _e( _t( 'Semester' ) ); ?></label>
							<div class="controls"><input class="span12" id="title" name="title" type="text" value="<?php echo clean($value['SemesterTitle']); ?>" /></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="term"><?php _e( _t( 'Term' ) ); ?></label>
							<div class="controls">
								<select name="termid">
									<option value=""><?php _e( _t( ' ---------- Terms ---------- ' ) ); ?></option>
                            		<?php term_selected(clean($value['termid'])); ?>
                            	</select>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="term"><font color="red">*</font> <?php _e( _t( 'Acad Year' ) ); ?></label>
							<div class="controls">
								<select name="semyear" required>
									<option value=""><?php _e( _t( ' ---------- Acad Year ---------- ' ) ); ?></option>
                            		<?php acad_year_dropdown(clean($value['semyear'])); ?>
                            	</select>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="startdate"><font color="red">*</font> <?php _e( _t( 'Start Date' ) ); ?></label>
							<div class="controls">
								<div class="input-append date" id="datetimepicker6">
						    		<input id="startdate" name="startdate" type="text" value="<?php echo clean($value['SemSD']); ?>" required />
				    				<span class="add-on"><i class="icon-th"></i></span>
								</div>
							</div>
						</div>
						<!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
					<!-- Column -->
					<div class="span6">
					
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="midtermdate"><font color="red">*</font> <?php _e( _t( 'Midterm Date' ) ); ?></label>
							<div class="controls">
								<div class="input-append date" id="datetimepicker7">
						    		<input id="midtermdate" name="midtermdate" type="text" value="<?php echo clean($value['midtermdate']); ?>" required />
				    				<span class="add-on"><i class="icon-th"></i></span>
								</div>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="enddate"><font color="red">*</font> <?php _e( _t( 'End Date' ) ); ?></label>
							<div class="controls">
								<div class="input-append date" id="datetimepicker8">
						    		<input id="enddate" name="enddate" type="text" value="<?php echo clean($value['SemED']); ?>" required />
				    				<span class="add-on"><i class="icon-th"></i></span>
								</div>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="semester"><font color="red">*</font> <?php _e( _t( 'Active' ) ); ?></label>
							<div class="controls">
								<select name="active" required>
									<option value=""><?php _e( _t( ' ---------- Active ---------- ' ) ); ?></option>
                            		<option value="yes"<?php if($value['active'] == 'yes') { echo ' selected="selected"'; } ?>><?php _e( _t( 'Yes' ) ); ?></option>
                            		<option value="no"<?php if($value['active'] == 'no') { echo ' selected="selected"'; } ?>><?php _e( _t( 'No' ) ); ?></option>
                            	</select>
							</div>
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
					<input id="sid" name="semesterid" type="hidden" value="<?php echo clean($value['semesterid']); ?>" />
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