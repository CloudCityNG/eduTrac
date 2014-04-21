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
 * @since       3.0.0
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */

$cron = new \eduTrac\Classes\Libraries\Cron;
?>

<ul class="breadcrumb">
	<li><?=_t( 'You are here' );?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?=_t( 'Dashboard' );?></a></li>
	<li class="divider"></li>
	<li><?=_t( 'Cron Jobs' );?></li>
</ul>

<h3><?=_t( 'Cron Jobs' );?></h3>
<div class="innerLR">

	<!-- Widget -->
	<div class="widget widget-heading-simple widget-body-gray">
		<div class="widget-body">
		
			<!-- Table -->
			<table class="dynamicTable tableTools table table-striped table-bordered table-condensed table-white">
			
				<!-- Table heading -->
				<thead>
					<tr>
						<th class="text-center"><?=_t( 'Job Name' );?></th>
						<th class="text-center"><?=_t( 'Last Fired' );?></th>
						<th class="text-center"><?=_t( 'Next Execution' );?></th>
						<th class="text-center"><?=_t( 'Interval' );?></th>
						<th class="text-center"><?=_t( 'Action' );?></th>
					</tr>
				</thead>
				<!-- // Table heading END -->
				
				<!-- Table body -->
				<tbody>
				<?php if($this->cronList != '') : foreach($this->cronList as $key => $value) { ?>
                <tr class="gradeX">
                    <td class="text-center"><?=_h($value['name']);?></td>
                    <td class="text-center">
                        <?php if(_h((int)$value['time_last_fired']) == 0) {
                            echo '<font color="#FF8000">Not yet fired</font>'; 
                        } else {
                            echo strftime("%H:%M:%S ",_h($value['time_last_fired']));
                            echo strftime("on %b %d, %Y",_h($value['time_last_fired']));
                        } ?>
                    </td>
                    <td class="text-center">
                        <?php
                            echo strftime("%H:%M:%S ",_h($value['fire_time']));
                            echo strftime("%b %d, %Y",_h($value['fire_time']));
                        ?>
                    </td>
                    <td class="text-center">
                        <?php
                            $time_interval = $cron->time_unit(_h((int)$value['time_interval']));
                            echo _h((int)$time_interval[0]) . ' ' . $time_interval[1];
                        ?>
                    </td>
                    <td class="text-center">
                    	<div class="btn-group dropup">
                            <button class="btn btn-default btn-xs" type="button"><?=_t( 'Actions' ); ?></button>
                            <button data-toggle="dropdown" class="btn btn-xs btn-primary dropdown-toggle" type="button">
                                <span class="caret"></span>
                                <span class="sr-only"><?=_t( 'Toggle Dropdown' ); ?></span>
                            </button>
                            <ul role="menu" class="dropdown-menu dropup-text pull-right">
                                <li><a href="<?=BASE_URL;?>cron/view/<?=_h($value['id']);?>/<?=bm();?>"><?=_t( 'View' ); ?></a></li>
                            </ul>
                        </div>
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