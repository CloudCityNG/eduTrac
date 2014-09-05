<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Additional Course View
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

use \eduTrac\Classes\Libraries\Hooks;
$message = new \eduTrac\Classes\Libraries\Messages;
$courseList = new \eduTrac\Classes\DBObjects\Course;
$list = '"'.implode('","', $courseList->crseList(_h($this->addnl[0]['courseID']))).'"';
?>

<script type="text/javascript">
$(function() {
    $("#select2_5").select2({tags:[<?=$list;?>]});
});
$(".success-panel").show();
setTimeout(function() { $(".success-panel").hide(); }, 5000);
</script>

<ul class="breadcrumb">
	<li><?=_t( 'You are here' );?></li>
	<li><a href="<?=BASE_URL?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?=_t( 'Dashboard' );?></a></li>
	<li class="divider"></li>
	<li><a href="<?=BASE_URL;?>course/<?=bm();?>" class="glyphicons search"><i></i> <?=_t( 'Search Course' );?></a></li>
	<li class="divider"></li>
	<li><a href="<?=BASE_URL;?>course/view/<?=_h($this->addnl[0]['courseID']);?>/<?=bm();?>" class="glyphicons adjust_alt"><i></i> <?=_h($this->addnl[0]['courseCode']);?></a></li>
    <li class="divider"></li>
	<li><?=_h($this->addnl[0]['courseCode']);?></li>
</ul>

<h3><?=_t( 'Additional Course Info:' );?> <?=_h($this->addnl[0]['courseCode']);?></h3>
<div class="innerLR">
	
	<?=$message->flashMessage();?>

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>course/runAddnl/" id="validateSubmitForm" method="post" autocomplete="off">
		
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
                            <label class="col-md-3 control-label"><?=_t( 'Prerequisites' );?></label>
							<div class="col-md-8"><input id="select2_5" style="width:100%;" type="hidden"<?=cio();?> name="preReq" value="<?=_h($this->addnl[0]['preReq']);?>" /></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Allow Audit' );?></label>
							<div class="col-md-8">
								<select name="allowAudit" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true"<?=cio();?> required>
									<option value="">&nbsp;</option>
	                        		<option value="1"<?=selected(_h((int)$this->addnl[0]['allowAudit']),'1',false);?>><?=_t( 'Yes' );?></option>
	                        		<option value="0"<?=selected(_h((int)$this->addnl[0]['allowAudit']),'0',false);?>><?=_t( 'No' );?></option>
	                        	</select>
	                       </div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Allow Waitlist' );?></label>
                            <div class="col-md-8">
                                <select name="allowWaitlist" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true"<?=cio();?> required>
                                    <option value="">&nbsp;</option>
                                    <option value="1"<?=selected(_h((int)$this->addnl[0]['allowWaitlist']),'1',false);?>><?=_t( 'Yes' );?></option>
                                    <option value="0"<?=selected(_h((int)$this->addnl[0]['allowWaitlist']),'0',false);?>><?=_t( 'No' );?></option>
                                </select>
                           </div>
                        </div>
                        <!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
					<!-- Column -->
					<div class="col-md-6">
					    
					    <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Minimum Enrollment' );?></label>
                            <div class="col-md-8"><input class="form-control" type="text"<?=cio();?> name="minEnroll" value="<?=_h((int)$this->addnl[0]['minEnroll']);?>" required /></div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Seating Capacity' );?></label>
                            <div class="col-md-8"><input class="form-control" type="text"<?=cio();?> name="seatCap" value="<?=_h((int)$this->addnl[0]['seatCap']);?>" required /></div>
                        </div>
                        <!-- // Group END -->
						
					</div>
					<!-- // Column END -->
				</div>
				<!-- // Row END -->
			
				<hr class="separator" />
				
				<!-- Form actions -->
				<div class="form-actions">
					<input type="hidden" name="courseID" value="<?=_h($this->addnl[0]['courseID']);?>" />
					<button type="submit"<?=cids();?> class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?=_t( 'Save' );?></button>
                    <button type="button" class="btn btn-icon btn-primary glyphicons circle_minus" onclick="window.location='<?=BASE_URL;?>course/view/<?=_h($this->addnl[0]['courseID']);?>/<?=bm();?>'"><i></i><?=_t( 'Cancel' );?></button>
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