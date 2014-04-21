<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Studen Restriction View
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

<script type="text/javascript">

function addMsg(text,element_id) {

document.getElementById(element_id).value += text;

}
</script>

<ul class="breadcrumb">
    <li><?=_t( 'You are here' );?></li>
    <li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?=_t( 'Dashboard' );?></a></li>
    <li class="divider"></li>
    <li><a href="<?=BASE_URL;?>student/<?=bm();?>" class="glyphicons search"><i></i> <?=_t( 'Search Student' );?></a></li>
    <li class="divider"></li>
    <li><?=_t( 'Student Restriction' );?></li>
</ul>

<h3><?=get_name(_h($this->student[0]['stuID']));?>: <?=_h($this->student[0]['stuID']);?> <button<?=sids();?> type="button" title="Add Restriction" class="btn btn-default" data-toggle="modal" data-target="#md-ajax"><i class="fa fa-plus"></i></button></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>student/runEditRSTR/" id="validateSubmitForm" method="post" autocomplete="off">
		
		<!-- Table -->
		<table class="table table-striped table-responsive swipe-horizontal table-primary">
		
			<!-- Table heading -->
			<thead>
				<tr>
					<th class="text-center"><?=_t( 'Restriction' );?></th>
                    <th class="text-center"><?=_t( 'Severity' );?></th>
                    <th class="text-center"><?=_t( 'Start Date' );?></th>
                    <th class="text-center"><?=_t( 'End Date' );?></th>
                    <th class="text-center"><?=_t( 'Department' );?></th>
                    <th class="text-center"><?=_t( 'Comments' );?></th>
				</tr>
			</thead>
			<!-- // Table heading END -->
			
			<!-- Table body -->
			<tbody>
				<?php if($this->rstr != '') : foreach($this->rstr as $k => $v) { ?>
				<!-- Table row -->
				<tr class="gradeA">
					<td style="width:300px;">
						<select name="rstrCode[]" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true" required>
                            <option value="">&nbsp;</option>
                            <?=table_dropdown('restriction_code', '', 'rstrCode', 'rstrCode', 'description',_h($v['rstrCode']));?>
                        </select>
					</td>
					<td style="width:80px;"><input type="text" name="severity[]" class="form-control text-center" value="<?=_h($v['severity']);?>" parsley-type="digits" parsley-maxlength="2" /></td>
					<td style="width:160px;">
						<div class="input-group date" id="datepicker6<?=_h($v['rstrID']);?>">
                            <input type="text" name="startDate[]" class="form-control" value="<?=_h($v['startDate']);?>" required/>
                            <span class="input-group-addon"><i class="fa fa-th"></i></span>
                        </div>
					</td>
					<td style="width:160px;">
						<div class="input-group date" id="datepicker7<?=_h($v['rstrID']);?>">
                            <?php if(_h($v['endDate']) != '0000-00-00') : ?>
                            <input type="text" name="endDate[]" class="form-control" value="<?=_h($v['endDate']);?>" />
                            <?php else : ?>
                            <input type="text" name="endDate[]" class="form-control" />
                            <?php endif; ?>
                            <span class="input-group-addon"><i class="fa fa-th"></i></span>
                        </div>
					</td>
					<td><input type="text" readonly class="form-control text-center" value="<?=_h($v['deptCode']);?>" /></td>
					<td class="text-center">
						<button type="button" title="Comment" class="btn bt-sm" data-toggle="modal" data-target="#comments-<?=_h($v['rstrID']);?>"><i class="fa fa-comment"></i></button>
						<!-- Modal -->
						<div class="modal fade" id="comments-<?=_h($v['rstrID']);?>">
							
							<div class="modal-dialog">
								<div class="modal-content">
						
									<!-- Modal heading -->
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h3 class="modal-title"><?=_t( 'Comments' );?></h3>
									</div>
									<!-- // Modal heading END -->
									
									<!-- Modal body -->
									<div class="modal-body">
										<textarea id="<?=_h($v['rstrID']);?>" class="form-control" name="comment[]" rows="5" data-height="auto" parsley-required="true"><?=_h($v['comment']);?></textarea>
                                        <input type="button" value="Insert Timestamp" onclick="addMsg('<?=date('D, M d, o @ h:i A',strtotime(date('Y-m-d h:i A')));?> <?=get_name($auth->getPersonField('personID'));?>','<?=_h($v['rstrID']);?>'); return false;" />
									</div>
									<!-- // Modal body END -->
									
									<!-- Modal footer -->
									<div class="modal-footer">
										<a href="#" class="btn btn-default" data-dismiss="modal"><?=_t( 'Close' );?></a> 
									</div>
									<!-- // Modal footer END -->
						
								</div>
							</div>
							<input type="hidden" name="rstrID[]" value="<?=_h($v['rstrID']);?>" />
						</div>
						<!-- // Modal END -->
					</td>
				</tr>
				<!-- // Table row END -->
				<?php } endif; ?>
				
			</tbody>
			<!-- // Table body END -->
			
		</table>
		<!-- // Table END -->
		<?php if(_h($this->rstr[0]['stuID']) != '') : ?>
		<!-- Form actions -->
		<div class="form-actions">
		    <input type="hidden" name="stuID" value="<?=_h($this->student[0]['stuID']);?>" />
			<button type="submit"<?=sids();?> class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?=_t( 'Save' );?></button>
			<button type="button" class="btn btn-icon btn-primary glyphicons circle_minus" onclick="window.location='<?=BASE_URL;?>student/<?=bm();?>'"><i></i><?=_t( 'Cancel' );?></button>
		</div>
		<!-- // Form actions END -->
		<?php endif; ?>
		
	</form>
	<!-- // Form END -->
	
	<!-- Modal -->
	<div class="modal fade" id="md-ajax">
		<form class="form-horizontal" data-collabel="3" data-alignlabel="left" action="<?=BASE_URL;?>student/runRSTR/" id="validateSubmitForm" method="post" autocomplete="off">
		<div class="modal-dialog">
			<div class="modal-content">
	
				<!-- Modal heading -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 class="modal-title"><?=_t( 'Comments' );?></h3>
				</div>
				<!-- // Modal heading END -->
				
				<!-- Modal body -->
				<div class="modal-body">
					<div class="form-group">
                        <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Restriction' );?></label>
                        <div class="col-md-8">
	                        <?php $bind = [ ":dept" => getuserdata($auth->getPersonField('personID'),'deptCode') ]; ?>
	                        <select name="rstrCode" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true" required>
	                            <option value="">&nbsp;</option>
	                            <?=table_dropdown('restriction_code', 'deptCode=:dept', 'rstrCode', 'rstrCode', 'description','',$bind);?>
	                        </select>
                       </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?=_t( 'Severity' );?></label>
                        <div class="col-md-8">
                        	<input type="text" name="severity" class="form-control" parsley-type="digits" parsley-maxlength="2" />
                    	</div>
                    </div>
                    
                    <div class="form-group">
                    	<label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Start Date' );?></label>
                    	<div class="col-md-8">
	                        <div class="input-group date" id="datepicker9">
	                            <input type="text" name="startDate" class="form-control" required/>
	                            <span class="input-group-addon"><i class="fa fa-th"></i></span>
	                        </div>
                       </div>
                    </div>
                    
                    <div class="form-group">
                    	<label class="col-md-3 control-label"><?=_t( 'End Date' );?></label>
                    	<div class="col-md-8">
	                        <div class="input-group date" id="datepicker9">
	                            <input type="text" name="endDate" class="form-control" />
	                            <span class="input-group-addon"><i class="fa fa-th"></i></span>
	                        </div>
                       </div>
                    </div>
                    
                    <div class="form-group">
                    	<label class="col-md-3 control-label"><?=_t( 'Comment' );?></label>
                    	<div class="col-md-8">
	                        <textarea id="comment" class="form-control" name="comment" rows="5" data-height="auto" parsley-required="true"></textarea>
	                        <input type="button" value="Insert Timestamp" onclick="addMsg('<?=date('D, M d, o @ h:i A',strtotime(date('Y-m-d h:i A')));?> <?=get_name($auth->getPersonField('personID'));?>','comment'); return false;" />
                       </div>
                    </div>
				</div>
				<!-- // Modal body END -->
				
				<!-- Modal footer -->
				<div class="modal-footer">
					<input type="hidden" name="stuID" value="<?=_h($this->student[0]['stuID']);?>" />
                    <input type="hidden" name="addDate" value="<?=date('Y-m-d');?>" />
                    <input type="hidden" name="addedBy" value="<?=$auth->getPersonField('personID');?>" />
					<button type="submit" class="btn btn-default"><?=_t( 'Submit' );?></button>
					<a href="#" class="btn btn-primary" data-dismiss="modal"><?=_t( 'Cancel' );?></a>
				</div>
				<!-- // Modal footer END -->
	
			</div>
		</div>
		</form>
	</div>
	<!-- // Modal END -->
	
</div>	
		
		</div>
		<!-- // Content END -->