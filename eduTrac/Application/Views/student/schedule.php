<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Student Schedule View
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
    <li><a href="<?=BASE_URL;?>student/portal/<?=bm();?>" class="glyphicons home"><i></i> <?=_t( 'Student Portal' );?></a></li>
    <li class="divider"></li>
    <li><a href="<?=BASE_URL;?>student/terms/<?=bm();?>" class="glyphicons flag"><i></i> <?=_t( 'Terms' );?></a></li>
    <li class="divider"></li>
	<li><?=_t( 'Schedule' );?></li>
</ul>

<h3><?=_t( 'Schedule' );?></h3>
<div class="innerLR">

	<!-- Widget -->
	<div class="widget widget-heading-simple widget-body-gray">
		<div class="widget-body">
        
			<!-- Table -->
			<table class="dynamicTable tableTools table table-striped table-bordered table-condensed table-white">
			
				<!-- Table heading -->
				<thead>
					<tr>
						<th class="text-center"><?=_t( 'Course Code' );?></th>
						<th class="text-center"><?=_t( 'Title' );?></th>
						<th class="text-center"><?=_t( 'Building' );?></th>
                        <th class="text-center"><?=_t( 'Room' );?></th>
                        <th class="text-center"><?=_t( 'Day(s) of the Week' );?></th>
                        <th class="text-center"><?=_t( 'Time' );?></th>
						<th class="text-center"><?=_t( 'Instructor' );?></th>
					</tr>
				</thead>
				<!-- // Table heading END -->
				
				<!-- Table body -->
				<tbody>
				<?php if($this->schedule != '') : foreach($this->schedule as $k => $v) { ?>
                <tr class="gradeX">
                    <td class="text-center"><?=_h($v['courseSecCode']);?></td>
                    <td class="text-center"><?=_h($v['secShortTitle']);?></td>
                    <td class="text-center"><?=_h($v['buildingName']);?></td>
                    <td class="text-center"><?=_h($v['roomNumber']);?></td>
                    <td class="text-center"><?=_h($v['dotw']);?></td>
                    <td class="text-center"><?=_h($v['startTime'].' To '.$v['endTime']);?></td>
                    <td class="text-center"><?=get_name(_h($v['facID']));?></td>
                </tr>
				<?php } endif; ?>
				</tbody>
				<!-- // Table body END -->
				
			</table>
			<!-- // Table END -->
			
		</div>
	</div>
	
	<!-- // Widget END -->
	
</div>	
	
		
		</div>
		<!-- // Content END -->