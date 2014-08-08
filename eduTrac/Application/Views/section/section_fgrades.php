<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Course Section Final Grading View
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
 * @since       4.2.2
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */
?>

<ul class="breadcrumb">
	<li><?=_t( 'You are here' );?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?=_t( 'Dashboard' );?></a></li>
	<li class="divider"></li>
	<li><a href="<?=BASE_URL;?>section/<?=bm();?>" class="glyphicons search"><i></i> <?=_t( 'Search Section' );?></a></li>
	<li class="divider"></li>
	<li><a href="<?=BASE_URL;?>section/view/<?=_h($this->secGrade[0]['courseSecID']);?>/<?=bm();?>" class="glyphicons adjust_alt"><i></i> <?=_h($this->secGrade[0]['termCode']);?>-<?=_h($this->secGrade[0]['courseSecCode']);?></a></li>
    <li class="divider"></li>
	<li><?=_t( 'Course Section Final Grades' );?></li>
</ul>

<h3><?=_t( 'Final Grades for ' );?><?=$this->secGrade[0]['secShortTitle'];?> (<?=$this->secGrade[0]['termCode'];?>-<?=$this->secGrade[0]['courseSecCode'];?>)</h3>
<div class="innerLR">

    <!-- Form -->
    <form class="form-horizontal margin-none" action="<?=BASE_URL;?>section/runFinalGrade" id="validateSubmitForm" method="post" autocomplete="off">

	<!-- Widget -->
	<div class="widget widget-heading-simple widget-body-gray">
		<div class="widget-body">
			
			<!-- Table -->
			<table class="table table-striped table-bordered table-condensed table-white">
			
				<!-- Table heading -->
				<thead>
					<tr>
                        <th class="text-center"><?=_t( 'Course Section' );?></th>
						<th class="text-center"><?=_t( 'Student' );?></th>
						<th class="text-center"><?=_t( 'Grade' );?></th>
                        <th style="display:none;">&nbsp;</th>
					</tr>
				</thead>
				<!-- // Table heading END -->
				
				<!-- Table body -->
				<tbody>
                <?php if($this->secGrade != '') : foreach($this->secGrade as $k => $v) { ?>
                <tr class="gradeX">
                    <td class="text-center"><?=_h($v['termCode'].'-'.$v['courseSecCode']);?></td>
                    <td class="text-center">
                        <?=get_name(_h($v['stuID']));?>
                        <input type="hidden" name="stuID[]" value="<?=_h($v['stuID']);?>" />
                    </td>
                    <td class="text-center">
                        <?=grading_scale(_h($v['grade']));?>
                    </td>
                    <td style="display:none;">
                        <input type="hidden" name="courseSecCode" value="<?=_h($v['courseSecCode']);?>" />
                        <input type="hidden" name="termCode" value="<?=_h($v['termCode']);?>" />
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
			    <?php if($this->secGrade != '') : foreach($this->secGrade as $k => $v) { ?>
			    <input type="hidden" name="cmplCredit" value="<?=_h($v['minCredit']);?>" />
			    <?php } endif; ?>
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