<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Journal Entries View
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
 * @since       1.1.5
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */
?>

<ul class="breadcrumb">
	<li><?=_t( 'You are here' );?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?=_t( 'Dashboard' );?></a></li>
	<li class="divider"></li>
	<li><?=_t( 'Journal Entries' );?></li>
</ul>

<h3><?=_t( 'Journal Entries' );?> <a href="<?=BASE_URL;?>financial/add_jentry/" title="Add Journal Entry" class="btn btn-circle"><i class="icon-plus"></i></a></h3>
<div class="innerLR">

	<!-- Widget -->
	<div class="widget widget-heading-simple widget-body-gray">
		<div class="widget-body">
			
			<!-- Table -->
			<table class="dynamicTable tableTools table table-striped table-bordered table-condensed table-white">
			
				<!-- Table heading -->
				<thead>
					<tr>
						<th class="center"><?=_t( 'Date' );?></th>
						<th class="center"><?=_t( 'Manual ID' );?></th>
						<th class="center"><?=_t( 'Title' );?></th>
						<th class="center"><?=_t( 'Description' );?></th>
						<th class="center"><?=_t( 'Posted By' );?></th>
						<th class="center"><?=_t( 'Amount' );?></th>
						<th class="center"><?=_t( 'Actions' );?></th>
					</tr>
				</thead>
				<!-- // Table heading END -->
				
				<!-- Table body -->
				<tbody>
				<?php if($this->jentry != '') : foreach($this->jentry as $k => $v) { ?>
                <tr class="gradeX">
                    <td class="center"><?=_h($v['gl_jentry_date']);?></td>
                    <td class="center"><?=_h($v['gl_jentry_manual_id']);?></td>
                    <td class="center"><?=_h($v['gl_jentry_title']);?></td>
                	<td class="center"><?=_h($v['gl_jentry_description']);?></td>
                	<td class="center"><?=get_name(_h($v['gl_jentry_personID']));?></td>
                	<td class="center"><?=_h(number_format($v['Debits']));?></td>
                    <td class="center">
                    	<a href="<?=BASE_URL;?>financial/view_jentry/<?=_h($v['jeID']);?>" target="new" title="View Journal Entry" class="btn btn-circle"><i class="icon-eye-open"></i></a>
                    	<a href="#deljentry<?=_h($v['jeID']);?>" data-toggle="modal" title="Delete Journal Entry" class="btn btn-circle"><i class="icon-trash"></i></a>
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