<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * View Term View
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
	<li><?=_t( 'You are here');?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?=_t( 'Dashboard' );?></a></li>
	<li class="divider"></li>
    <li><a href="<?=BASE_URL;?>form/term/<?=bm();?>" class="glyphicons pin_flag"><i></i> <?=_t( 'Term' );?></a></li>
    <li class="divider"></li>
	<li><?=_t( 'View Term' );?></li>
</ul>

<h3><?=_t( 'View Term' );?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>form/runEditTerm/" id="validateSubmitForm" method="post" autocomplete="off">
		
		<!-- Widget -->
		<div class="widget widget-heading-simple widget-body-gray">
		
			<!-- Widget heading -->
			<div class="widget-head">
				<h4 class="heading"><?=_t( 'Indicates field is required' );?></h4>
			</div>
			<!-- // Widget heading END -->
			
			<div class="widget-body">
			
				<!-- Row -->
				<div class="row">
					
					<!-- Column -->
					<div class="col-md-6">
						
						<!-- Group -->
						<div class="form-group">
							<label class="col-md-3 col-md-3 control-label" for="semCode"><font color="red">*</font> <?=_t( 'Semester' );?></label>
							<div class="col-md-8">
								<select name="semCode" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true"<?=gio();?> required>
									<option value="">&nbsp;</option>
                            		<?php table_dropdown("semester", 'semCode <> "NULL"', "semCode", "semCode", "semName", _h($this->term[0]['semCode'])); ?>
                            	</select>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="termCode"><font color="red">*</font> <?=_t( 'Term Code' );?></label>
                            <div class="col-md-8"><input class="form-control"<?=gio();?> name="termCode" type="text" value="<?=_h($this->term[0]['termCode']);?>" required /></div>
                        </div>
                        <!-- // Group END -->
					
						<!-- Group -->
						<div class="form-group">
							<label class="col-md-3 control-label" for="termName"><font color="red">*</font> <?=_t( 'Term' );?></label>
							<div class="col-md-8"><input class="form-control" id="termName"<?=gio();?> name="termName" type="text" value="<?=_h($this->term[0]['termName']);?>" required /></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="reportingTerm"><font color="red">*</font> <?=_t( 'Reporting Term' );?></label>
                            <div class="col-md-8"><input class="form-control" id="reportingTerm"<?=gio();?> name="reportingTerm" type="text" value="<?=_h($this->term[0]['reportingTerm']);?>" required /></div>
                        </div>
                        <!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
					<!-- Column -->
					<div class="col-md-6">
					    
					    <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="termStartDate"><font color="red">*</font> <?=_t( 'Start Date' );?></label>
                            <div class="col-md-8">
                                <div class="input-group date col-md-8" id="datepicker8">
                                    <input class="form-control"<?=gio();?> name="termStartDate" type="text" value="<?=_h($this->term[0]['termStartDate']);?>" required />
                                    <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                </div>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
						<!-- Group -->
						<div class="form-group">
							<label class="col-md-3 control-label" for="termEndDate"><font color="red">*</font> <?=_t( 'End Date' );?></label>
							<div class="col-md-8">
								<div class="input-group date col-md-8" id="datepicker9">
						    		<input class="form-control"<?=gio();?> name="termEndDate" type="text" value="<?=_h($this->term[0]['termEndDate']);?>" required />
				    				<span class="input-group-addon"><i class="fa fa-th"></i></span>
								</div>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="dropAddEndDate"><font color="red">*</font> <?=_t( 'Drop/Add End Date' );?></label>
                            <div class="col-md-8">
                                <div class="input-group date col-md-8" id="datepicker10">
                                    <input class="form-control" name="dropAddEndDate" type="text" value="<?=_h($this->term[0]['dropAddEndDate']);?>" required />
                                    <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                </div>
                            </div>
                        </div>
                        <!-- // Group END -->
						
						<!-- Group -->
						<div class="form-group">
							<label class="col-md-3 control-label" for="term"><font color="red">*</font> <?=_t( 'Active' );?></label>
							<div class="col-md-8">
								<select name="active" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true"<?=gio();?> required>
									<option value="">&nbsp;</option>
                            		<option value="1"<?php if($this->term[0]['active'] == '1') { echo 'selected="selected"'; } ?>><?=_t( 'Yes' );?></option>
                            		<option value="0"<?php if($this->term[0]['active'] == '0') { echo 'selected="selected"'; } ?>><?=_t( 'No' );?></option>
                            	</select>
							</div>
						</div>
						<!-- // Group END -->
					</div>
					
				</div>
				<!-- // Row END -->
			
				<hr class="separator" />
				
				<!-- Form actions -->
				<div class="form-actions">
					<input name="termID"<?=gids();?> type="hidden" value="<?=_h($this->term[0]['termID']);?>" />
					<button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?=_t( 'Save' );?></button>
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