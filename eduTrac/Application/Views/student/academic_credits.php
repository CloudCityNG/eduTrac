<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Student Academic Credits View
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
	<li><a href="<?=BASE_URL;?>student/<?=bm();?>" class="glyphicons search"><i></i> <?php _e( _t( 'Search Student' ) ); ?></a></li>
    <li class="divider"></li>
    <li><a href="<?=BASE_URL;?>student/view/<?=_h($this->student[0]['stuID']);?>/<?=bm();?>" class="glyphicons user"><i></i> <?=get_name(_h($this->student[0]['stuID']));?></a></li>
    <li class="divider"></li>
	<li><?php _e( _t( 'Academic Credits' ) ); ?></li>
</ul>

<h3><?=get_name(_h($this->student[0]['stuID']));?> <?php _e( _t( "ID: " ) ); ?><?=_h($this->student[0]['stuID']);?></h3>
<div class="innerLR">

	<!-- Widget -->
	<div class="widget widget-heading-simple widget-body-gray">
		<div class="widget-body">
		    
			<!-- Table -->
			<table class="dynamicTable tableTools table table-striped table-bordered table-condensed table-white">
			
				<!-- Table heading -->
				<thead>
					<tr>
						<th class="center"><?php _e( _t( 'Course Sec Name' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Title' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Status' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Credits' ) ); ?></th>
						<th class="center"><?php _e( _t( 'CEU\'s' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Term' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Grade' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Actions' ) ); ?></th>
					</tr>
				</thead>
				<!-- // Table heading END -->
				
				<!-- Table body -->
				<tbody>
				<?php if($this->acadCred != '') : foreach($this->acadCred as $k => $v) { ?>
                <tr class="gradeX">
                    <td class="center"><?=_h($v['courseSecCode']);?></td>
                    <td class="center"><?=_h($v['secShortTitle']);?></td>
                    <td class="center"><?=_h($v['status']);?></td>
                    <td class="center"><?=_h($v['courseCredits']);?></td>
                    <td class="center"><?=_h($v['ceu']);?></td>
                    <td class="center"><?=_h($v['termCode']);?></td>
                    <td class="center"><?=_h($v['grade']);?></td>
                    <td class="center">
                    	<a href="<?=BASE_URL;?>student/view_academic_credits/<?=_h($v['id']);?>/<?=bm();?>" title="View Academic Credits" class="btn btn-circle"><i class="icon-eye-open"></i></a>
                    </td>
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