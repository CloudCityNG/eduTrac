<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Course Section Attendance View
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
	<li><a href="<?=BASE_URL;?>section/courses/<?=bm();?>" class="glyphicons book"><i></i> <?=_t( 'My Course Sections' );?></a></li>
    <li class="divider"></li>
	<li><?=_t( 'Attendance' );?></li>
</ul>

<h3><?=_t( 'Attendance for ' );?><?=_h($this->attendance[0]['termCode']);?>-<?=_h($this->attendance[0]['courseSecCode']);?></h3>
<div class="innerLR">

    <!-- Form -->
    <form class="form-horizontal margin-none" action="<?=BASE_URL;?>section/runAttendance/" id="validateSubmitForm" method="post" autocomplete="off">

	<!-- Widget -->
	<div class="widget widget-heading-simple widget-body-gray">
		<div class="widget-body">
		    
		    <!-- Group -->
            <div class="form-group">
                <label class="col-md-1 control-label"><?=_t( 'Today\'s Date' );?></label>
                <div class="col-md-3">
                    <input class="form-control" id="date" readonly type="text" value="<?=date('D, M d, o');?>" />
                    <input name="date" type="hidden" value="<?=date('Y-m-d');?>" />
                </div>
            </div>
            <!-- // Group END -->
			
			<!-- Table -->
			<table class="dynamicTable tableTools table table-striped table-bordered table-condensed table-white">
			
				<!-- Table heading -->
				<thead>
					<tr>
						<th class="text-center"><?=_t( 'Student ID' );?></th>
						<th class="text-center"><?=_t( 'Student Name' );?></th>
						<th class="text-center"><?=_t( 'Status' );?></th>
                        <th style="display:none;">&nbsp;</th>
					</tr>
				</thead>
				<!-- // Table heading END -->
				
				<!-- Table body -->
				<tbody>
                <?php if($this->attendance != '') : foreach($this->attendance as $k => $v) { ?>
                <tr class="gradeX">
                    <td class="text-center">
                        <?=_h($v['stuID']);?>
                        <input type="hidden" name="stuID[]" value="<?=_h($v['stuID']);?>" />
                    </td>
                    <td class="text-center">
                        <a href="<?=BASE_URL;?>section/attendance_report/<?=_h($v['courseSecCode']);?>&stuID=<?=_h($v['stuID']);?>&term=<?=_h($v['termCode']);?>"><?=get_name(_h($v['stuID']));?></a>
                    </td>
                    <td class="text-center">
                        <select name="status[]" class="selectpicker form-control" data-style="btn-info" data-size="10" data-live-search="true" required>
                            <option value="">&nbsp;</option>
                            <option value="A"<?=selected('A',_h($v['status'],false));?>><?=_t( 'Absent' );?></option>
                            <option value="P"<?=selected('P',_h($v['status'],false));?>><?=_t( 'Present' );?></option>
                        </select>
                    </td>
                    <td style="display:none;">
                        <input type="hidden" name="termCode" value="<?=_h($v['termCode']);?>" />
						<input type="hidden" name="courseSecCode" value="<?=_h($this->attendance[0]['courseSecCode']);?>" />
                    </td>
                </tr>
                <?php } endif; ?>
				</tbody>
				<!-- // Table body END -->
				
			</table>
			<!-- // Table END -->
            
            <hr class="separator" />
    			
			<!-- Form actions -->
			<div class="form-actions">
				<button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?=_t( 'Submit' );?></button>
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