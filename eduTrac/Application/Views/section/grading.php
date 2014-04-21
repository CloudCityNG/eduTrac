<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Course Section Grading View
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
$auth = new \eduTrac\Classes\Libraries\Cookies;
?>

<ul class="breadcrumb">
	<li><?=_t( 'You are here' );?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?=_t( 'Dashboard' );?></a></li>
	<li class="divider"></li>
	<li><a href="<?=BASE_URL;?>section/courses/<?=bm();?>" class="glyphicons ruller"><i></i> <?=_t( 'Course Sections' );?></a></li>
    <li class="divider"></li>
    <li><a href="<?=BASE_URL;?>section/assignments/<?=$this->grades[0]['courseSecCode'];?>&term=<?=$this->grades[0]['termCode'];?>" class="glyphicons book"><i></i> <?=$this->grades[0]['secShortTitle'];?> (<?=$this->grades[0]['termCode'];?>-<?=$this->grades[0]['courseSecCode'];?>) <?=_t( 'Assignments' );?></a></li>
    <li class="divider"></li>
	<li><?=_t( 'Grades' );?></li>
</ul>

<h3><?=$this->grades[0]['secShortTitle'];?> (<?=$this->grades[0]['termCode'];?>-<?=$this->grades[0]['courseSecCode'];?>) - <?=$this->grades[0]['title'];?></h3>
<div class="innerLR">

    <!-- Form -->
    <form class="form-horizontal margin-none" action="<?=BASE_URL;?>section/runGrades/" id="validateSubmitForm" method="post" autocomplete="off">

	<!-- Widget -->
	<div class="widget widget-heading-simple widget-body-gray">
		<div class="widget-body">
			
			<!-- Table -->
			<table class="table table-striped table-bordered table-condensed table-white">
			
				<!-- Table heading -->
				<thead>
					<tr>
                        <th class="text-center"><?=_t( 'Student' );?></th>
						<th class="text-center"><?=_t( 'Grade' );?></th>
						<th style="display:none;">&nbsp;</th>
					</tr>
				</thead>
				<!-- // Table heading END -->
				
				<!-- Table body -->
				<tbody>
                <?php if($this->grades != '') : foreach($this->grades as $k => $v) { ?>
                <tr class="gradeX">
                    <td class="text-center"><?=get_name(_h($v['stuID']));?></td>
                    <td class="text-center">
                        <?=grades(_h($v['stuID']),_h($v['assignID']));?>
                    </td>
                    <td style="display:none;"><input class="form-control" type="hidden" name="stuID[]" value="<?=_h($v['stuID']);?>" /></td>
                </tr>
                <?php } endif; ?>
				</tbody>
				<!-- // Table body END -->
				
			</table>
			<!-- // Table END -->
            
            <hr class="separator" />
    			
			<!-- Form actions -->
			<div class="form-actions">
			    <input type="hidden" name="assignID" value="<?=_h($this->grades[0]['assignID']);?>" />
                <input type="hidden" name="termCode" value="<?=_h($this->grades[0]['termCode']);?>" />
			    <input type="hidden" name="courseSecCode" value="<?=_h($this->grades[0]['courseSecCode']);?>" />
			    <input type="hidden" name="facID" value="<?=_h($this->grades[0]['facID']);?>" />
			    <input type="hidden" name="addDate" value="<?=date("Y-m-d");?>" />
			    <input type="hidden" name="addedBy" value="<?=$auth->getPersonField('personID');?>" />
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