<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * Edit Course View
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
	<li><a href="<?php echo BASE_URL; ?>admin/manage_courses/" class="glyphicons log_book"><i></i><?php _e( _t( 'Courses' ) ); ?></a></li>
	<li class="divider"></li>
	<li><?php _e( _t( 'Edit Course' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Edit Course' ) ); ?></h3>
<div class="innerLR">
	
	<?php if($this->course != '') : foreach($this->course as $key => $value) { ?>

	<!-- Form -->
	<form class="form-horizontal margin-none" id="validateSubmitForm" method="post" action="<?php echo BASE_URL; ?>admin/editCourse" autocomplete="off">
		
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
							<label class="control-label" for="coursename"><font color="red">*</font> <?php _e( _t( 'Course Name' ) ); ?></label>
							<div class="controls"><input class="span12" id="coursename" name="coursename" type="text" value="<?php echo clean($value['coursename']); ?>" required /></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="schoolid"><font color="red">*</font> <?php _e( _t( 'School' ) ); ?></label>
							<div class="controls">
								<select name="schoolid" required>
									<option value=""><?php _e( _t( ' ------------ School ------------ ' ) ); ?></option>
                            		<?php school_selected(clean($value['schoolid'])); ?>
                            	</select>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="facultyid"><font color="red">*</font> <?php _e( _t( 'Faculty' ) ); ?></label>
							<div class="controls">
								<select name="facultyid">
                            		<?php faculty_select(clean($value['facultyid'])); ?>
                            	</select>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="semesterid"><?php _e( _t( 'Semester' ) ); ?></label>
							<div class="controls">
								<select name="semesterid">
									<option value=""> ---------------- Semester ---------------- </option>
                            		<?php semester_list(clean($value['semesterid'])); ?>
                            	</select>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="termid"><?php _e( _t( 'Term' ) ); ?></label>
							<div class="controls">
								<select name="termid">
									<option value=""> ---------------- Semester ---------------- </option>
                            		<?php term_selected(clean($value['termid'])); ?>
                            	</select>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="sectionnum"><?php _e( _t( 'Section #' ) ); ?></label>
							<div class="controls"><input class="span12" id="sectionnum" name="sectionnum" type="text" value="<?php echo clean($value['sectionnum']); ?>" /></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="name"><font color="red">*</font> <?php _e( _t( 'Meeting Days' ) ); ?></label>
							<div class="controls widget-body uniformjs">
								<label class="checkbox">
									<input type="checkbox" class="checkbox" name="dotw[]" value="N" <?php if(preg_match("/N/", $value['dotw'])) { echo 'checked="checked"'; } ?> />
									<?php _e( _t( 'Sunday' ) ); ?>
								</label>
								<label class="checkbox">
									<input type="checkbox" class="checkbox" name="dotw[]" value="M" <?php if(preg_match("/M/", $value['dotw'])) { echo 'checked="checked"'; } ?> />
									<?php _e( _t( 'Monday' ) ); ?>
								</label>
								<label class="checkbox">
									<input type="checkbox" class="checkbox" name="dotw[]" value="T" <?php if(preg_match("/T/", $value['dotw'])) { echo 'checked="checked"'; } ?> />
									<?php _e( _t( 'Tuesday' ) ); ?>
								</label>
								<label class="checkbox">
									<input type="checkbox" class="checkbox" name="dotw[]" value="W" <?php if(preg_match("/W/", $value['dotw'])) { echo 'checked="checked"'; } ?> />
									<?php _e( _t( 'Wednesday' ) ); ?>
								</label>
								<label class="checkbox">
									<input type="checkbox" class="checkbox" name="dotw[]" value="H" <?php if(preg_match("/H/", $value['dotw'])) { echo 'checked="checked"'; } ?> />
									<?php _e( _t( 'Thursday' ) ); ?>
								</label>
								<label class="checkbox">
									<input type="checkbox" class="checkbox" name="dotw[]" value="F" <?php if(preg_match("/F/", $value['dotw'])) { echo 'checked="checked"'; } ?> />
									<?php _e( _t( 'Friday' ) ); ?>
								</label>
								<label class="checkbox">
									<input type="checkbox" class="checkbox" name="dotw[]" value="S" <?php if(preg_match("/S/", $value['dotw'])) { echo 'checked="checked"'; } ?> />
									<?php _e( _t( 'Saturday' ) ); ?>
								</label>
							</div>
						</div>
						<!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
					<!-- Column -->
					<div class="span6">
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="sdate"><font color="red">*</font> <?php _e( _t( 'Start Date' ) ); ?></label>
							<div class="controls">
								<div class="input-append date" id="datetimepicker6">
						    		<input id="sdate" name="sdate" type="text" value="<?php echo clean($value['sdate']); ?>" required />
				    				<span class="add-on"><i class="icon-th"></i></span>
								</div>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="edate"><font color="red">*</font> <?php _e( _t( 'End Date' ) ); ?></label>
							<div class="controls">
								<div class="input-append date" id="datetimepicker7">
						    		<input id="edate" name="edate" type="text" value="<?php echo clean($value['edate']); ?>" required />
				    				<span class="add-on"><i class="icon-th"></i></span>
								</div>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="stime"><font color="red">*</font> <?php _e( _t( 'Start Time' ) ); ?></label>
							<div class="controls">
								<div class="input-append bootstrap-timepicker">
									<input id="timepicker1" type="text" name="stime" class="input-small" value="<?php echo clean($value['stime']); ?>" required /><span class="add-on"><i class="icon-time"></i></span>
								</div>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="etime"><font color="red">*</font> <?php _e( _t( 'End time' ) ); ?></label>
							<div class="controls">
								<div class="input-append bootstrap-timepicker">
									<input id="timepicker6" type="text" name="etime" class="input-small" value="<?php echo clean($value['etime']); ?>" required /><span class="add-on"><i class="icon-time"></i></span>
								</div>
							</div>
						</div>
						<!-- // Group END -->
					
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="roomnum"><?php _e( _t( 'Room #' ) ); ?></label>
							<div class="controls"><input class="span12" id="roomnum" name="roomnum" type="text" value="<?php echo clean($value['roomnum']); ?>" /></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="periodnum"><?php _e( _t( 'Period #' ) ); ?></label>
							<div class="controls"><input class="span12" id="periodnum" name="periodnum" type="text" value="<?php echo clean($value['periodnum']); ?>" /></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="name"><?php _e( _t( 'Substitute' ) ); ?></label>
							<div class="controls">
								<select name="substituteid">
									<option value=""> ------------ Substitute Teacher ------------ </option>
                            		<?php substitute_select(clean($value['substituteid'])); ?>
                            	</select>
							</div>
						</div>
						<!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
				</div>
				<!-- // Row END -->
			
				<hr class="separator" />
				
				<div class="separator line bottom"></div>
								
				<!-- Group -->
				<div class="control-group row-fluid">
					<label class="control-label"><?php _e( _t( 'Course Description' ) ); ?></label>
					<div class="controls">
						<textarea id="mustHaveId" class="wysihtml5 span12" name="description" rows="5"><?php echo clean($value['description']); ?></textarea>
					</div>
				</div>
				<!-- // Group END -->
				
				<!-- Form actions -->
				<div class="form-actions">
					<input class="span12" type="hidden" name="courseid" value="<?php echo clean($value['courseid']); ?>" />
					<button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?php _e( _t( 'Save' ) ); ?></button>
				</div>
				<!-- // Form actions END -->
				
			</div>
		</div>
		<!-- // Widget END -->
		
	</form>
	<!-- // Form END -->
	<?php } endif; ?>
	
</div>	
	
		
		</div>
		<!-- // Content END -->