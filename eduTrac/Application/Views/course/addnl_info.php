<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * Additional Course View
 *  
 * PHP 5
 *
 * eduTrac(tm) : Student Information System (http://www.7mediaws.org/)
 * Copyright (C) 2013 Joshua Parker
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
 * @since eduTrac(tm) v 1.0
 * @license GNU General Public License v3 (http://www.gnu.org/licenses/gpl-3.0.html)
 */

use \eduTrac\Classes\Libraries\Hooks;
$courseList = new \eduTrac\Classes\DBObjects\Course;
$list = '"'.implode('","', $courseList->crseList(_h($this->addnl[0]['courseID']))).'"';
?>

<script type="text/javascript">
$(function() {
    $("#select2_course").select2({tags:[<?=$list;?>]});
});
</script>

<ul class="breadcrumb">
	<li><?php _e( _t( 'You are here' ) ); ?></li>
	<li><a href="<?=BASE_URL?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><a href="<?=BASE_URL;?>course/<?=bm();?>" class="glyphicons search"><i></i> <?php _e( _t( 'Search Course' ) ); ?></a></li>
	<li class="divider"></li>
	<li><a href="<?=BASE_URL;?>course/view/<?=_h($this->addnl[0]['courseID']);?>/<?=bm();?>" class="glyphicons adjust_alt"><i></i> <?=_h($this->addnl[0]['courseCode']);?></a></li>
    <li class="divider"></li>
	<li><?php _e( _t( 'View Course' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Additional Course Info:' ) ); ?> <?=_h($this->addnl[0]['courseCode']);?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>course/runAddnl/" id="validateSubmitForm" method="post" autocomplete="off">
		
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
							<label class="control-label"><?php _e( _t( 'Prerequisites' ) ); ?></label>
							<div class="controls">
                            	<input type="text" id="select2_course"<?=cio();?> name="preReq" value="<?=_h($this->addnl[0]['preReq']);?>" class="span10" />
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label"><font color="red">*</font> <?php _e( _t( 'Allow Audit' ) ); ?></label>
							<div class="controls">
								<select style="width:25%;" name="allowAudit" id="select2_11"<?=cio();?> required>
									<option value="">&nbsp;</option>
	                        		<option value="1"<?=selected(_h((int)$this->addnl[0]['allowAudit']),'1',false);?>><?php _e( _t( 'Yes' ) ); ?></option>
	                        		<option value="0"<?=selected(_h((int)$this->addnl[0]['allowAudit']),'0',false);?>><?php _e( _t( 'No' ) ); ?></option>
	                        	</select>
	                       </div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Allow Waitlist' ) ); ?></label>
                            <div class="controls">
                                <select style="width:25%;" name="allowWaitlist" id="select2_12"<?=cio();?> required>
                                    <option value="">&nbsp;</option>
                                    <option value="1"<?=selected(_h((int)$this->addnl[0]['allowWaitlist']),'1',false);?>><?php _e( _t( 'Yes' ) ); ?></option>
                                    <option value="0"<?=selected(_h((int)$this->addnl[0]['allowWaitlist']),'0',false);?>><?php _e( _t( 'No' ) ); ?></option>
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
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Minimum Enrollment' ) ); ?></label>
                            <div class="controls">
                                <input type="text"<?=cio();?> name="minEnroll" value="<?=_h((int)$this->addnl[0]['minEnroll']);?>" class="span10" required />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Seating Capacity' ) ); ?></label>
                            <div class="controls">
                                <input type="text"<?=cio();?> name="seatCap" value="<?=_h((int)$this->addnl[0]['seatCap']);?>" class="span10" required />
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
					<input type="hidden" name="courseID" value="<?=_h($this->addnl[0]['courseID']);?>" class="span10" />
					<button type="submit"<?=cids();?> class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?php _e( _t( 'Save' ) ); ?></button>
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