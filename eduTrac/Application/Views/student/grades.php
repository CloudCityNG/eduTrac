<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Student Course Sections Grades View
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
 * @since       3.0.1
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
    <li><a href="<?=BASE_URL;?>student/schedule/?term=<?=$this->gradesAssign[0]['termCode'];?>" class="glyphicons calendar"><i></i> <?=_t( 'Schedule' );?></a></li>
    <li class="divider"></li>
	<li><?=_t( 'Grades' );?></li>
</ul>

<h3><?=_t( 'Grades for ' );?><?=$this->gradesAssign[0]['secShortTitle'];?> (<?=$this->gradesAssign[0]['termCode'];?>-<?=$this->gradesAssign[0]['courseSecCode'];?>)</h3>
<div class="innerLR">

	<!-- Widget -->
	<div class="widget widget-heading-simple widget-body-gray">
		<div class="widget-body innerAll inner-2x">
			<!-- Table -->
			<table class="table table-bordered table-striped table-white">
				
				<!-- Table heading -->
				<thead>
					<tr>
						<?php if($this->gradesAssign != '') : foreach($this->gradesAssign as $k => $v) { ?>
						<th class="text-center">
							<span data-toggle="tooltip" data-original-title="<?=$v['title'];?>" data-placement="top">
								<?=$v['shortName'];?>
							</span>
						</th>
						<?php } endif; ?>
					</tr>
				</thead>
				<!-- // Table heading END -->
				
				<!-- Table body -->
				<tbody>
					<?php if($this->gradesStu != '') : foreach($this->gradesStu as $k => $v) { ?>
					<!-- Table row -->
					<tr>
						<?php if($this->gradesAssign != '') : foreach($this->gradesAssign as $key => $value) { ?>
						<td class="text-center"><?php foreach(stuGrades($v['stuID'],$value['assignID']) as $s => $g) : echo $g['grade']; endforeach; ?></td>
						<?php } endif; ?>
					</tr>
					<!-- // Table row END -->
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