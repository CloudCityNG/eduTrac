<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * Employee Job Positions View
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
 * @since       3.0.2
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */
?>

<ul class="breadcrumb">
	<li><?=_t( 'You are here' );?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?=_t( 'Dashboard' );?></a></li>
	<li class="divider"></li>
	<li><a href="<?=BASE_URL;?>hr/<?=bm();?>" class="glyphicons search"><i></i> <?=_t( 'Search Employee' );?></a></li>
	<li class="divider"></li>
	<li><?=_t( 'Positions' );?></li>
</ul>

<h3><?=_t( 'Positions Past & Present for ' );?><?=get_name(_h($this->positions[0]['staffID']));?></h3>
<div class="innerLR">

	<!-- Widget -->
	<div class="widget widget-heading-simple widget-body-gray">
		<div class="widget-body">
		
			<!-- Table -->
			<table class="dynamicTable tableTools table table-striped table-bordered table-condensed table-white">
			
				<!-- Table heading -->
				<thead>
					<tr>
						<th class="text-center"><?=_t( 'Pay Grade' );?></th>
						<th class="text-center"><?=_t( 'Job Title' );?></th>
						<th class="text-center"><?=_t( 'Hourly Wage' );?></th>
						<th class="text-center"><?=_t( 'Weekly Hours' );?></th>
						<th class="text-center"><?=_t( 'Monthly Salary' );?></th>
						<th class="text-center"><?=_t( 'Hire Date' );?></th>
						<th class="text-center"><?=_t( 'Start Date' );?></th>
						<th class="text-center"><?=_t( 'End Date' );?></th>
						<th class="text-center"><?=_t( 'Actions' );?></th>
					</tr>
				</thead>
				<!-- // Table heading END -->
				
				<!-- Table body -->
				<tbody>
				<?php if($this->positions != '') : foreach($this->positions as $k => $v) { ?>
                <tr class="gradeX">
                    <td class="text-center"><?=_h($v['grade']);?></td>
                    <td class="text-center"><?=_h($v['title']);?></td>
                    <td class="text-center">$<?=money_format("%i",_h($v['hourly_wage']));?></td>
                    <td class="text-center"><?=_h($v['weekly_hours']);?></td>
                    <td class="text-center">$<?=money_format("%i",_h($v['hourly_wage'])*_h($v['weekly_hours'])*4);?></td>
                    <td class="text-center"><?=date('D, M d, o',strtotime(_h($v['hireDate'])));?></td>
                    <td class="text-center"><?=date('D, M d, o',strtotime(_h($v['startDate'])));?></td>
                    <td class="text-center">
                    	<?php if(_h($v['endDate']) == NULL || _h($v['endDate']) == '0000-00-00') : ?>
                    	<?=_t('Not Set');?>
                    	<?php else : ?>
                		<?=date('D, M d, o',strtotime(_h($v['endDate'])));?>
                		<?php endif; ?>
                    </td>
                    <td class="text-center">
                        <a href="#position<?=_h($v['sMetaID']);?>" data-toggle="modal" title="Edit Position" class="btn btn-default"><i class="fa fa-edit"></i></a>
                    </td>
                </tr>
				<?php } endif; ?>
				</tbody>
				<!-- // Table body END -->
				
			</table>
			<!-- // Table END -->
			
		</div>
	</div>
	<div class="separator bottom"></div>
	
	<?php if($this->positions != '') : foreach($this->positions as $k => $v) { ?>
    <div class="modal fade" id="position<?=_h($v['sMetaID']);?>">
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>hr/runEditPosition/" id="validateSubmitForm" method="post" autocomplete="off">
		<div class="modal-dialog">
			<div class="modal-content">
				
				<!-- Modal heading -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 class="modal-title"><?=_t( 'Add Position' );?></h3>
				</div>
				<!-- // Modal heading END -->
            	
            	<!-- Modal body -->
				<div class="modal-body">
					<div class="widget-body">
            
		                <!-- Row -->
		                <div class="row">
				            <!-- Group -->
				            <div class="form-group">
				                <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Employment Type' );?></label>
				                <div class="col-md-8">
				                    <select name="jobStatusCode" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true" required>
				                        <option value="">&nbsp;</option>
				                        <?php table_dropdown('job_status','','typeCode','typeCode','type',_h($v['jobStatusCode'])); ?>
				                    </select>
				                </div>
				            </div>
				            <!-- // Group END -->
				            
				            <!-- Group -->
				            <div class="form-group">
				                <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Staff Type' );?></label>
				                <div class="col-md-8">
				                    <select name="staffType" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true" required>
				                        <option value="">&nbsp;</option>
				                        <option value="FAC"<?=selected('FAC',_h($v['staffType']),false);?>><?=_t( 'Faculty' );?></option>
				                        <option value="STA"<?=selected('STA',_h($v['staffType']),false);?>><?=_t( 'Staff' );?></option>
				                    </select>
				                </div>
				            </div>
				            <!-- // Group END -->
				            
				            <!-- Group -->
				            <div class="form-group">
				                <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Supervisor' );?></label>
				                <div class="col-md-8">
				                    <select name="supervisorID" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true" required>
				                        <option value="">&nbsp;</option>
				                        <?php supervisor(_h($v['staffID']),_h($v['supervisorID'])); ?>
				                    </select>
				                </div>
				            </div>
				            <!-- // Group END -->
				            
				            <!-- Group -->
				            <div class="form-group">
				                <label class="col-md-3 control-label"><font color="red">*</font> <?=_t( 'Job Title' );?></label>
				                <div class="col-md-8">
				                    <select name="jobID" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true" required>
				                        <option value="">&nbsp;</option>
				                        <?php table_dropdown('job','','ID','ID','title',_h($v['jobID'])); ?>
				                    </select>
				                </div>
				            </div>
				            <!-- // Group END -->
				            
				            <!-- Group -->
				            <div class="form-group">
				                <label class="col-md-3 control-label"><?=_t( 'Hire Date' );?></label>
				                <div class="col-md-8">
				                    <div class="input-group date" id="datepicker6">
				                        <input class="form-control" name="hireDate" type="text" value="<?=$v['hireDate'];?>" />
				                        <span class="input-group-addon"><i class="fa fa-th"></i></span>
				                    </div>
				                </div>
				            </div>
				            <!-- // Group END -->
				            
				            <!-- Group -->
				            <div class="form-group">
				                <label class="col-md-3 control-label"><?=_t( 'Start Date' );?></label>
				                <div class="col-md-8">
				                    <div class="input-group date" id="datepicker7">
				                        <input class="form-control" name="startDate" type="text" value="<?=$v['startDate'];?>" />
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
				                        <?php if(_h($v['endDate']) == NULL || _h($v['endDate']) == '0000-00-00') : ?>
				                        <input class="form-control" name="endDate" type="text" />
				                        <?php else : ?>
				                        <input class="form-control" name="endDate" type="text" value="<?=$v['endDate'];?>" />
				                        <?php endif; ?>
				                        <span class="input-group-addon"><i class="fa fa-th"></i></span>
				                    </div>
				                </div>
				            </div>
				            <!-- // Group END -->
			            </div>
		            </div>
	            </div>
		        <div class="modal-footer">
		            <input type="hidden" name="sMetaID" value="<?=$v['sMetaID'];?>" />
		            <input type="hidden" name="staffID" value="<?=$v['staffID'];?>" />
		            <button type="submit" class="btn btn-circle"><?=_t( 'Update' );?></button>
		            <button data-dismiss="modal" class="btn btn-primary"><?=_t( 'Cancel' );?></button>
		        </div>
	        </div>
       	</div>
   	</form>
    </div>
    <!-- Form -->
    <?php } endif; ?>
	
	<!-- // Widget END -->
	
</div>	
	
		
		</div>
		<!-- // Content END -->