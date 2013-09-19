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
 * @since       1.0.0
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */
?>

<ul class="breadcrumb">
	<li><?php _e( _t( 'You are here' ) ); ?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
    <li><a href="<?=BASE_URL;?>student/portal/<?=bm();?>" class="glyphicons home"><i></i> <?php _e( _t( 'Student Portal' ) ); ?></a></li>
    <li class="divider"></li>
	<li><?php _e( _t( 'Course Registration' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Search Courses' ) ); ?></h3>
<div class="innerLR">

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
						<th class="center"><?php _e( _t( 'Course Sec ID' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Course Sec Code' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Title' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Meeting Day(s)' ) ); ?></th>
                        <th class="center"><?php _e( _t( 'Time' ) ); ?></th>
                        <th class="center"><?php _e( _t( 'Credits' ) ); ?></th>
                        <th class="center"><?php _e( _t( 'Location' ) ); ?></th>
                        <th<?=isRegistrationOpen();?> class="center"><?php _e( _t( 'Register' ) ); ?></th>
					</tr>
				</thead>
				<!-- // Table heading END -->
				
				<!-- Table body -->
				<tbody>
				<?php if($this->courseSec != '') : foreach($this->courseSec as $k => $v) { ?>
                <tr class="gradeX">
                    <td class="center"><?=_h($v['courseSecID']);?></td>
                    <td class="center"><?=_h($v['courseSecCode']);?></td>
                    <td class="center"><?=_h($v['secShortTitle']);?></td>
                    <td class="center"><?=_h($v['dotw']);?></td>
                    <td class="center"><?=_h($v['startTime'].' To '.$v['endTime']);?></td>
                    <td class="center"><?=_h($v['minCredit']);?></td>
                    <td class="center"><?=_h($v['locationName']);?></td>
                    <td<?=isRegistrationOpen();?> class="center">
                        <input type="hidden" name="courseCredits[]" value="<?=_h($v['minCredit']);?>" />
                        <input type="hidden" name="termID[]" value="<?=_h($v['termID']);?>" />
                        <input<?=getStuSec(_h($v['courseSecID']));?> type="checkbox" name="courseSecID[]" value="<?=_h($v['courseSecID']);?>" />
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
				<button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?php _e( _t( 'Register' ) ); ?></button>
			</div>
			<!-- // Form actions END -->
			
		</div>
	</div>
    
    </form>
    <!-- // Form END -->
	
</div>	
	
		
		</div>
		<!-- // Content END -->