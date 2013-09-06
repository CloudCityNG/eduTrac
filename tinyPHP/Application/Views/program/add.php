<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * Add Program View
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
	<li><a href="<?=BASE_URL;?>program/<?=bm();?>" class="glyphicons adjust_alt"><i></i> <?php _e( _t( 'Search Program' ) ); ?></a></li>
	<li class="divider"></li>
	<li><?php _e( _t( 'Create Program' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Add Academic Program' ) ); ?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>program/runProg/" id="validateSubmitForm" method="post" autocomplete="off">
		
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
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Program Code' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="acadProgCode" class="span10" required />
                            </div>
                        </div>
                        <!-- // Group END -->
					
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><font color="red">*</font> <?php _e( _t( 'Title' ) ); ?></label>
							<div class="controls">
                                <input type="text" name="acadProgTitle" class="span10" required />
                            </div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><font color="red">*</font> <?php _e( _t( 'Short Description' ) ); ?></label>
							<div class="controls">
                                <input type="text" name="programDesc" class="span10" required />
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
                                <input id="statusDate" name="statusDate" type="text" readonly value="<?=date("Y-m-d");?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Approval Person' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="approvedBy" readonly value="<?=$auth->getPersonField('personID');?>" class="span10" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Approval Date' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="approvedDate" readonly value="<?=date('Y-m-d');?>" class="span10" />
                            </div>
                        </div>
                        <!-- // Group END -->
						
						<!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Dept/Div' ) ); ?></label>
                            <div class="controls">
                                <select style="width:100%;" name="deptCode" id="select2_10">
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('department','','deptCode','deptName');?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'School' ) ); ?></label>
                            <div class="controls">
                                <select style="width:100%" name="schoolCode" id="select2_11">
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('school','','schoolCode','schoolName');?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Effective Catalog Year' ) ); ?></label>
                            <div class="controls">
                                <select style="width: 100%;" name="acadYearCode" id="select2_12" required>
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('acad_year','','acadYearCode','acadYearDesc');?>
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
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Degree' ) ); ?></label>
                            <div class="controls">
                                <select style="width:100%;" name="degreeCode" id="select2_13" required>
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('degree','','degreeCode','degreeName');?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'CCD' ) ); ?></label>
                            <div class="controls">
                                <select style="width: 100%;" name="ccdCode" id="select2_14">
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('ccd','','ccdCode','ccdName');?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Major' ) ); ?></label>
                            <div class="controls">
                                <select style="width: 100%;" name="majorCode" id="select2_15">
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('major','','majorCode','majorName');?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Minor' ) ); ?></label>
                            <div class="controls">
                                <select style="width: 100%;" name="minorCode" id="select2_16">
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('minor','','minorCode','minorName');?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Specialization' ) ); ?></label>
                            <div class="controls">
                                <select style="width: 100%;" name="specCode" id="select2_17">
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('specialization', '', 'specCode', 'specName'); ?>
                                </select>
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
                            <label class="control-label"><?php _e( _t( 'CIP' ) ); ?></label>
                            <div class="controls">
                                <select style="width:100%" name="cipCode" id="select2_19">
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('cip','','cipCode','cipName');?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Location' ) ); ?></label>
                            <div class="controls">
                                <select style="width:100%" name="locationCode" id="select2_20">
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('location','','locationCode','locationName');?>
                                </select>
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