<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Saved Query List View
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
?>

<ul class="breadcrumb">
	<li><?=_t( 'You are here' );?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?=_t( 'Dashboard' );?></a></li>
	<li class="divider"></li>
	<li><?=_t( 'Saved Query' );?></li>
</ul>

<h3><?=_t( 'Saved Query' );?></h3>
<div class="innerLR">
	
	<!-- Widget -->
    <div class="widget widget-heading-simple widget-body-gray">
        <div class="widget-body">
        
            <!-- Table -->
            <table class="dynamicTable tableTools table table-striped table-bordered table-condensed table-primary">
            
                <!-- Table heading -->
                <thead>
                    <tr>
                        <th class="text-center"><?=_t( 'Saved Query Name' );?></th>
                        <th class="text-center"><?=_t( 'Creation Date' );?></th>
                        <th class="text-center"><?=_t( 'Actions' );?></th>
                    </tr>
                </thead>
                <!-- // Table heading END -->
                
                <!-- Table body -->
                <tbody>
                <?php if($this->queryList != '') : foreach($this->queryList as $key => $value) { ?>
                <tr class="gradeX">
                    <td class="text-center"><?=_h($value['savedQueryName']);?></td>
                    <td class="text-center"><?=date('D, M d, o',strtotime(_h($value['createdDate'])));?></td>
                    <td class="text-center">
                        <a href="<?=BASE_URL;?>savequery/view/<?=_h($value['savedQueryID']);?>/<?=bm();?>" title="View Saved Query" class="btn btn-default"><i class="fa fa-eye"></i></a>
                        <a href="#myModal<?=_h($value['savedQueryID']);?>" data-toggle="modal" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
                        <!-- Modal -->
						<div class="modal fade" id="myModal<?=_h($value['savedQueryID']);?>">
							<div class="modal-dialog">
								<div class="modal-content">
									<!-- Modal heading -->
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h3 class="modal-title"><?=_h($value['savedQueryName']);?></h3>
									</div>
									<!-- // Modal heading END -->
									<!-- Modal body -->
									<div class="modal-body">
										<p><?= _t( "Are you sure you want to delete this saved query?" );?></p>
									</div>
									<!-- // Modal body END -->
									<!-- Modal footer -->
									<div class="modal-footer">
										<a href="<?=BASE_URL;?>savequery/delete/<?=_h($value['savedQueryID']);?>" class="btn btn-default"><?=_t( 'Delete' );?></a>
										<a href="#" class="btn btn-primary" data-dismiss="modal"><?=_t( 'Cancel' );?></a> 
									</div>
									<!-- // Modal footer END -->
								</div>
							</div>
						</div>
						<!-- // Modal END -->
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