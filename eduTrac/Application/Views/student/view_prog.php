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
 * @since       1.0.0
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */
?>

<ul class="breadcrumb">
	<li><?php _e( _t( 'You are here' ) ); ?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><a href="<?=BASE_URL;?>student/<?=bm();?>" class="glyphicons search"><i></i> <?php _e( _t( 'Search Student' ) ); ?></a></li>
    <li class="divider"></li>
    <li><a href="<?=BASE_URL;?>student/view/<?=_h($this->stuProg[0]['stuID']);?>/<?=bm();?>" class="glyphicons user"><i></i> <?=get_name(_h($this->stuProg[0]['stuID']));?></a></li>
    <li class="divider"></li>
	<li><?php _e( _t( 'Edit Student Program' ) ); ?></li>
</ul>

<h3><?=get_name(_h($this->stuProg[0]['stuID']));?> <?php _e( _t( "ID: " ) ); ?><?=_h($this->stuProg[0]['stuID']);?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>student/runEditStuProg/" id="validateSubmitForm" method="post" autocomplete="off">
		
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
							<label class="control-label"><?php _e( _t( 'Program' ) ); ?></label>
							<div class="controls">
								<input type="text" readonly class="span10" value="<?=_h($this->stuProg[0]['acadProgCode']);?>" />
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'School' ) ); ?></label>
                            <div class="controls">
                                <input type="text" readonly class="span10" value="<?=_h($this->stuProg[0]['schoolCode'].' '.$this->stuProg[0]['schoolName']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Ant Grad Date' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="antGradDate" class="span2 center" value="<?=_h($this->stuProg[0]['antGradDate']);?>" required />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Status' ) ); ?></label>
                            <div class="controls">
                                <?=stu_prog_status_select(_h($this->stuProg[0]['currStatus']));?>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
						<div class="control-group"<?php if(_h($this->stuProg[0]['currStatus']) == 'G') { echo ' style="display:none"'; } ?>>
						    <label class="control-label"><?php _e( _t( 'Eligible to Graduate?' ) ); ?></label>
							<div class="controls widget-body uniformjs">
    							<label class="checkbox">
									<input type="checkbox" class="checkbox" name="eligible_to_graduate" value="1"<?=checked('1',_h($this->stuProg[0]['eligible_to_graduate']),false);?> />
									<a href="#myModal" data-toggle="modal"><img src="<?=BASE_URL;?>static/common/theme/images/help.png" /></a>
								</label>
							</div>
						</div>
						<!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
					<!-- Column -->
					<div class="span6">
					    
					    <?php if(_h($this->stuProg[0]['currStatus']) == 'G') { ?>
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Graduation Date' ) ); ?></label>
                            <div class="controls">
                                <div class="input-append date" id="datetimepicker6">
                                    <input id="graduationDate" class="center" name="graduationDate"<?=sio();?> type="text" value="<?=_h($this->stuProg[0]['graduationDate']);?>" />
                                    <span class="add-on"><i class="icon-th"></i></span>
                                </div>
                            </div>
                        </div>
                        <!-- // Group END -->
						<?php } ?>
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Start Date' ) ); ?></label>
                            <div class="controls">
                                <div class="input-append date" id="datetimepicker7">
                                    <input id="startDate" class="center" name="startDate" type="text" value="<?=_h($this->stuProg[0]['startDate']);?>" required/>
                                    <span class="add-on"><i class="icon-th"></i></span>
                                </div>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'End Date' ) ); ?></label>
                            <div class="controls">
                                <div class="input-append date" id="datetimepicker8">
                                    <?php if($this->stuProg[0]['endDate'] == NULL || $this->stuProg[0]['endDate'] == '0000-00-00') { ?>
                                    <input id="endDate" name="endDate"<?=sio();?> type="text" />
                                    <?php } else { ?>
                                    <input id="endDate" class="center" name="endDate"<?=sio();?> type="text" value="<?=_h($this->stuProg[0]['endDate']);?>" />
                                    <?php } ?>
                                    <span class="add-on"><i class="icon-th"></i></span>
                                </div>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Approved By' ) ); ?></label>
                            <div class="controls">
                                <input type="text" readonly class="span6" value="<?=_h(get_name($this->stuProg[0]['approvedBy']));?>" />
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
					<button type="submit"<?=sids();?> class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?php _e( _t( 'Save' ) ); ?></button>
					<button type="button"<?=sids();?> class="btn btn-icon btn-primary glyphicons circle_plus" onclick="window.location='<?=BASE_URL;?>student/add_prog/<?=_h($this->stuProg[0]['stuID']);?>/<?=bm();?>'"><i></i><?php _e( _t( 'Add' ) ); ?></button>
					<button type="button" class="btn btn-icon btn-primary glyphicons circle_minus" onclick="window.location='<?=BASE_URL;?>student/view/<?=_h($this->stuProg[0]['stuID']);?>/<?=bm();?>'"><i></i><?php _e( _t( 'Cancel' ) ); ?></button>
				</div>
				<!-- // Form actions END -->
				
			</div>
		</div>
		
		<div class="modal hide fade" id="myModal">
            <div class="modal-body">
                <p><?=_t('Select the checkbox if the student is eligible to graduate from this particular program.');?></p>
            </div>
            <div class="modal-footer">
                <a href="#" data-dismiss="modal" class="btn btn-primary"><?php _e( _t( 'Cancel' ) ); ?></a>
            </div>
        </div>
		<!-- // Widget END -->
		
	</form>
	<!-- // Form END -->
	
</div>	
		
		</div>
		<!-- // Content END -->