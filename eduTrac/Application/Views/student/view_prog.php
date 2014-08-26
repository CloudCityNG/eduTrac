<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Edit Student Program
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
	<li><a href="<?=BASE_URL;?>student/<?=bm();?>" class="glyphicons search"><i></i> <?=_t( 'Search Student' );?></a></li>
    <li class="divider"></li>
    <li><a href="<?=BASE_URL;?>student/view/<?=_h($this->stuProg[0]['stuID']);?>/<?=bm();?>" class="glyphicons user"><i></i> <?=get_name(_h($this->stuProg[0]['stuID']));?></a></li>
    <li class="divider"></li>
	<li><?=_t( 'Edit Student Program' );?></li>
</ul>

<h3><?=get_name(_h($this->stuProg[0]['stuID']));?>: <?=_h($this->stuProg[0]['stuID']);?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>student/runEditStuProg/" id="validateSubmitForm" method="post" autocomplete="off">
		
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
							<label class="col-md-3 control-label"><?=_t( 'Program' );?></label>
							<div class="col-md-8">
								<input type="text" readonly class="form-control" value="<?=_h($this->stuProg[0]['acadProgCode']);?>" />
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'School' );?></label>
                            <div class="col-md-8">
                                <input type="text" readonly class="form-control" value="<?=_h($this->stuProg[0]['schoolCode'].' '.$this->stuProg[0]['schoolName']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Ant Grad Date' );?></label>
                            <div class="col-md-2">
                                <input type="text"<?=sio();?> name="antGradDate" class="form-control center" value="<?=_h($this->stuProg[0]['antGradDate']);?>" required />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Advisor' );?></label>
                            <div class="col-md-8">
                                <select name="advisorID"<?=sio();?> class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true" required>
                                    <option value="">&nbsp;</option>
                                    <?php facID_dropdown(_h($this->stuProg[0]['advisorID'])); ?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Academic Level' );?></label>
                            <div class="col-md-8">
                                <input type="text" readonly class="form-control" value="<?=_h($this->stuProg[0]['acadLevelCode']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Catalog Year' );?></label>
                            <div class="col-md-8">
                                <select name="catYearCode"<?=sio();?> class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true" required>
                                    <option value="">&nbsp;</option>
                                    <?php table_dropdown('acad_year', 'acadYearCode <> "NULL"', 'acadYearCode', 'acadYearCode', 'acadYearDesc',_h($this->stuProg[0]['catYearCode'])); ?>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
						<div class="form-group"<?php if(_h($this->stuProg[0]['currStatus']) == 'G') { echo ' style="display:none"'; } ?>>
						    <label class="col-md-3 control-label"><?=_t( 'Eligible to Graduate?' );?></label>
							<div class="col-md-8 widget-body uniformjs">
    							<label class="checkbox">
									<input type="checkbox"<?=sio();?> class="checkbox" name="eligible_to_graduate" value="1"<?=checked('1',_h($this->stuProg[0]['eligible_to_graduate']),false);?> />
									<a href="#myModal" data-toggle="modal"><img src="<?=BASE_URL;?>static/common/theme/images/help.png" /></a>
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
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Status' );?></label>
                            <div class="col-md-8">
                                <?=stu_prog_status_select(_h($this->stuProg[0]['currStatus']));?>
                            </div>
                        </div>
                        <!-- // Group END -->
					    
					    <?php if(_h($this->stuProg[0]['currStatus']) == 'G') { ?>
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Graduation Date' );?></label>
                            <div class="col-md-8">
                                <div class="input-group date" id="datepicker6">
                                    <input class="form-control"<?=sio();?> name="graduationDate"<?=sio();?> type="text" value="<?=_h($this->stuProg[0]['graduationDate']);?>" />
                                    <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                </div>
                            </div>
                        </div>
                        <!-- // Group END -->
						<?php } ?>
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Start Date' );?></label>
                            <div class="col-md-8">
                                <div class="input-group date" id="datepicker7">
                                    <input class="form-control"<?=sio();?> name="startDate" type="text" value="<?=_h($this->stuProg[0]['startDate']);?>" required/>
                                    <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                </div>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'End Date' );?></label>
                            <div class="col-md-8">
                                <div class="input-group date" id="datepicker8">
                                    <?php if($this->stuProg[0]['endDate'] == NULL || $this->stuProg[0]['endDate'] == '0000-00-00') { ?>
                                    <input class="form-control"<?=sio();?> name="endDate"<?=sio();?> type="text" />
                                    <?php } else { ?>
                                    <input class="form-control"<?=sio();?> name="endDate"<?=sio();?> type="text" value="<?=_h($this->stuProg[0]['endDate']);?>" />
                                    <?php } ?>
                                    <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                </div>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Approved By' );?></label>
                            <div class="col-md-6">
                                <input type="text" readonly class="form-control" value="<?=_h(get_name($this->stuProg[0]['approvedBy']));?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Last Update' );?></label>
                            <div class="col-md-6">
                                <input type="text" readonly class="form-control" value="<?=date('D, M d, o @ h:i A',strtotime(_h($this->stuProg[0]['LastUpdate'])));?>" />
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
				    <input type="hidden" name="stuProgID" value="<?=_h($this->stuProg[0]['stuProgID']);?>" />
				    <input type="hidden" name="stuID" value="<?=_h($this->stuProg[0]['stuID']);?>" />
					<button<?php if(_h($this->stuProg[0]['currStatus']) == 'G') { echo ' style="display:none"'; } ?> type="submit"<?=sids();?> class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?=_t( 'Save' );?></button>
					<button type="button"<?=sids();?> class="btn btn-icon btn-primary glyphicons circle_plus" onclick="window.location='<?=BASE_URL;?>student/add_prog/<?=_h($this->stuProg[0]['stuID']);?>/<?=bm();?>'"><i></i><?=_t( 'Add' );?></button>
					<button type="button" class="btn btn-icon btn-primary glyphicons circle_minus" onclick="window.location='<?=BASE_URL;?>student/view/<?=_h($this->stuProg[0]['stuID']);?>/<?=bm();?>'"><i></i><?=_t( 'Cancel' );?></button>
				</div>
				<!-- // Form actions END -->
				
			</div>
		</div>
        
        <!-- Modal -->
		<div class="modal fade" id="myModal">
			<div class="modal-dialog">
				<div class="modal-content">
					<!-- Modal heading -->
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h3 class="modal-title"><?=_t( 'Eligible to Graduate' );?></h3>
					</div>
					<!-- // Modal heading END -->
					<!-- Modal body -->
					<div class="modal-body">
						<p><?=_t('Select the checkbox if the student is eligible to graduate from this particular program.');?></p>
					</div>
					<!-- // Modal body END -->
					<!-- Modal footer -->
					<div class="modal-footer">
						<a href="#" class="btn btn-default" data-dismiss="modal"><?=_t( 'Close' );?></a> 
					</div>
					<!-- // Modal footer END -->
				</div>
			</div>
		</div>
		<!-- // Modal END -->
		<!-- // Widget END -->
		
	</form>
	<!-- // Form END -->
	
</div>	
		
		</div>
		<!-- // Content END -->