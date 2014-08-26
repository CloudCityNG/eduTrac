<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * View Academic Credits View
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
    <li><a href="<?=BASE_URL;?>student/view/<?=_h($this->viewAcadCred[0]['stuID']);?>/<?=bm();?>" class="glyphicons user"><i></i> <?=get_name(_h($this->viewAcadCred[0]['stuID']));?></a></li>
    <li class="divider"></li>
    <li><a href="<?=BASE_URL;?>student/academic_credits/<?=_h($this->viewAcadCred[0]['stuID']);?>/<?=bm();?>" class="glyphicons coins"><i></i> <?=_t( 'Academic Credits' );?></a></li>
    <li class="divider"></li>
    <li><?=_t( 'View Academic Credits' );?></li>
</ul>

<h3><?=get_name(_h($this->viewAcadCred[0]['stuID']));?>: <?=_h($this->viewAcadCred[0]['stuID']);?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>student/runAcadCred/" id="validateSubmitForm" method="post" autocomplete="off">
		
		<!-- Widget -->
		<div class="widget widget-heading-simple widget-body-gray">
			
			<div class="widget-body">
			
				<!-- Row -->
				<div class="row">
					<!-- Column -->
					<div class="col-md-6">
						
						<!-- Group -->
						<div class="form-group">
							<label class="col-md-3 control-label"><?=_t( 'Course ID' );?> <a href="<?=BASE_URL;?>course/view/<?=_h($this->viewAcadCred[0]['courseID']);?>/<?=bm();?>"><img src="<?=BASE_URL;?>static/common/theme/images/cascade.png" /></a></label>
							<div class="col-md-8">
								<input type="text" readonly value="<?=_h($this->viewAcadCred[0]['courseID']);?>" class="form-control" required />
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="form-group">
							<label class="col-md-3 control-label"><?=_t( 'Course Name' );?></label>
							<div class="col-md-8">
								<input type="text" readonly value="<?=_h($this->viewAcadCred[0]['courseCode']);?>" class="form-control" required />
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Section' );?></label>
                            <div class="col-md-8">
                                <input type="text" readonly value="<?=_h($this->viewAcadCred[0]['sectionNumber']);?>" class="form-control" required />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Title' );?></label>
                            <div class="col-md-8">
                                <input type="text" readonly value="<?=_h($this->viewAcadCred[0]['secShortTitle']);?>" class="form-control" required />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Subject' );?></label>
                            <div class="col-md-8">
                                <input type="text" readonly value="<?=_h($this->viewAcadCred[0]['subjectCode']);?>" class="form-control" required />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Department' );?></label>
                            <div class="col-md-8">
                                <input type="text" readonly value="<?=_h($this->viewAcadCred[0]['deptCode']);?>" class="form-control" required />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Start Date' );?></label>
                            <div class="col-md-8">
                                <input type="text" readonly value="<?=_h($this->viewAcadCred[0]['startDate']);?>" class="form-control" required />
                            </div>
                        </div>
                        <!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
					<!-- Column -->
					<div class="col-md-6">
						
						<!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'End Date' );?></label>
                            <div class="col-md-8">
                                <input type="text" readonly value="<?=_h($this->viewAcadCred[0]['endDate']);?>" class="form-control" required />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Term' );?></label>
                            <div class="col-md-8">
                                <input type="text" readonly value="<?=_h($this->viewAcadCred[0]['termCode']);?>" class="form-control" required />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Reporting term' );?></label>
                            <div class="col-md-8">
                                <input type="text" readonly value="<?=_h($this->viewAcadCred[0]['reportingTerm']);?>" class="form-control" required />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Grade' );?></label>
                            <div class="col-md-8">
                                <input type="text" name="grade"<?=sio();?> value="<?=getAcadCredGrade(_h($this->viewAcadCred[0]['courseSecCode']),_h($this->viewAcadCred[0]['termCode']));?>" class="form-control" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Status' );?></label>
                            <div class="col-md-8">
                                <?=stu_course_sec_status_select(_h($this->viewAcadCred[0]['status']));?>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Status Date' );?></label>
                            <div class="col-md-8">
                                <div class="input-group date" id="datepicker6">
                                    <input class="form-control" name="statusDate"<?=sio();?> value="<?=_h($this->viewAcadCred[0]['statusDate']);?>" type="text" required/>
                                    <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                </div>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?=_t( 'Status Time' );?></label>
                            <div class="col-md-4">
                                <div class="input-group bootstrap-timepicker">
                                    <input id="timepicker10" type="text" name="statusTime"<?=sio();?> class="form-control" value="<?=_h($this->viewAcadCred[0]['statusTime']);?>" required />
                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                </div>
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
				    <input type="hidden" name="id" value="<?=_h($this->viewAcadCred[0]['id']);?>" />
				    <input type="hidden" name="stuID" value="<?=_h($this->viewAcadCred[0]['stuID']);?>" />
                    <input type="hidden" name="courseSecCode" value="<?=_h($this->viewAcadCred[0]['courseSecCode']);?>" />
                    <input type="hidden" name="termCode" value="<?=_h($this->viewAcadCred[0]['termCode']);?>" />
					<button type="submit"<?=sids();?> class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?=_t( 'Save' );?></button>
					<button type="button" class="btn btn-icon btn-primary glyphicons circle_minus" onclick="window.location='<?=BASE_URL;?>student/academic_credits/<?=_h($this->viewAcadCred[0]['stuID']);?>/<?=bm();?>'"><i></i><?=_t( 'Cancel' );?></button>
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