<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Course Registration View
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
?>

<script type='text/javascript'>//<![CDATA[ 
$(window).load(function(){
    $("tr input[type=checkbox]").click(function(){
        var countchecked = $("tr input[type=checkbox]:checked").length;
    
        if(countchecked >= <?=_h(Hooks::{'get_option'}('number_of_courses'));?>) 
        {
            $('tr input[type=checkbox]').not(':checked').attr("disabled",true);
        }
        else
        {
            $('tr input[type=checkbox]').not(':checked').attr("disabled",false);
        }
    });
});//]]>  

</script>

<ul class="breadcrumb">
	<li><?=_t( 'You are here' );?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?=_t( 'Dashboard' );?></a></li>
	<li class="divider"></li>
    <li><a href="<?=BASE_URL;?>student/portal/<?=bm();?>" class="glyphicons home"><i></i> <?=_t( 'Student Portal' );?></a></li>
    <li class="divider"></li>
	<li><?=_t( 'Course Registration' );?></li>
</ul>

<h3><?=_t( 'Search Courses' );?></h3>
<div class="innerLR">
	
	<?php if(_h(Hooks::{'get_option'}('reg_instructions')) != '') { ?>
		<div class="widget widget-heading-simple widget-body-white">
			<div class="widget-body">
				<div class="alerts alerts-info">
					<p><?=_h(Hooks::{'get_option'}('reg_instructions'));?></p>
				</div>
			</div>
		</div>
	<?php } ?>
	
	<?php if(student_has_restriction() != false) { ?>
		<div class="widget widget-heading-simple widget-body-white">
			<div class="widget-body">
				<div class="alerts alerts-error">
					<p><?=_t( 'You have a hold on your account which is currently restricting you from registering for a course(s). Please contact the following office(s)/department(s) to inquire about the hold(s) on your account: ' );?><?=student_has_restriction();?></p>
				</div>
			</div>
		</div>
	<?php } ?>

    <!-- Form -->
    <form class="margin-none" action="<?=BASE_URL;?>student/runRegister/" id="validateSubmitForm" method="post" autocomplete="off">

	<!-- Widget -->
	<div class="widget widget-heading-simple widget-body-gray">
		<div class="widget-body">
        
			<!-- Table -->
			<table class="dynamicTable tableTools table table-striped table-bordered table-condensed table-white">
			
				<!-- Table heading -->
				<thead>
					<tr>
						<th class="text-center"><?=_t( 'Term' );?></th>
						<th class="text-center"><?=_t( 'Course Section' );?></th>
						<th class="text-center"><?=_t( 'Title' );?></th>
						<th class="text-center"><?=_t( 'Meeting Day(s)' );?></th>
                        <th class="text-center"><?=_t( 'Time' );?></th>
                        <th class="text-center"><?=_t( 'Credits' );?></th>
                        <th class="text-center"><?=_t( 'Location' );?></th>
                        <th class="text-center"><?=_t( 'Info' );?></th>
                        <th<?=isRegistrationOpen();?> class="text-center"><?=_t( 'Register' );?></th>
					</tr>
				</thead>
				<!-- // Table heading END -->
				
				<!-- Table body -->
				<tbody>
				<?php if($this->courseSec != '') : foreach($this->courseSec as $k => $v) { ?>
                <tr class="gradeX">
                    <td class="text-center"><?=_h($v['termCode']);?></td>
                    <td class="text-center"><?=_h($v['courseSecCode']);?></td>
                    <td class="text-center"><?=_h($v['secShortTitle']);?></td>
                    <td class="text-center"><?=_h($v['dotw']);?></td>
                    <td class="text-center"><?=_h($v['startTime'].' To '.$v['endTime']);?></td>
                    <td class="text-center"><?=_h($v['minCredit']);?></td>
                    <td class="text-center"><?=_h($v['locationName']);?></td>
                    <td>
                    	<center><button data-toggle="modal" data-target="#info-<?=_h($v['courseSecID']);?>" class="btn btn-xs btn-purple" type="button"><i class="fa fa-info"></i></button></center>
                    	<!-- Modal -->
						<div class="modal fade" id="info-<?=_h($v['courseSecID']);?>">
							
							<div class="modal-dialog">
								<div class="modal-content">
						
									<!-- Modal heading -->
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h3 class="modal-title"><?=_h($v['termCode']);?>-<?=_h($v['courseSecCode']);?> <?=_t( 'Section Info' );?></h3>
									</div>
									<!-- // Modal heading END -->
									
									<!-- Modal body -->
									<div class="modal-body">
										<table>
                                    		<tr>
                                    			<td><strong><?=_t( 'Instructor:' );?></strong></td>
                                    			<td><?=get_name(_h($v['facID']));?></td>
                                    		</tr>
                                    		<tr>
                                    			<td><strong><?=_t( 'Description:' );?></strong></td>
                                    			<td><?=strip_tags($v['courseDesc'],'<p><a><em><i><b>');?></td>
                                    		</tr>
                                    		<tr>
                                    			<td><strong><?=_t( 'Comment:' );?></strong></td>
                                    			<td><?=_h(strip_tags($v['comment']));?></td>
                                    		</tr>
                                    		<tr>
                                    			<td><strong><?=_t( 'Course Fee:' );?></strong></td>
                                    			<td><?=money_format('%i',_h($v['courseFee']));?></td>
                                    		</tr>
                                    		<tr>
                                    			<td><strong><?=_t( 'Lab Fee:' );?></strong></td>
                                    			<td><?=money_format('%i',_h($v['labFee']));?></td>
                                    		</tr>
                                    		<tr>
                                    			<td style="width:100px;"><strong><?=_t( 'Material Fee:' );?></strong></td>
                                    			<td><?=money_format('%i',_h($v['materialFee']));?></td>
                                    		</tr>
                                    	</table>
									</div>
									<!-- // Modal body END -->
									
									<!-- Modal footer -->
									<div class="modal-footer">
										<a href="#" class="btn btn-default" data-dismiss="modal"><?=_t( 'Close' );?></a> 
									</div>
									<!-- // Modal footer END -->
						
								</div>
							</div>
							
						</div>
						<!-- // Modal END -->
                    </td>
                    <td<?=isRegistrationOpen();?> class="text-center">
                        <input type="hidden" name="courseCredits[]" value="<?=_h($v['minCredit']);?>" />
                        <input type="hidden" name="termCode[]" value="<?=_h($v['termCode']);?>" />
                        <?php if(_h($v['termCode']) == Hooks::get_option('registration_term')) : ?>
                        <?php if(student_can_register()) : ?>
                        <input<?=getStuSec(_h($v['courseSecCode']),_h($v['termCode']));?> type="checkbox" name="courseSecCode[]" value="<?=_h($v['courseSecCode']);?>" />
                        <?php endif; endif; ?>
                    </td>
                </tr>
				<?php } endif; ?>
				</tbody>
				<!-- // Table body END -->
				
			</table>
			<!-- // Table END -->
            
            <hr class="separator" />
        		
			<!-- Form actions -->
			<div<?=isRegistrationOpen();?> class="form-actions">
				<button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?=_t( 'Register' );?></button>
			</div>
			<!-- // Form actions END -->
			
		</div>
	</div>
    
    </form>
    <!-- // Form END -->
	
</div>	
	
		
		</div>
		<!-- // Content END -->