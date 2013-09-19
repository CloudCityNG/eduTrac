<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Course Section Offering View
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
	<li><a href="<?=BASE_URL;?>section/<?=bm();?>" class="glyphicons search"><i></i> <?php _e( _t( 'Search Section' ) ); ?></a></li>
	<li class="divider"></li>
	<li><a href="<?=BASE_URL;?>section/view/<?=_h($this->soff[0]['courseSecID']);?>/<?=bm();?>" class="glyphicons adjust_alt"><i></i> <?=_h($this->soff[0]['courseSecCode']);?></a></li>
    <li class="divider"></li>
	<li><?php _e( _t( 'Offering Info' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Offering Info:' ) ); ?> <?=_h($this->soff[0]['courseSecCode']);?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>section/runSOFF/" id="validateSubmitForm" method="post" autocomplete="off">
		
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
							<label class="control-label"><font color="red">*</font> <?php _e( _t( 'Building' ) ); ?></label>
							<div class="controls">
							    <select style="width:50%;" name="buildingID" id="select2_9"<?=csio();?> required>
							        <option value="">&nbsp;</option>
                            	   <?php table_dropdown('building','','buildingID','buildingCode','buildingName',$this->soff[0]['buildingID']); ?>
                            	</select>
							</div>
						</div>
						<!-- // Group END -->
					
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><font color="red">*</font> <?php _e( _t( 'Class Room' ) ); ?></label>
							<div class="controls">
							    <select style="width:50%;" name="roomID" id="select2_10"<?=csio();?> required>
							        <option value="">&nbsp;</option>
                            	    <?php table_dropdown('room','','roomID','roomCode','roomNumber',$this->soff[0]['roomID']); ?>
                            	</select>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><font color="red">*</font> <?php _e( _t( 'Meeting Days' ) ); ?></label>
							<div class="controls widget-body uniformjs">
    							<label class="checkbox">
									<input type="checkbox" class="checkbox" name="dotw[]" value="Su" <?php if(preg_match("/Su/", $this->soff[0]['dotw'])) { echo 'checked="checked"'; } ?> />
									<?php _e( _t( 'Sunday' ) ); ?>
								</label>
								<label class="checkbox">
									<input type="checkbox" class="checkbox" name="dotw[]" value="M" <?php if(preg_match("/M/", $this->soff[0]['dotw'])) { echo 'checked="checked"'; } ?> />
									<?php _e( _t( 'Monday' ) ); ?>
								</label>
								<label class="checkbox">
									<input type="checkbox" class="checkbox" name="dotw[]" value="T" <?php if(preg_match("/T/", $this->soff[0]['dotw'])) { echo 'checked="checked"'; } ?> />
									<?php _e( _t( 'Tuesday' ) ); ?>
								</label>
								<label class="checkbox">
									<input type="checkbox" class="checkbox" name="dotw[]" value="W" <?php if(preg_match("/W/", $this->soff[0]['dotw'])) { echo 'checked="checked"'; } ?> />
									<?php _e( _t( 'Wednesday' ) ); ?>
								</label>
								<label class="checkbox">
									<input type="checkbox" class="checkbox" name="dotw[]" value="Th" <?php if(preg_match("/Th/", $this->soff[0]['dotw'])) { echo 'checked="checked"'; } ?> />
									<?php _e( _t( 'Thursday' ) ); ?>
								</label>
								<label class="checkbox">
									<input type="checkbox" class="checkbox" name="dotw[]" value="F" <?php if(preg_match("/F/", $this->soff[0]['dotw'])) { echo 'checked="checked"'; } ?> />
									<?php _e( _t( 'Friday' ) ); ?>
								</label>
								<label class="checkbox">
									<input type="checkbox" class="checkbox" name="dotw[]" value="S" <?php if(preg_match("/S/", $this->soff[0]['dotw'])) { echo 'checked="checked"'; } ?> />
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
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Start Time' ) ); ?></label>
                            <div class="controls">
                                <div class="input-append bootstrap-timepicker">
            				        <input id="timepicker1" type="text"<?=csio();?> name="startTime" class="input-small" value="<?=_h($this->soff[0]['startTime']);?>" required/><span class="add-on"><i class="icon-time"></i></span>
						        </div>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'End Time' ) ); ?></label>
                            <div class="controls">
                                <div class="input-append bootstrap-timepicker">
        					        <input id="timepicker2" type="text"<?=csio();?> name="endTime" class="input-small" value="<?=_h($this->soff[0]['endTime']);?>" required/><span class="add-on"><i class="icon-time"></i></span>
						        </div>
                            </div>
                        </div>
                        <!-- // Group END -->
						
						<!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Register Online' ) ); ?></label>
                            <div class="controls">
                                <select style="width:35%" name="stuReg"<?=csio();?> id="select2_11" required>
                                    <option value="">&nbsp;</option>
                                    <option value="1"<?=selected('1',$this->soff[0]['stuReg'],false);?>><?php _e( _t( 'Yes' ) ); ?></option>
                                    <option value="0"<?=selected('0',$this->soff[0]['stuReg'],false);?>><?php _e( _t( 'No' ) ); ?></option>
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
					<input type="hidden" name="courseSecID" value="<?=_h($this->soff[0]['courseSecID']);?>" />
					<button type="submit"<?=csids();?> class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?php _e( _t( 'Save' ) ); ?></button>
                    <button type="button" class="btn btn-icon btn-primary glyphicons circle_minus" onclick="window.location='<?=BASE_URL;?>section/view/<?=_h($this->soff[0]['courseSecID']);?>/<?=bm();?>'"><i></i><?php _e( _t( 'Cancel' ) ); ?></button>
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