<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * View Bill View
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
 * @since       1.0.4
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */
$courseFees = $this->courseFees[0]['CourseFee'] + $this->courseFees[0]['LabFee'] + $this->courseFees[0]['MaterialFee'];
$beginBalance = bcadd($this->beginBalance[0],'-'.$courseFees,2);
$endBalance = bcadd($beginBalance,$this->sumPayments[0],2);
$currentBalance = bcsub($endBalance,$this->sumRefund[0],2);
?>

<ul class="breadcrumb">
    <li><?php _e( _t( 'You are here' ) ); ?></li>
    <li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
    <li class="divider"></li>
    <li><a href="<?=BASE_URL;?>financial/<?=bm();?>" class="glyphicons search"><i></i> <?php _e( _t( 'Search Bill' ) ); ?></a></li>
    <li class="divider"></li>
    <li><?php _e( _t( 'View Bill' ) ); ?></li>
</ul>

<h3><?=get_name(_h($this->address[0]['personID']));?></h3>
<div class="innerLR">

    <!-- Form -->
    <form class="form-horizontal margin-none" id="validateSubmitForm" method="post" autocomplete="off">
        
        <!-- Widget -->
        <div class="widget widget-heading-simple widget-body-gray">
            
            <div class="widget-body">
            
                <!-- Row -->
                <div class="row-fluid">
                    
                    <!-- Column -->
                    <div class="span12">
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label" for="address"><?php _e( _t( 'Address' ) ); ?></label>
                            <div class="controls">
                                <input class="span3" type="text" readonly value="<?=_h($this->address[0]['address1']);?> <?=_h($this->address[0]['address2']);?>" />
                                <input class="span3" type="text" readonly value="<?=_h($this->address[0]['city']);?>" />
                                <input class="span3" type="text" readonly value="<?=_h($this->address[0]['state']);?>" />
                                <input class="span3" type="text" readonly value="<?=_h($this->address[0]['zip']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                    <!-- // Column END -->
                    
                    <div class="break"></div>
                    
                    <!-- Column -->
                    <div class="span5">
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label" for="address"><?php _e( _t( 'Billing Date' ) ); ?></label>
                            <div class="controls">
                                <input class="span6" type="text" readonly value="<?=date("D, M d, o @ g:i A",strtotime(_h($this->bill[0]['dateTime'])));?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label" for="address"><?php _e( _t( 'Term' ) ); ?></label>
                            <div class="controls">
                                <input class="span3" type="text" readonly value="<?=_h($this->bill[0]['termName']);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <?php if($this->bill != '') : foreach($this->bill as $k => $v) { ?>
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?=_h($v['name']);?></label>
                            <div class="controls">
                                <input type="text" class="span6" readonly value="$<?=_h($v['amount']);?>" />
                                <input type="hidden" name="ID" value="<?=_h($v['FeeID']);?>" />
                                <a<?=gids();?> href="#bill<?=_h($v['FeeID']);?>" data-toggle="modal" title="Delete Fee" class="btn btn-danger"><i class="icon-trash"></i></a>
                                <div class="modal hide fade" id="bill<?=_h($v['FeeID']);?>">
                                    <div class="modal-body">
                                        <?=_t( 'Are you sure what to delete the '.$v['name'].'?' );?>
                                    </div>
                                    <div class="modal-footer">
                                        <a<?=saids();?> href="<?=BASE_URL;?>financial/deleteFee/<?=_h($v['FeeID']);?>" class="btn btn-circle"><?php _e( _t( 'Delete' ) ); ?></a>
                                        <a href="#" data-dismiss="modal" class="btn btn-primary"><?php _e( _t( 'Cancel' ) ); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <?php } endif; ?>
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Course Fees' ) ); ?></label>
                            <div class="controls">
                                <input type="text" class="span3" readonly value="<?=_h(number_format($courseFees,2));?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Beginning Balance' ) ); ?></label>
                            <div class="controls">
                                <input type="text" style="color:red;" class="span3" readonly value="<?=_h($beginBalance);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Ending Balance' ) ); ?></label>
                            <div class="controls">
                                <input type="text"<?php if($endBalance < 0) { echo ' style="color:red;"'; } ?> class="span3" readonly value="<?=_h($endBalance);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Current Balance' ) ); ?></label>
                            <div class="controls">
                                <input type="text"<?php if($currentBalance < 0) { echo ' style="color:red;"'; } ?> class="span3" readonly value="<?=_h($currentBalance);?>" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                    <!-- // Column END -->
                    
                    <!-- Column -->
                    <div class="span5">
                        
                        <?php if($this->payment != '') : foreach($this->payment as $k => $v) { ?>
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Payment' ) ); ?></label>
                            <div class="controls">
                                <input type="text" class="span4 center" readonly value="$<?=_h($v['amount']);?>" />
                                <input type="text" class="span4 center" readonly value="<?=_h($v['type']);?>" />
                                <a href="#info<?=_h($v['paymentID']);?>" data-toggle="modal" title="View Information" class="btn btn-circle"><i class="icon-info"></i></a>
                                <div class="modal hide fade" id="info<?=_h($v['paymentID']);?>">
                                    <div class="modal-body">
                                        <p><input type="text" class="span5" readonly value="<?=date("D, M d, o @ g:i A",strtotime(_h($v['dateTime'])));?>" /></p>
                                        <p><textarea readonly style="width:97.5%" cols="10" rows="5"><?=_h($v['comment']);?></textarea></p>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="#" data-dismiss="modal" class="btn btn-primary"><?php _e( _t( 'Cancel' ) ); ?></a>
                                    </div>
                                </div>
                                
                                <a<?=gids();?> href="#payment<?=_h($v['paymentID']);?>" data-toggle="modal" title="Delete Payment" class="btn btn-danger"><i class="icon-trash"></i></a>
                                <div class="modal hide fade" id="payment<?=_h($v['paymentID']);?>">
                                    <div class="modal-body">
                                        <?=_t( 'Are you sure what to delete this '.$v['amount'].' '.$v['type'] .' payment?' );?>
                                    </div>
                                    <div class="modal-footer">
                                        <a<?=saids();?> href="<?=BASE_URL;?>financial/deletePayment/<?=_h($v['paymentID']);?>" class="btn btn-circle"><?php _e( _t( 'Delete' ) ); ?></a>
                                        <a href="#" data-dismiss="modal" class="btn btn-primary"><?php _e( _t( 'Cancel' ) ); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <?php } endif; ?>
                        
                        <?php if($this->refund != '') : foreach($this->refund as $k => $v) { ?>
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Refund' ) ); ?></label>
                            <div class="controls">
                                <input type="text" class="span8 center" readonly value="$<?=_h($v['amount']);?>" />
                                <a href="#refund<?=_h($v['refundID']);?>" data-toggle="modal" title="View Information" class="btn btn-circle"><i class="icon-info"></i></a>
                                <div class="modal hide fade" id="refund<?=_h($v['refundID']);?>">
                                    <div class="modal-body">
                                        <p><input type="text" class="span5" readonly value="<?=date("D, M d, o @ g:i A",strtotime(_h($v['dateTime'])));?>" /></p>
                                        <p><textarea readonly style="width:97.5%" cols="10" rows="5"><?=_h($v['comment']);?></textarea></p>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="#" data-dismiss="modal" class="btn btn-primary"><?php _e( _t( 'Cancel' ) ); ?></a>
                                    </div>
                                </div>
                                
                                <a<?=gids();?> href="#deleteRefund<?=_h($v['refundID']);?>" data-toggle="modal" title="Delete Refund" class="btn btn-danger"><i class="icon-trash"></i></a>
                                <div class="modal hide fade" id="deleteRefund<?=_h($v['refundID']);?>">
                                    <div class="modal-body">
                                        <?=_t( 'Are you sure what to delete this '.$v['amount'].' refund?' );?>
                                    </div>
                                    <div class="modal-footer">
                                        <a<?=saids();?> href="<?=BASE_URL;?>financial/deleteRefund/<?=_h($v['refundID']);?>" class="btn btn-circle"><?php _e( _t( 'Delete' ) ); ?></a>
                                        <a href="#" data-dismiss="modal" class="btn btn-primary"><?php _e( _t( 'Cancel' ) ); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <?php } endif; ?>
                        
                    </div>
                    <!-- // Column END -->
                    
                </div>
                <!-- // Row END -->
                
                <hr class="separator" />
                
                <!-- Form actions -->
                <div class="form-actions">
                    <button type="button" class="btn btn-icon btn-primary glyphicons circle_minus" onclick="window.location='<?=BASE_URL;?>financial/<?=bm();?>'"><i></i><?php _e( _t( 'Cancel' ) ); ?></button>
                </div>
                <!-- // Form actions END -->
                
            </div>
        </div>
        <!-- // Widget END -->
        
    </form>
    <!-- // Form END -->
    
</div>  
        
        </div>
        <!-- // Content END -->