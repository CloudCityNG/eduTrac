<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * Edit Course View
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

use \tinyPHP\Classes\Libraries\Hooks;
$auth = new \tinyPHP\Classes\Libraries\Cookies;
?>

<ul class="breadcrumb">
	<li><?php _e( _t( 'You are here' ) ); ?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><a href="<?=BASE_URL;?>course/<?=bm();?>" class="glyphicons search"><i></i> <?php _e( _t( 'Search Course' ) ); ?></a></li>
	<li class="divider"></li>
	<li><?php _e( _t( 'Create Course' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Add Course' ) ); ?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>form/runCourse/" id="validateSubmitForm" method="post" autocomplete="off">
		
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
							<label class="control-label"><font color="red">*</font> <?php _e( _t( 'Department' ) ); ?></label>
							<div class="controls">
								<select style="width:100%;" name="deptCode" id="select2_10" required>
									<option value="">&nbsp;</option>
                            		<?php table_dropdown('department', '', 'deptCode', 'deptName'); ?>
                            	</select>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><font color="red">*</font> <?php _e( _t( 'Subject' ) ); ?></label>
							<div class="controls">
								<select style="width:100%;" name="subjCode" id="select2_11" required>
									<option value="">&nbsp;</option>
	                        		<?php subj_key_dropdown(); ?>
	                        	</select>
	                       </div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Course Level' ) ); ?></label>
                            <div class="controls">
                                <?=course_level_select();?>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Short Title' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="courseShortTitle" class="span10" required/>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Long Title' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="courseLongTitle" class="span10" required/>
                            </div>
                        </div>
                        <!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><font color="red">*</font> <?php _e( _t( 'Course Number' ) ); ?></label>
							<div class="controls">
								<input type="text" name="courseNumber" class="span10" required />
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><font color="red">*</font> <?php _e( _t( 'Effective Date' ) ); ?></label>
							<div class="controls">
								<div class="input-append date" id="datetimepicker6">
						    		<input id="startDate" name="startDate" type="text" required />
				    				<span class="add-on"><i class="icon-th"></i></span>
								</div>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><?php _e( _t( 'End Date' ) ); ?></label>
							<div class="controls">
								<div class="input-append date" id="datetimepicker7">
						    		<input id="endDate" name="endDate" type="text"  />
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
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Credits' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="minCredit" required/>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Academic Level' ) ); ?></label>
                            <div class="controls">
                                <?=acad_level_select();?>
                            </div>
                        </div>
                        <!-- // Group END -->
					
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><font color="red">*</font> <?php _e( _t( 'Status' ) ); ?></label>
							<div class="controls">
								<?=status_select();?>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><?php _e( _t( 'Status Date' ) ); ?></label>
							<div class="controls">
						    	<input id="statusDate" name="statusDate" type="text" disabled value="<?=date("Y-m-d");?>" />
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Approval Person' ) ); ?></label>
                            <div class="controls">
                                <input id="statusDate" name="approvedBy" type="text" disabled value="<?=$auth->getPersonField('personID');?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><?php _e( _t( 'Approval Date' ) ); ?></label>
							<div class="controls">
								<input type="text" name="approvedDate" disabled value="<?=date('Y-m-d');?>" class="span10" />
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
						<textarea id="mustHaveId" class="wysihtml5 span12" name="description" rows="5" required></textarea>
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