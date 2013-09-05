<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * Audit Trail View
 *  
 * PHP 5
 *
 * eduTrac(tm) : Student Information System (http://www.7mediaws.org/)
 * Copyright (C) 2013 Joshua Parker
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
 * @since eduTrac(tm) v 1.0
 * @license GNU General Public License v3 (http://www.gnu.org/licenses/gpl-3.0.html)
 */
?>

<ul class="breadcrumb">
	<li><?php _e( _t( 'You are here' ) ); ?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><?php _e( _t( 'Audit Trail' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Audit Trail' ) ); ?></h3>
<div class="innerLR">

	<!-- Widget -->
	<div class="widget widget-heading-simple widget-body-gray">
		<div class="widget-body">
		
			<!-- Table -->
			<table class="dynamicTable tableTools table table-striped table-bordered table-condensed table-white">
			
				<!-- Table heading -->
				<thead>
					<tr>
						<th class="center"><?php _e( _t( 'Action' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Process' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Record' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Username' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Action Date' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Expire Date' ) ); ?></th>
					</tr>
				</thead>
				<!-- // Table heading END -->
				
				<!-- Table body -->
				<tbody>
				<?php if($this->logList != '') : foreach($this->logList as $key => $value) { ?>
                <tr class="gradeX">
                    <td class="center"><?=_h($value['action']);?></td>
                    <td class="center"><?=_h($value['process']);?></td>
                    <td class="center"><?=_h($value['record']);?></td>
                    <td class="center"><?=_h($value['uname']);?></td>
                    <td class="center"><?=date('D, M d, o',strtotime(_h($value['created_at'])));?></td>
                    <td class="center"><?=date('D, M d, o',strtotime(_h($value['expires_at'])));?></td>
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