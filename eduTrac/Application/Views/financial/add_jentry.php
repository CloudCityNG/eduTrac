<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Add General Ledger Journal Entry View
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

<script type="text/javascript">
$(document).ready(function() {
	//update total function.
	function update_balance() { 
		debit_amnt = 0;
		credit_amnt = 0;
		balance_amnt = 0;
		i = 1;
			$('.amount').each(function(i){
				amount = parseInt($(this).val());
			if(amount < 0) {
				if(!isNaN(amount)) {
				credit_amnt = amount+credit_amnt;
				}
			} else { 
				if(!isNaN(amount)) {
				debit_amnt = amount+debit_amnt;
				}
			}
			$('#debit_amnt').html(debit_amnt);
			$('#credit_amnt').html(credit_amnt);
			$('#balance_amnt').html(debit_amnt+credit_amnt);
			});
	}//function update_balance Ends here.
//calculations.
$('#items').on('change', '.amount', function(){
	if(isNaN($(this).val())) {
		$(this).val('');
		alert('Please enter number.');
	}
	update_balance();
});
//Remove row.
$('#items').on('click', '.delme', function() {
   $(this).parents('.item-row').remove();
	update_balance();
});
//add row add here.
$("#addrow").click(function(){
$(".item-row:last").after('<tr class="item-row"><td class="center item-name"><select style="width:100%" name="glacctID[]" class="glacctID" required><option value="">&nbsp;</option><?php gl_acct_dropdown(); ?></select></td><td><textarea id="mustHaveId" class="span12" name="gl_trans_memo[]" placeholder="Transaction Description" rows="2"></textarea></td><td><input type="text" name="amount[]" class="span12 amount" required/></td><td><a href="javascript:;" title="Remove row" class="delme btn btn-circle"><i class="icon-minus"></i></a></td></tr>');
});
  			$('#validateSubmitForm').submit(function(e) {
$('.amount').each(function() {
    if($(this).val().length == 0) { 
		error = 1;
	} else { 
		error = 0;
	}
});
$('.glacctID').each(function() {
    if($(this).val().length == 0) { 
		error1 = 1;
	} else { 
		error1 = 0;
	}
});
if($('#balance_amnt').html() != "0") { 
alert("Error: Journal entry balance must equal 0 (zero)");
	return false;
} else if(error != 0) { 
	alert("All amount fields are required.");
	return false;
} else if(error1 != 0) { 
	alert("You have to select all accounts.");
			return false;
		}
	});
});	
</script>

<ul class="breadcrumb">
    <li><?php _e( _t( 'You are here' ) ); ?></li>
    <li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
    <li class="divider"></li>
    <li><?php _e( _t( 'Add Journal Entry' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Add Journal Entry' ) ); ?></h3>
<div class="innerLR">

    <!-- Form -->
    <form class="form-horizontal margin-none" action="<?=BASE_URL;?>financial/runjEntry/" id="validateSubmitForm" method="post" autocomplete="off">
        
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
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Date' ) ); ?></label>
                            <div class="controls">
                                <div class="input-append date" id="datetimepicker6">
                                    <input name="gl_jentry_date" type="text" required/>
                                    <span class="add-on"><i class="icon-th"></i></span>
                                </div>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><font color="red">*</font> <?php _e( _t( 'Entry Title' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="gl_jentry_title" class="span12" required />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                    <!-- // Column END -->
                    
                    <!-- Column -->
                    <div class="span6">
                    	
                    	<!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Manual ID' ) ); ?></label>
                            <div class="controls">
                                <input type="text" name="gl_jentry_manual_id" class="span12" />
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label"><?php _e( _t( 'Description' ) ); ?></label>
                            <div class="controls">
                                <textarea id="mustHaveId" class="span12" name="gl_jentry_description" placeholder="Journal Entry Description" rows="2"></textarea>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                    </div>
                    <!-- // Column END -->
                    
                </div>
                <!-- // Row END -->
                
                <hr class="separator" />
                
                <!-- Row -->
                <div class="row-fluid">
                    <!-- Column -->
                    <div class="span12">
                        
                        <!-- Group -->
	                        <!-- Table -->
							<table id="items" class="table table-bordered table-white">
								
								<strong><small><font style="color:green;"><?=_t( 'Include -(minus) symbol before the credit amount.' );?></font></small></strong>
								
								<!-- Table heading -->
								<thead>
									<tr>
										<th class="center"><font color="red">*</font> <?=_t( 'GL Acount' );?></th>
										<th><?=_t( 'Memo' );?></th>
										<th><font color="red">*</font> <?=_t( 'Amount' );?></th>
										<th>&nbsp;</th>
									</tr>
								</thead>
								<!-- // Table heading END -->
								
								<!-- Table body -->
								<tbody>
									
									<!-- Table row -->
									<tr class="item-row">
										<td class="item-name">
											<select style="width:100%" name="glacctID[]" class="glacctID" required>
			                                    <option value="">&nbsp;</option>
			                                    <?php gl_acct_dropdown(); ?>
			                                </select>
										</td>
										<td>
											<textarea id="mustHaveId" class="span12" name="gl_trans_memo[]" placeholder="Transaction Description" rows="2"></textarea>
										</td>
										<td>
											<input type="text" name="amount[]" class="span12 amount" required/>
										</td>
										<td><a id="addrow" href="javascript:;" title="Add a row" class="btn btn-circle"><i class="icon-plus"></i></a></td>
									</tr>
									<!-- // Table row END -->
									
									<!-- Table row -->
									<tr>
										<td class="right" colspan="4" style="padding-right:2em;">
											<?=_t( 'Debit: ');?> <span style="font-weight:600;" id="debit_amnt">0.00</span><br />
							                <?=_t( 'Credit: ');?> <span style="font-weight:600;" id="credit_amnt">0.00</span> <br />
							                <?=_t( 'Balance:' );?>  <span style="font-weight:600;" id="balance_amnt">0.00</span><br />
										</td>
									</tr>
									<!-- // Table row END -->
									
								</tbody>
								<!-- // Table body END -->
								
							</table>
							<!-- // Table END -->
                        <!-- // Group END -->
                        
                    </div>
                    <!-- // Column END -->
                    
                </div>
                <!-- // Row END -->
                
                <hr class="separator" />
                
                <!-- Form actions -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?php _e( _t( 'Submit' ) ); ?></button>
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