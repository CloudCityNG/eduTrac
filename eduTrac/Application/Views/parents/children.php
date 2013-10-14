<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Children View
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
 * @since       1.0.2
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */
?>

<ul class="breadcrumb">
	<li><?php _e( _t( 'You are here' ) ); ?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><a href="<?=BASE_URL;?>parents/portal/<?=bm();?>" class="glyphicons home"><i></i> <?php _e( _t( 'Home' ) ); ?></a></li>
	<li class="divider"></li>
	<li><?php _e( _t( 'Children' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Children' ) ); ?></h3>
<div class="innerLR">

	<!-- Widget -->
	<div class="widget widget-heading-simple widget-body-gray">
		<div class="widget-body">
			
			<!-- Table -->
			<table class="dynamicTable tableTools table table-striped table-bordered table-condensed table-white">
			
				<!-- Table heading -->
				<thead>
					<tr>
						<th class="center"><?php _e( _t( 'Child\'s ID' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Last Name' ) ); ?></th>
						<th class="center"><?php _e( _t( 'First Name' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Actions' ) ); ?></th>
					</tr>
				</thead>
				<!-- // Table heading END -->
				
				<!-- Table body -->
				<tbody>
				<?php if($this->childPortal != '') : foreach($this->childPortal as $k => $v) { ?>
                <tr class="gradeX">
                    <td class="center"><?=_h($v['childID']);?></td>
                    <td class="center"><?=_h($v['lname']);?></td>
                    <td class="center"><?=_h($v['fname']);?></td>
                    <td class="center">
                        <a href="<?=BASE_URL;?>parents/grades/<?=$v['childID'];?>" title="View Grades" class="btn btn-circle"><i class="icon-file-text"></i></a>
                        <a href="<?=BASE_URL;?>parents/progress/<?=$v['childID'];?>" title="View Progress Report(s)" class="btn btn-circle"><i class="icon-check"></i></a>
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
	
	<!-- // Widget END -->
	
</div>	
	
		
		</div>
		<!-- // Content END -->