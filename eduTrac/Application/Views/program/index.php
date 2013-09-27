<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * Manage Courses View
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
use \eduTrac\Classes\Libraries\Hooks;
?>

<ul class="breadcrumb">
	<li><?php _e( _t( 'You are here' ) ); ?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><?php _e( _t( 'Programs' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Search Program' ) ); ?></h3>
<div class="innerLR">

	<!-- Widget -->
	<div class="widget widget-heading-simple widget-body-gray">
		<div class="widget-body">
		
			<div class="tab-pane" id="search-users">
				<div class="widget widget-heading-simple widget-body-white margin-none">
					<div class="widget-body">
						
						<div class="widget widget-heading-simple widget-body-simple text-right">
							<form class="form-search center" action="<?=BASE_URL;?>program/<?=bm();?>" method="post" autocomplete="off">
							  	<input type="text" name="prog" class="input-xxlarge" placeholder="Search by Department of Program Code . . . " />
							  	<!-- <button type="submit" class="btn btn-inverse">Search</button> -->
							</form>
						</div>
						
					</div>
				</div>
			</div>
			
			<div class="break"></div>
			
			<?php if(isPostSet('prog')) { ?>
			<!-- Table -->
			<table class="dynamicTable tableTools table table-striped table-bordered table-condensed table-white">
			
				<!-- Table heading -->
				<thead>
					<tr>
						<th class="center"><?php _e( _t( 'Program Code' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Program Title' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Status' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Effective Date' ) ); ?></th>
						<th class="center"><?php _e( _t( 'End Date' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Actions' ) ); ?></th>
					</tr>
				</thead>
				<!-- // Table heading END -->
				
				<!-- Table body -->
				<tbody>
				<?php if($this->search != '') : foreach($this->search as $k => $v) { ?>
                <tr class="gradeX">
                    <td class="center"><?=_h($v['acadProgCode']);?></td>
                    <td class="center"><?=_h($v['acadProgTitle']);?></td>
                    <td class="center">
                    	<?php if($v['currStatus'] == 'P') {
                    		echo 'Pending';
                    	} elseif($v['currStatus'] == 'A') {
                    		echo 'Active';
                    	} else {
                    		echo 'Obsolete';
                    	}; ?>
                    </td>
                    <td class="center"><?=_h($v['startDate']);?></td>
                    <td class="center"><?=_h($v['endDate']);?></td>
                    <td class="center">
                    	<a href="<?=BASE_URL;?>program/view/<?=_h($v['acadProgID']);?>/<?=bm();?>" title="View Program" class="btn btn-circle"><i class="icon-eye-open"></i></a>
                        <?php Hooks::do_action('search_acad_program_action'); ?>
                    </td>
                </tr>
				<?php } endif; ?>
				</tbody>
				<!-- // Table body END -->
				
			</table>
			<!-- // Table END -->
			
			<?php } ?>
			
		</div>
	</div>
	<div class="separator bottom"></div>
	<!-- // Widget END -->
	
</div>	
	
		
		</div>
		<!-- // Content END -->