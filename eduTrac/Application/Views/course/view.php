<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Edit Course View
 *  
 * PHP 5.4+
 *
 * eduTrac(tm) : Student Information System (http://www.7mediaws.org/)
 * @copyright (c) 2013 7 Media Web Solutions, LLC
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 3
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 * 
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License, version 3
 * @link        http://www.7mediaws.org/
 * @since       1.0.0
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */
?>

<ul class="breadcrumb">
	<li><?php _e( _t( 'You are here' ) ); ?></li>
	<li><a href="<?=BASE_URL?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><a href="<?=BASE_URL;?>course/<?=bm();?>" class="glyphicons search"><i></i> <?php _e( _t( 'Search Course' ) ); ?></a></li>
	<li class="divider"></li>
	<li><?php _e( _t( 'View Course' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Course:' ) ); ?> <?=_h($this->crse[0]['courseCode']);?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>course/runEditCourse/" id="validateSubmitForm" method="post" autocomplete="off">
		
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
								<select style="width:100%;"<?=cio();?> name="deptID" id="select2_10" required>
									<option value="">&nbsp;</option>
                            		<?php table_dropdown('department', 'deptTypeCode = "acad"', 'deptID', 'deptCode', 'deptName', _h($this->crse[0]['deptID'])); ?>
                            	</select>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><font color="red">*</font> <?php _e( _t( 'Subject' ) ); ?></label>
							<div class="controls">
								<select style="width:100%;"<?=cio();?> name="subjectID" id="select2_11" required>
									<option value="">&nbsp;</option>
	                        		<?php subject_id_dropdown(_h($this->crse[0]['subjectID'])); ?>
	                        	</select>
	                       </div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><font color="red">*</font> <?php _e( _t( 'Course Number' ) ); ?></label>
							<div class="controls">
								<input type="text"<?=cio();?> name="courseNumber" value="<?=_h($this->crse[0]['courseNumber']);?>" class="span10" required />
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Course Level' ) ); ?></label>
                            <div class="controls">
                                <?=course_level_select(_h($this->crse[0]['courseLevelCode']));?>
                            </div>
                        </div>
                        <!-- // Group END -->
						
						<!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Short Title' ) ); ?></label>
                            <div class="controls">
                                <input type="text"<?=cio();?> name="courseShortTitle" value="<?=_h($this->crse[0]['courseShortTitle']);?>" class="span10" required/>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Long Title' ) ); ?></label>
                            <div class="controls">
                                <input type="text"<?=cio();?> name="courseLongTitle" value="<?=_h($this->crse[0]['courseLongTitle']);?>" class="span10" required/>
                            </div>
                        </div>
                        <!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><font color="red">*</font> <?php _e( _t( 'Effective Date' ) ); ?></label>
							<div class="controls">
								<div class="input-append date" id="datetimepicker6">
						    		<input id="startDate"<?=cio();?> name="startDate" type="text" value="<?=_h($this->crse[0]['startDate']);?>" required />
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
						    		<input id="endDate"<?=cio();?> name="endDate" type="text" value="<?=_h($this->crse[0]['endDate']);?>" />
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
                                <input type="text"<?=cio();?> name="minCredit" value="<?=_h($this->crse[0]['minCredit']);?>" class="span4" required/>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Academic Level' ) ); ?></label>
                            <div class="controls">
                                <?=acad_level_select(_h($this->crse[0]['acadLevelCode']),null,'required');?>
                            </div>
                        </div>
                        <!-- // Group END -->
					
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><font color="red">*</font> <?php _e( _t( 'Status' ) ); ?></label>
							<div class="controls">
								<?=status_select(_h($this->crse[0]['currStatus'])); ?>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><?php _e( _t( 'Status Date' ) ); ?></label>
							<div class="controls">
						    	<input id="statusDate"<?=cio();?> name="statusDate" type="text" readonly value="<?=date('D, M d, o',strtotime(_h($this->crse[0]['statusDate'])));?>" />
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><?php _e( _t( 'Approval Person' ) ); ?></label>
							<div class="controls">
								<input type="text" readonly value="<?=_h($this->crse[0]['lname']).', '._h($this->crse[0]['fname']);?>" class="span10" />
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><?php _e( _t( 'Approval Date' ) ); ?></label>
							<div class="controls">
								<input type="text" readonly value="<?=date('D, M d, o',strtotime(_h($this->crse[0]['approvedDate'])));?>" class="span10" />
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><?php _e( _t( 'Last Update' ) ); ?></label>
							<div class="controls">
								<input type="text" readonly value="<?=date('D, M d, o h:i A',strtotime(_h($this->crse[0]['LastUpdate'])));?>" class="span10" />
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Additional Info' ) ); ?></label>
                            <div class="controls">
                                <?php
                                     if($this->crse[0]['preReq'] != '' || $this->crse[0]['allowAudit'] != 0  || $this->crse[0]['allowWaitlist'] != 0 || 
                                     $this->crse[0]['minEnroll'] != 0 || $this->crse[0]['seatCap'] != 0) {
                                ?>
                                    <input type="text" disabled value="X" class="span1 center" />
                                    <a href="<?=BASE_URL;?>course/addnl_info/<?=_h($this->crse[0]['courseID']);?>/<?=bm();?>"><img src="<?=BASE_URL;?>static/common/theme/images/cascade.png" /></a>
                                <?php } else { ?>
                                    <input type="text" disabled class="span1" />
                                    <a href="<?=BASE_URL;?>course/addnl_info/<?=_h($this->crse[0]['courseID']);?>/<?=bm();?>"><img src="<?=BASE_URL;?>static/common/theme/images/cascade.png" /></a>
                                <?php } ?>
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
						<textarea id="mustHaveId"<?=cio();?> class="wysihtml5 span12" name="courseDesc" rows="5" required><?=_h($this->crse[0]['courseDesc']);?></textarea>
					</div>
				</div>
				<!-- // Group END -->
				
				<!-- Form actions -->
				<div class="form-actions">
					<input type="hidden" name="courseID" value="<?=_h($this->crse[0]['courseID']);?>" class="span10" />
					<button type="submit"<?=cids();?> class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?php _e( _t( 'Save' ) ); ?></button>
                    <button type="button" class="btn btn-icon btn-primary glyphicons circle_minus" onclick="window.location='<?=BASE_URL;?>course/<?=bm();?>'"><i></i><?php _e( _t( 'Cancel' ) ); ?></button>
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