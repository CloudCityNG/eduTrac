<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Course Section Attendance Report View
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
 * @since       1.0.5
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */
?>

<ul class="breadcrumb">
	<li><?php _e( _t( 'You are here' ) ); ?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><a href="<?=BASE_URL;?>section/courses/<?=bm();?>" class="glyphicons book"><i></i> <?php _e( _t( 'My Course Sections' ) ); ?></a></li>
    <li class="divider"></li>
    <li><a href="<?=BASE_URL;?>section/attendance/<?=$this->report[0]['courseSecID'];?>/<?=bm();?>" class="glyphicons charts"><i></i> <?=_h($this->report[0]['courseSecCode']);?> <?php _e( _t( 'Attendance' ) ); ?></a></li>
    <li class="divider"></li>
	<li><?php _e( _t( 'Attendance Report' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Attendance Report' ) ); ?></h3>
<div class="innerLR">

	<!-- Widget -->
	<div class="widget widget-heading-simple widget-body-gray">
		<div class="widget-body">
		    
		    <!-- Row -->
                <div class="row-fluid">
                    <!-- Column -->
                    <div class="span6">
		    
            		    <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Course Section' ) ); ?></label>
                            <div class="controls">
                                <input class="center" id="date" readonly type="text" value="<?=_h($this->report[0]['termCode']).'-'._h($this->report[0]['courseSecCode']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                    
                    <!-- Column -->
                    <div class="span6">
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Student' ) ); ?></label>
                            <div class="controls">
                                <input class="center" id="date" readonly type="text" value="<?=get_name(_h($this->report[0]['stuID']));?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                </div>
            <!-- //Row End -->
			
			<!-- Table -->
			<table class="dynamicTable tableTools table table-striped table-bordered table-condensed table-white">
			
				<!-- Table heading -->
				<thead>
					<tr>
						<th class="center"><?php _e( _t( 'Date' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Status' ) ); ?></th>
					</tr>
				</thead>
				<!-- // Table heading END -->
				
				<!-- Table body -->
				<tbody>
                <?php if($this->report != '') : foreach($this->report as $k => $v) { ?>
                <tr class="gradeX">
                    <td class="center">
                        <?=date('D, M d, o',strtotime($v['date']));?>
                    </td>
                    <td class="center">
                        <?=_h($v['Status']);?>
                    </td>
                </tr>
                <?php } endif; ?>
				</tbody>
				<!-- // Table body END -->
				
			</table>
			<!-- // Table END -->
            
            <hr class="separator" />
			
		</div>
	</div>
	<!-- // Widget END -->
	
</div>	
	
		
		</div>
		<!-- // Content END -->