<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * Add School View
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
	<li><?php _e( _t( 'Add School' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Add School' ) ); ?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" id="validateSubmitForm" action="<?php echo BASE_URL; ?>admin/runSchool/" method="post" autocomplete="off">
		
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
							<label class="control-label" for="firstname"><font color="red">*</font> <?php _e( _t( 'School ID' ) ); ?></label>
							<div class="controls"><input class="span12" id="schoolid" name="school_id" type="text" /> (up to 16 characters)</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="lastname"><font color="red">*</font> <?php _e( _t( 'School Name' ) ); ?></label>
							<div class="controls"><input class="span12" id="schoolname" name="school_name" type="text" /> (up to 50 characters)</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="username"><?php _e( _t( 'School Website' ) ); ?></label>
							<div class="controls"><input class="span12" id="website" name="school_website" type="text" /> (up to 80 characters)</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="numsemesters"><?php _e( _t( 'Semesters Per Year' ) ); ?></label>
							<div class="controls"><input class="span12" id="numsemesters" name="numsemesters" type="text" /></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="numperiods"><?php _e( _t( 'Periods Per Day' ) ); ?></label>
							<div class="controls"><input class="span12" id="numperiods" name="numperiods" type="text" /></div>
						</div>
						<!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
					<!-- Column -->
					<div class="span6">
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="apoint"><?php _e( _t( 'Points for A' ) ); ?></label>
							<div class="controls"><input class="span12" id="apoint" name="apoint" type="text" /></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="bpoint"><?php _e( _t( 'Points for B' ) ); ?></label>
							<div class="controls"><input class="span12" id="bpoint" name="bpoint" type="text" /></div>
						</div>
						<!-- // Group END -->
					
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="cpoint"><?php _e( _t( 'Points for C' ) ); ?></label>
							<div class="controls"><input class="span12" id="cpoint" name="cpoint" type="text" /></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="dpoint"><?php _e( _t( 'Points for D' ) ); ?></label>
							<div class="controls"><input class="span12" id="dpoint" name="dpoint" type="text" /></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="fpoint"><?php _e( _t( 'Points for F' ) ); ?></label>
							<div class="controls"><input class="span12" id="fpoint" name="fpoint" type="text" /></div>
						</div>
						<!-- // Group END -->
					
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="tmz"><?php _e( _t( 'Timezone Offset' ) ); ?></label>
							<div class="controls">
								<select name="timezone">
                            		<option value=""><?php _e( _t( ' -------- TimeZones -------- ' ) ); ?></option><?php "\n"; ?>
                            		<?php timezones(); ?>
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
						<textarea id="mustHaveId" class="wysihtml5 span12" name="disclaimer" rows="5">
							<p><strong>Disclaimer:</strong>  The scores contained in the table above may be weighted.  It is not usually possible to simply add the number of points earned and divide by the total number of points when scores are weighted.  The scores presented in this table are for information only.</p> 
							<p>An asterisk (<font color="red">*</font>) indicates that this score is missing from the teacher's grade book or has not yet been entered. </p>
						</textarea>
						(This will be shown with the gradebook display.)
					</div>
				</div>
				<!-- // Group END -->
				
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