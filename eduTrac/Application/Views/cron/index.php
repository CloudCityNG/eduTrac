<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Cron Jobs View
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

$cron = new \eduTrac\Classes\Libraries\Cron;
?>

<ul class="breadcrumb">
	<li><?php _e( _t( 'You are here' ) ); ?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><?php _e( _t( 'Cron Jobs' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Cron Jobs' ) ); ?></h3>
<div class="innerLR">

	<!-- Widget -->
	<div class="widget widget-heading-simple widget-body-gray">
		<div class="widget-body">
		
			<!-- Table -->
			<table class="dynamicTable tableTools table table-striped table-bordered table-condensed table-white">
			
				<!-- Table heading -->
				<thead>
					<tr>
						<th class="center"><?php _e( _t( 'Job Name' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Last Fired' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Next Execution' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Interval' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Action' ) ); ?></th>
					</tr>
				</thead>
				<!-- // Table heading END -->
				
				<!-- Table body -->
				<tbody>
				<?php if($this->cronList != '') : foreach($this->cronList as $key => $value) { ?>
                <tr class="gradeX">
                    <td class="center"><?=_h($value['name']);?></td>
                    <td class="center">
                        <?php if(_h((int)$value['time_last_fired']) == 0) {
                            echo '<font color="#FF8000">Not yet fired</font>'; 
                        } else {
                            echo strftime("%H:%M:%S ",_h($value['time_last_fired']));
                            echo strftime("on %b %d, %Y",_h($value['time_last_fired']));
                        } ?>
                    </td>
                    <td class="center">
                        <?php
                            echo strftime("%H:%M:%S ",_h($value['fire_time']));
                            echo strftime("%b %d, %Y",_h($value['fire_time']));
                        ?>
                    </td>
                    <td class="center">
                        <?php
                            $time_interval = $cron->time_unit(_h((int)$value['time_interval']));
                            echo _h((int)$time_interval[0]) . ' ' . $time_interval[1];
                        ?>
                    </td>
                    <td class="center">
                    	<a href="<?=BASE_URL;?>cron/view/<?=_h($value['id']);?>/<?=bm();?>" title="View Cron Job" class="btn btn-circle"><i class="icon-eye-open"></i></a>
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