<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Billing Table View
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
 * @since       1.0.3
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */
?>

<ul class="breadcrumb">
	<li><?php _e( _t( 'You are here') ); ?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><?php _e( _t( 'Billing Table' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Billing Table' ) ); ?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>financial/runBillTable/" id="validateSubmitForm" method="post" autocomplete="off">
		
		<!-- Widget -->
		<div class="widget widget-heading-simple widget-body-gray">
		
			<!-- Widget heading -->
			<div class="widget-head">
				<h4 class="heading"><font color="red">*</font> <?php _e( _t( 'Indicates field is required' ) ); ?></h4>
			</div>
			<!-- // Widget heading END -->
			
			<div class="widget-body">
			
				<!-- Row -->
				<div class="row-fluid">
					
					<!-- Column -->
					<div class="span6">
					
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="name"><font color="red">*</font> <?php _e( _t( 'Name' ) ); ?></label>
							<div class="controls"><input class="span12" id="name" name="name" type="text" required /></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="amount"><font color="red">*</font> <?php _e( _t( 'Amount' ) ); ?></label>
							<div class="controls">
							    <div class="input-prepend input-append">
                                    <span class="add-on">$</span>
                                        <input class="span12" id="appendedPrependedInput" name="amount" type="text" placeholder="100,000" required />
                                    <span class="add-on">.00</span>
                                </div>
						    </div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
                        <div class="control-group">
                            <label class="control-label" for="status"><font color="red">*</font> <?php _e( _t( 'Status' ) ); ?></label>
                            <div class="controls">
                                <select style="width:30%" name="status" id="select2_9" required>
                                    <option value="">&nbsp;</option>
                                    <option value="A"><?php _e( _t( 'Active' ) ); ?></option>
                                    <option value="I"><?php _e( _t( 'Inactive' ) ); ?></option>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
				</div>
				<!-- // Row END -->
			
				<hr class="separator" />
				
				<!-- Form actions -->
				<div class="form-actions">
					<button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?php _e( _t( 'Save' ) ); ?></button>
				</div>
				<!-- // Form actions END -->
				
			</div>
		</div>
		<!-- // Widget END -->
		
	</form>
	<!-- // Form END -->
	
    <div class="separator bottom"></div>
	
	<!-- Widget -->
    <div class="widget widget-heading-simple widget-body-gray">
        <div class="widget-body">
        
            <!-- Table -->
            <table class="dynamicTable tableTools table table-striped table-bordered table-condensed table-primary">
            
                <!-- Table heading -->
                <thead>
                    <tr>
                        <th class="center"><?php _e( _t( 'Name' ) ); ?></th>
                        <th class="center"><?php _e( _t( 'Amount' ) ); ?></th>
                        <th class="center"><?php _e( _t( 'Status' ) ); ?></th>
                        <th class="center"><?php _e( _t( 'Action' ) ); ?></th>
                    </tr>
                </thead>
                <!-- // Table heading END -->
                
                <!-- Table body -->
                <tbody>
                <?php if($this->billingTable != '') : foreach($this->billingTable as $key => $value) { ?>
                <tr class="gradeX">
                    <td class="center"><?=_h($value['name']);?></td>
                    <td class="center">$<?=_h($value['amount']);?></td>
                    <td class="center"><?=_h($value['Status']);?></td>
                    <td class="center">
                        <a href="#myModal<?=_h($value['ID']);?>" data-toggle="modal" title="View" class="btn btn-circle"><i class="icon-edit"></i></a>
                    </td>
                </tr>
                <?php } endif; ?>
                    
                </tbody>
                <!-- // Table body END -->
                
            </table>
            <!-- // Table END -->
            
        </div>
    </div>
    <!-- // Widget END -->
    
    <?php if($this->billingTable != '') : foreach($this->billingTable as $key => $value) { ?>
        <!-- Form -->
        <form class="form-horizontal margin-none" action="<?=BASE_URL;?>financial/runBillTable/" id="validateSubmitForm" method="post" autocomplete="off">
            <div class="modal hide fade" id="myModal<?=_h($value['ID']);?>">
                <div class="modal-body">
                    <!-- Group -->
                    <div class="control-group">
                        <label class="control-label" for="name"><font color="red">*</font> <?php _e( _t( 'Name' ) ); ?></label>
                        <div class="controls"><input class="span3" id="name" name="name" type="text" value="<?=_h($value['name']);?>" required /></div>
                    </div>
                    <!-- // Group END -->
                    
                    <!-- Group -->
                    <div class="control-group">
                        <label class="control-label" for="amount"><font color="red">*</font> <?php _e( _t( 'Amount' ) ); ?></label>
                        <div class="controls">
                            <div class="input-prepend input-append">
                                <span class="add-on">$</span>
                                    <input class="span3" id="appendedPrependedInput" name="amount" type="text" value="<?=str_replace('.00','',_h($value['amount']));?>" required />
                                <span class="add-on">.00</span>
                            </div>
                        </div>
                    </div>
                    <!-- // Group END -->
                    
                    <!-- Group -->
                    <div class="control-group">
                        <label class="control-label" for="status"><font color="red">*</font> <?php _e( _t( 'Status' ) ); ?></label>
                        <div class="controls">
                            <select style="width:30%" name="status" required>
                                <option value="">&nbsp;</option>
                                <option value="A"<?=selected('A',_h($value['status']),false);?>><?php _e( _t( 'Active' ) ); ?></option>
                                <option value="I"<?=selected('I',_h($value['status']),false);?>><?php _e( _t( 'Inactive' ) ); ?></option>
                            </select>
                        </div>
                    </div>
                    <!-- // Group END -->
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="update" value="1" />
                    <input type="hidden" name="ID" value="<?=_h($value['ID']);?>" />
                    <button type="submit" class="btn btn-circle"><?php _e( _t( 'Update' ) ); ?></button>
                    <button data-dismiss="modal" class="btn btn-primary"><?php _e( _t( 'Cancel' ) ); ?></button>
                </div>
            </div>
        </form>
        <!-- // Form END -->
    <?php } endif; ?>
	
</div>	
	
		
		</div>
		<!-- // Content END -->