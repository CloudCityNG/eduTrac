<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * General Ledger Accounts View
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
	<li><?=_t( 'Chart of Accounts' );?></li>
</ul>

<h3>
	<?=_t( 'Chart of Accounts' );?> 
	<a href="#addglAccount" data-toggle="modal" title="Add New Account" class="btn btn-circle"><i class="icon-plus"></i></a> 
	<a href="<?=BASE_URL;?>financial/jentry_filter/" title="Journal Entries" class="btn btn-circle"><i class="icon-search"></i></a>
	<a href="<?=BASE_URL;?>financial/gl_filter/" title="General Ledger Summary" class="btn btn-circle"><i class="icon-search"></i></a>
</h3>
<div class="innerLR">

	<!-- Widget -->
	<div class="widget widget-heading-simple widget-body-gray">
		<div class="widget-body">
			
			<!-- Table -->
			<table class="dynamicTable tableTools table table-striped table-bordered table-condensed table-white">
			
				<!-- Table heading -->
				<thead>
					<tr>
						<th class="center"><?=_t( 'Account Number' );?></th>
						<th class="center"><?=_t( 'Name' );?></th>
						<th class="center"><?=_t( 'Type' );?></th>
						<th class="center"><?=_t( 'Balance' );?></th>
						<th class="center"><?=_t( 'Actions' );?></th>
					</tr>
				</thead>
				<!-- // Table heading END -->
				
				<!-- Table body -->
				<tbody>
				<?php if($this->glAccount != '') : foreach($this->glAccount as $k => $v) { ?>
				<?php $balance = 0+_h($v['gl_trans_debit'])+_h($v['gl_trans_credit']); ?>
                <tr class="gradeX">
                    <td class="center"><?=_h($v['gl_acct_number']);?></td>
                    <td class="center"><?=_h($v['gl_acct_name']);?></td>
                    <td class="center"><?=_h($v['gl_acct_type']);?></td>
                    <?php if($balance < 0) : ?>
                    <td class="center" style="color:red;"><?=number_format($balance);?></td>
                    <?php else : ?>
                	<td class="center"><?=number_format($balance);?></td>
                	<?php endif; ?>
                    <td class="center">
                    	<!--<a href="<?=BASE_URL;?>financial/view_ledger/" title="View Ledger" class="btn btn-circle"><i class="icon-eye-open"></i></a>-->
                    	<a href="#viewglAccount<?=_h($v['glacctID']);?>" data-toggle="modal" title="Edit Account" class="btn btn-circle"><i class="icon-edit"></i></a>
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
    
    <!-- Form -->
    <form class="form-horizontal margin-none" action="<?=BASE_URL;?>financial/runGLAccount/" id="validateSubmitForm" method="post" autocomplete="off">
    <div class="modal hide fade" id="addglAccount">
        <div class="modal-body">
            <!-- Group -->
            <div class="control-group">
                <label class="control-label"><font color="red">*</font> <?=_t( 'Account #' );?></label>
                <div class="controls">
                    <input type="text" name="gl_acct_number" id="gl_acct_number" class="span4" required />
                </div>
            </div>
            <!-- // Group END -->
            
            <!-- Group -->
            <div class="control-group">
                <label class="control-label"><font color="red">*</font> <?=_t( 'Account Name' );?></label>
                <div class="controls">
                    <input type="text" name="gl_acct_name" id="gl_acct_name" class="span4" required />
                </div>
            </div>
            <!-- // Group END -->
            
            <!-- Group -->
            <div class="control-group">
                <label class="control-label"><font color="red">*</font> <?=_t( 'Account Type' );?></label>
                <div class="controls">
                    <?=general_ledger_type_select();?>
                </div>
            </div>
            <!-- // Group END -->
            
            <!-- Group -->
            <div class="control-group">
                <label class="control-label"><?=_t( 'Memo' );?></label>
                <div class="controls">
                    <textarea id="mustHaveId" class="span4" name="gl_acct_memo" rows="2"></textarea>
                </div>
            </div>
            <!-- // Group END -->
        </div>
        <div class="modal-footer">
        	<button type="submit" class="btn btn-circle"><?=_t( 'Update' );?></button>
            <button data-dismiss="modal" class="btn btn-primary"><?=_t( 'Cancel' );?></button>
        </div>
    </div>
    </form>
    <!-- Form -->
    
    <?php if($this->glAccount != '') : foreach($this->glAccount as $k => $v) { ?>
    <!-- Form -->
    <form class="form-horizontal margin-none" action="<?=BASE_URL;?>financial/runEditGLAccount/" id="validateSubmitForm" method="post" autocomplete="off">
    <div class="modal hide fade" id="viewglAccount<?=_h($v['glacctID']);?>">
        <div class="modal-body">
            <!-- Group -->
            <div class="control-group">
                <label class="control-label"><font color="red">*</font> <?=_t( 'Account #' );?></label>
                <div class="controls">
                    <input type="text" name="gl_acct_number" id="gl_acct_number" class="span4" value="<?=$v['gl_acct_number'];?>" required />
                </div>
            </div>
            <!-- // Group END -->
            
            <!-- Group -->
            <div class="control-group">
                <label class="control-label"><font color="red">*</font> <?=_t( 'Account Name' );?></label>
                <div class="controls">
                    <input type="text" name="gl_acct_name" id="gl_acct_name" class="span4" value="<?=$v['gl_acct_name'];?>" required />
                </div>
            </div>
            <!-- // Group END -->
            
            <!-- Group -->
            <div class="control-group">
                <label class="control-label"><font color="red">*</font> <?=_t( 'Account Type' );?></label>
                <div class="controls">
                    <?=general_ledger_type_select($v['gl_acct_type']);?>
                </div>
            </div>
            <!-- // Group END -->
            
            <!-- Group -->
            <div class="control-group">
                <label class="control-label"><?=_t( 'Memo' );?></label>
                <div class="controls">
                    <textarea id="mustHaveId" class="span4" name="gl_acct_memo" rows="2"><?=$v['gl_acct_memo'];?></textarea>
                </div>
            </div>
            <!-- // Group END -->
        </div>
        <div class="modal-footer">
        	<input type="hidden" name="id" value="<?=$v['glacctID'];?>" />
        	<button type="submit" class="btn btn-circle"><?=_t( 'Update' );?></button>
            <button data-dismiss="modal" class="btn btn-primary"><?=_t( 'Cancel' );?></button>
        </div>
    </div>
    </form>
    <!-- Form -->
    <?php } endif; ?>
	
	<!-- // Widget END -->
	
</div>	
	
		
		</div>
		<!-- // Content END -->