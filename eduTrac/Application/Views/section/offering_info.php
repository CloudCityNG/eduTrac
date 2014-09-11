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
 * @since       3.0.0
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */
?>

<ul class="breadcrumb">
	<li><?=_t( 'You are here' );?></li>
	<li><a href="<?=BASE_URL?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?=_t( 'Dashboard' );?></a></li>
	<li class="divider"></li>
	<li><a href="<?=BASE_URL;?>section/<?=bm();?>" class="glyphicons search"><i></i> <?=_t( 'Search Section' );?></a></li>
	<li class="divider"></li>
	<li><a href="<?=BASE_URL;?>section/view/<?=_h($this->soff[0]['courseSecID']);?>/<?=bm();?>" class="glyphicons adjust_alt"><i></i> <?=_h($this->soff[0]['termCode']);?>-<?=_h($this->soff[0]['courseSecCode']);?></a></li>
    <li class="divider"></li>
	<li><?=_t( 'Offering Info' );?></li>
</ul>

<h3><?=_h($this->soff[0]['termCode']);?>-<?=_h($this->soff[0]['courseSecCode']);?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>section/runSOFF/" id="validateSubmitForm" method="post" autocomplete="off">
		
		<!-- Widget -->
		<div class="widget widget-heading-simple widget-body-gray">
		
			<!-- Widget heading -->
			<div class="widget-head">
				<h4 class="heading"><font color="red">*</font> <?=_t( 'Indicates field is required' );?></h4>
			</div>
			<!-- // Widget heading END -->
			
			<div class="widget-body">
			
				<!-- Row -->
				<div class="row">
					<!-- Column -->
					<div class="col-md-6">
                        
                        <!-- Group -->
    					<div class="form-group">
							<label class="col-md-3 control-label"><?=_t( 'Building' );?></label>
							<div class="col-md-8">
							    <select name="buildingCode" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true"<?=csio();?> required>
							        <option value="NULL">&nbsp;</option>
                            	   <?php table_dropdown('building','buildingCode <> "NULL"','buildingCode','buildingCode','buildingName',_h($this->soff[0]['buildingCode'])); ?>
                            	</select>
							</div>
						</div>
						<!-- // Group END -->
					
						<!-- Group -->
						<div class="form-group">
							<label class="col-md-3 control-label"><?=_t( 'Class Room' );?></label>
							<div class="col-md-8">
							    <select name="roomCode" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true"<?=csio();?> required>
							        <option value="NULL">&nbsp;</option>
                            	    <?php table_dropdown('room','roomCode <> "NULL"','roomCode','roomCode','roomNumber',_h($this->soff[0]['roomCode'])); ?>
                            	</select>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="form-group">
							<label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Meeting Days' );?></label>
							<div class="col-md-8 widget-body uniformjs">
    							<label class="checkbox">
									<input type="checkbox" class="checkbox" name="dotw[]" value="Su" <?php if(preg_match("/Su/", _h($this->soff[0]['dotw']))) { echo 'checked="checked"'; } ?> />
									<?=_t( 'Sunday' );?>
								</label>
								<label class="checkbox">
									<input type="checkbox" class="checkbox" name="dotw[]" value="M" <?php if(preg_match("/M/", _h($this->soff[0]['dotw']))) { echo 'checked="checked"'; } ?> />
									<?=_t( 'Monday' );?>
								</label>
								<label class="checkbox">
									<input type="checkbox" class="checkbox" name="dotw[]" value="Tu" <?php if(preg_match("/Tu/", _h($this->soff[0]['dotw']))) { echo 'checked="checked"'; } ?> />
									<?=_t( 'Tuesday' );?>
								</label>
								<label class="checkbox">
									<input type="checkbox" class="checkbox" name="dotw[]" value="W" <?php if(preg_match("/W/", _h($this->soff[0]['dotw']))) { echo 'checked="checked"'; } ?> />
									<?=_t( 'Wednesday' );?>
								</label>
								<label class="checkbox">
									<input type="checkbox" class="checkbox" name="dotw[]" value="Th" <?php if(preg_match("/Th/", _h($this->soff[0]['dotw']))) { echo 'checked="checked"'; } ?> />
									<?=_t( 'Thursday' );?>
								</label>
								<label class="checkbox">
									<input type="checkbox" class="checkbox" name="dotw[]" value="F" <?php if(preg_match("/F/", _h($this->soff[0]['dotw']))) { echo 'checked="checked"'; } ?> />
									<?=_t( 'Friday' );?>
								</label>
								<label class="checkbox">
									<input type="checkbox" class="checkbox" name="dotw[]" value="Sa" <?php if(preg_match("/Sa/", _h($this->soff[0]['dotw']))) { echo 'checked="checked"'; } ?> />
									<?=_t( 'Saturday' );?>
								</label>
							</div>
						</div>
						<!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
					<!-- Column -->
					<div class="col-md-6">
					    
					    <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Start Time' );?></label>
                            <div class="col-md-4">
                                <div class="input-group bootstrap-timepicker">
            				        <input id="timepicker10" type="text"<?=csio();?> name="startTime" class="form-control" value="<?=_h($this->soff[0]['startTime']);?>" required/>
            				        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
						        </div>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'End Time' );?></label>
                            <div class="col-md-4">
                                <div class="input-group bootstrap-timepicker">
        					        <input id="timepicker11" type="text"<?=csio();?> name="endTime" class="form-control" value="<?=_h($this->soff[0]['endTime']);?>" required/>
        					        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
						        </div>
                            </div>
                        </div>
                        <!-- // Group END -->
						
						<!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Register Online' );?></label>
                            <div class="col-md-8">
                                <select name="stuReg"<?=csio();?> class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true" required>
                                    <option value="">&nbsp;</option>
                                    <option value="1"<?=selected('1',_h($this->soff[0]['stuReg']),false);?>><?=_t( 'Yes' );?></option>
                                    <option value="0"<?=selected('0',_h($this->soff[0]['stuReg']),false);?>><?=_t( 'No' );?></option>
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
					<button type="submit"<?=csids();?> class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?=_t( 'Save' );?></button>
                    <button type="button" class="btn btn-icon btn-primary glyphicons circle_minus" onclick="window.location='<?=BASE_URL;?>section/view/<?=_h($this->soff[0]['courseSecID']);?>/<?=bm();?>'"><i></i><?=_t( 'Cancel' );?></button>
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