<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Add Application View
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
    <li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?=_t( 'Dashboard' );?></a></li>
    <li class="divider"></li>
    <li><a href="<?=BASE_URL;?>application/<?=bm();?>" class="glyphicons search"><i></i> <?=_t( 'Search Application' );?></a></li>
    <li class="divider"></li>
    <li><?=_t( 'Create Application' );?></li>
</ul>

<h3><?=_t( 'Create Application' );?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>application/runApplication/" id="validateSubmitForm" method="post" autocomplete="off">
		
		<!-- Widget -->
		<div class="widget widget-heading-simple widget-body-gray">
		
			<!-- Widget heading -->
			<div class="widget-head">
				<h4 class="heading"><font color="red">*</font> <?=_t( 'Indicates field is required.' );?></h4>
			</div>
			<!-- // Widget heading END -->
			
			<div class="widget-body">
			
				<!-- Row -->
				<div class="row">
					
					<!-- Column -->
					<div class="col-md-6">
						
						<!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Person ID' );?></label>
                            <div class="col-md-8">
                            	<input class="form-control" readonly type="text" value="<?=_h($this->person[0]['personID']);?>" />
                        	</div>
                        </div>
                        <!-- // Group END -->
						
						<!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'First/Mid/Last Name' );?></label>
                            <div class="col-md-3">
                            	<input class="form-control" readonly type="text" value="<?=_h($this->person[0]['fname']);?>" />
                        	</div>
                        	<div class="col-md-2">
                            	<input class="form-control" readonly type="text" value="<?=_h($this->person[0]['mname']);?>" />
                        	</div>
                        	<div class="col-md-3">
                            	<input class="form-control" readonly type="text" value="<?=_h($this->person[0]['lname']);?>" />
                        	</div>
                        </div>
                        <!-- // Group END -->
						
						<!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Permanent Address' );?></label>
                            <div class="col-md-8">
                            	<input class="form-control" readonly type="text" value="<?=_h($this->address[0]['address1']);?> <?=_h($this->address[0]['address2']);?>" />
                            	<input class="form-control" readonly type="text" value="<?=_h($this->address[0]['city']);?> <?=_h($this->address[0]['state']);?> <?=_h($this->address[0]['zip']);?>" />
                        	</div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'DOB' );?></label>
                            <div class="col-md-8">
                            	<?php if(_h($this->person[0]['dob']) > '0000-00-00') : ?>
                            	<input class="form-control" readonly type="text" value="<?=date('D, M d, o',strtotime(_h($this->person[0]['dob'])));?>" />
                            	<?php else : ?>
                            	<input class="form-control" readonly type="text" />
                        		<?php endif; ?>
                        	</div>
                        </div>
                        <!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
					<!-- Column -->
					<div class="col-md-6">
						
						<!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Age' );?></label>
                            <div class="col-md-8">
                            	<?php if(_h($this->person[0]['dob']) > '0000-00-00') : ?>
                            	<input class="form-control" readonly type="text" value="<?=\eduTrac\Classes\Libraries\Util::getAge(_h($this->person[0]['dob']));?>" />
                            	<?php else : ?>
                            	<input class="form-control" readonly type="text" />
                        		<?php endif; ?>
                        	</div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Gender' );?></label>
                            <div class="col-md-8">
                            	<input class="form-control" readonly type="text" value="<?php if(_h($this->person[0]['gender']) == 'M') : echo 'Male'; elseif(_h($this->person[0]['gender']) == 'F') : echo 'Female'; endif; ?>" />
                        	</div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Phone Number' );?></label>
                            <div class="col-md-8">
                            	<input class="form-control" readonly type="text" value="<?=_h($this->address[0]['phone1']);?>" />
                        	</div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Email Address' );?></label>
                            <div class="col-md-8">
                            	<input class="form-control" readonly type="text" value="<?=_h($this->person[0]['email']);?>" />
                        	</div>
                        </div>
                        <!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
				</div>
				<!-- // Row END -->
			
				<div class="separator bottom"></div>
				
				<!-- Row -->
				<div class="row">
					
					<!-- Column -->
					<div class="col-md-6">
						
						<!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Application Date' );?></label>
                            <div class="col-md-8">
                            	<div class="input-group date" id="datepicker6">
                                    <input class="form-control" name="applDate" type="text" />
                                    <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                </div>
                        	</div>
                        </div>
                        <!-- // Group END -->
						
						<!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Academic Program' );?></label>
                            <div class="col-md-8">
                                <select name="acadProgCode" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true">
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('acad_program','currStatus = "A"','acadProgCode','acadProgCode','acadProgTitle'); ?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Start Term' );?></label>
                            <div class="col-md-8">
                                <select name="startTerm" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true" required/>
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('term','termCode <> "NULL"','termCode','termCode','termName'); ?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Admit Status' );?></label>
                            <div class="col-md-8">
                                <?=admit_status_select();?>
                            </div>
                        </div>
                        <!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
					<!-- Column -->
					<div class="col-md-6">
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'PSAT Verbal/Math' );?></label>
                            <div class="col-md-4">
                                <input class="form-control" type="text" name="PSAT_Verbal" />
                            </div>
                            <div class="col-md-4">
                                <input class="form-control" type="text" name="PSAT_Math" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'SAT Verbal/Math' );?></label>
                            <div class="col-md-4">
                                <input class="form-control" type="text" name="SAT_Verbal" />
                            </div>
                            <div class="col-md-4">
                                <input class="form-control" type="text" name="SAT_Math" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'ACT English/Math' );?></label>
                            <div class="col-md-4">
                                <input class="form-control" type="text" name="ACT_English" />
                            </div>
                            <div class="col-md-4">
                                <input class="form-control" type="text" name="ACT_Math" />
                            </div>
                        </div>
                        <!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
				</div>
				<!-- // Row END -->
				
				
				
				<!-- Form actions -->
				<div class="form-actions">
					<input type="hidden" name="personID" value="<?=_h($this->person[0]['personID']);?>" />
                    <input type="hidden" name="addedBy" value="<?=$auth->getPersonField('personID');?>" />
					<button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?=_t( 'Submit' );?></button>
                    <button type="button" class="btn btn-icon btn-primary glyphicons circle_minus" onclick="window.location='<?=BASE_URL;?>application/<?=bm();?>'"><i></i><?=_t( 'Cancel' );?></button>
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