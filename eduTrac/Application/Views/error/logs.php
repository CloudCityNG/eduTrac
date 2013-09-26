<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Error Log View
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

use \eduTrac\Classes\Libraries\Log;
$log = new Log;
?>

<ul class="breadcrumb">
	<li><?php _e( _t( 'You are here' ) ); ?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><?php _e( _t( 'Error Log' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Error Log' ) ); ?></h3>
<div class="innerLR">

	<!-- Widget -->
	<div class="widget widget-heading-simple widget-body-gray">
		<div class="widget-body">
		
			<!-- Table -->
			<table class="dynamicTable tableTools table table-striped table-bordered table-condensed table-primary">
			
				<!-- Table heading -->
				<thead>
					<tr>
						<th class="center"><?php _e( _t( 'Error Type' ) ); ?></th>
						<th class="center"><?php _e( _t( 'String' ) ); ?></th>
						<th class="center"><?php _e( _t( 'File' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Line Number' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Delete' ) ); ?></th>
					</tr>
				</thead>
				<!-- // Table heading END -->
				
				<!-- Table body -->
				<tbody>
				<?php if($this->logs != '') : foreach($this->logs as $k => $v) { ?>
                <tr class="gradeX">
                    <td class="center"><?=$log->error_constant_to_name(_h($v['type']));?></td>
                    <td class="center"><?=_h($v['string']);?></td>
                    <td class="center"><?=_h($v['file']);?></td>
                    <td class="center"><?=_h($v['line']);?></td>
                    <td class="center">
                    	<a href="<?=BASE_URL;?>error/deleteLog/<?=_h($v['ID']);?>" title="Delete Log" class="btn btn-danger"><i class="icon-trash"></i></a>
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