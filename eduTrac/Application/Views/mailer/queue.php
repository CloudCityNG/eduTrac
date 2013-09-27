<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Mailer Queue View
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
	<li><a href="<?=BASE_URL;?>mailer/<?=bm();?>" class="glyphicons e-mail"><i></i> <?php _e( _t( 'Email Templates' ) ); ?></a></li>
	<li class="divider"></li>
	<li><?php _e( _t( 'Email Queue' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Email Queue' ) ); ?></h3>
<div class="innerLR">

	<!-- Widget -->
	<div class="widget widget-heading-simple widget-body-gray">
		<div class="widget-body">
			
			<!-- Table -->
			<table class="dynamicTable tableTools table table-striped table-bordered table-condensed table-white">
			
				<!-- Table heading -->
				<thead>
					<tr>
						<th class="center"><?php _e( _t( 'Subject' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Query' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Processed' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Actions' ) ); ?></th>
					</tr>
				</thead>
				<!-- // Table heading END -->
				
				<!-- Table body -->
				<tbody>
				<?php if($this->queue != '') : foreach($this->queue as $k => $v) { ?>
                <tr class="gradeX">
                    <td class="center"><?=_h($v['subject']);?></td>
                    <td class="center"><?=_h($v['savedQueryName']);?></td>
                    <td class="center"><?=_h($v['Status']);?></td>
                    <td class="center">
                        <a href="#myModal<?=_h($v['id']);?>" data-toggle="modal" title="Delete" class="btn btn-danger"><i class="icon-trash"></i></a>
                        <div class="modal hide fade" id="myModal<?=_h($v['id']);?>">
                            <div class="modal-body">
                                <p><?=_t('Are you sure you want to delete "'._h($v['subject']).'" from the queue?');?></p>
                            </div>
                            <div class="modal-footer">
                                <a href="<?=BASE_URL;?>mailer/deleteQueue/<?=_h($v['id']);?>" class="btn btn-circle"><?php _e( _t( 'Yes' ) ); ?></a>
                                <a href="#" data-dismiss="modal" class="btn btn-primary"><?php _e( _t( 'Cancel' ) ); ?></a>
                            </div>
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