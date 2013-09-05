<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * Edit School View
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
	<li><a href="<?php echo BASE_URL; ?>admin/schools/" class="glyphicons home"><i></i> <?php _e( _t( 'Schools' ) ); ?></a></li>
	<li class="divider"></li>
	<li><?php _e( _t( 'Edit School' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Edit School' ) ); ?></h3>
<div class="innerLR">
	
	<?php if($this->school != '') : foreach($this->school as $key => $value) { ?>

	<!-- Form -->
	<form class="form-horizontal margin-none" id="validateSubmitForm" method="post" action="<?php echo BASE_URL; ?>admin/editSchool/" autocomplete="off">
		
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
							<label class="control-label" for="firstname"><?php _e( _t( 'School ID' ) ); ?></label>
							<div class="controls"><?php echo clean($value['school_id']); ?></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="schoolname"><font color="red">*</font> <?php _e( _t( 'School Name' ) ); ?></label>
							<div class="controls"><input class="span12" id="schoolname" name="school_name" type="text" value="<?php echo clean($value['school_name']); ?>" /> (up to 50 characters)</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="school_website"><?php _e( _t( 'School Website' ) ); ?></label>
							<div class="controls"><input class="span12" id="website" name="school_website" type="text" value="<?php echo clean($value['school_website']); ?>" /> (up to 80 characters)</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="numsemesters"><?php _e( _t( 'Semesters Per Year' ) ); ?></label>
							<div class="controls"><input class="span12" id="numsemesters" name="numsemesters" type="text" value="<?php echo clean($value['numsemesters']); ?>" /></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="numperiods"><?php _e( _t( 'Periods Per Day' ) ); ?></label>
							<div class="controls"><input class="span12" id="numperiods" name="numperiods" type="text" value="<?php echo clean($value['numperiods']); ?>" /></div>
						</div>
						<!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
					<!-- Column -->
					<div class="span6">
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="apoint"><?php _e( _t( 'Points for A' ) ); ?></label>
							<div class="controls"><input class="span12" id="apoint" name="apoint" type="text" value="<?php echo clean($value['apoint']); ?>" /></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="bpoint"><?php _e( _t( 'Points for B' ) ); ?></label>
							<div class="controls"><input class="span12" id="bpoint" name="bpoint" type="text" value="<?php echo clean($value['bpoint']); ?>" /></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="cpoint"><?php _e( _t( 'Points for C' ) ); ?></label>
							<div class="controls"><input class="span12" id="cpoint" name="cpoint" type="text" value="<?php echo clean($value['cpoint']); ?>" /></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="dpoint"><?php _e( _t( 'Points for D' ) ); ?></label>
							<div class="controls"><input class="span12" id="dpoint" name="dpoint" type="text" value="<?php echo clean($value['dpoint']); ?>" /></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="fpoint"><?php _e( _t( 'Points for F' ) ); ?></label>
							<div class="controls"><input class="span12" id="fpoint" name="fpoint" type="text" value="<?php echo clean($value['fpoint']); ?>" /></div>
						</div>
						<!-- // Group END -->
					
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="tmz"><?php _e( _t( 'Timezone Offset' ) ); ?></label>
							<div class="controls">
								<select name="timezone">
                            		<option value=""> -------- TimeZones -------- </option><?php "\n"; ?>
                            		<?php echo timezones(clean($value['timezone'])); ?>
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
					<label class="control-label"><?php _e( _t( 'Disclaimer' ) ); ?></label>
					<div class="controls">
						<textarea id="mustHaveId" class="wysihtml5 span12" name="disclaimer" rows="5"><?php echo clean($value['disclaimer']); ?></textarea>
						(This will be shown with the gradebook display.)
					</div>
				</div>
				<!-- // Group END -->
				
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="tmz"><?php _e( _t( 'Teachers' ) ); ?></label>
							<div class="controls"><input class="span12" disabled type="text" value="<?php echo clean($value['teacher_count']); ?>" /></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="tmz"><?php _e( _t( 'Courses' ) ); ?></label>
							<div class="controls"><input class="span12" disabled type="text" value="<?php echo clean($value['course_count']); ?>" /></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="tmz"><?php _e( _t( 'Last Update' ) ); ?></label>
							<div class="controls"><input class="span12" disabled type="text" value="<?php echo date("D, M d, o @ g:i a",clean($value['LastUpdate'])); ?>" /></div>
						</div>
						<!-- // Group END -->
				
				<!-- Form actions -->
				<div class="form-actions">
					<input class="span12" name="school_id" type="hidden" value="<?php echo clean($value['school_id']); ?>" />
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