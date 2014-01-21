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
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset='UTF-8'>
	
	<title><?=_t( 'General Journal Entry' );?></title>
	
	<link rel='stylesheet' href='<?=BASE_URL;?>static/assets/css/style.css'>
	<link rel='stylesheet' href='<?=BASE_URL;?>static/assets/css/print.css' media="print">

</head>

<body>

	<div id="page-wrap">

		<div id="header"><?=_t( 'General Journal Entry' );?></div>
		
		<div style="clear:both"></div>
		
		<div id="customer">

            <div id="customer-title"><?=SITE_TITLE;?></div>
            
            <div style="clear:both"></div>
            
            <table id="meta-left">
                <tr>
                    <td class="meta-head">Journal ID</td>
                    <td><?=_h($this->jentry[0]['jeID']);?></td>
                </tr>
                <tr>
                    <td class="meta-head">Manual ID</td>
                    <td><?=_h($this->jentry[0]['gl_jentry_manual_id']);?></td>
                </tr>
                <tr>
                    <td class="meta-head">Title</td>
                    <td><?=_h($this->jentry[0]['gl_jentry_title']);?></td>
                </tr>
                <tr>

            </table>

            <table id="meta-right">
                <tr>
                    <td class="meta-head">Description</td>
                    <td><?=_h($this->jentry[0]['gl_jentry_description']);?></td>
                </tr>
                <tr>
                    <td class="meta-head">Posted by</td>
                    <td><?=get_name(_h($this->jentry[0]['gl_jentry_personID']));?></td>
                </tr>
                <tr>

                    <td class="meta-head">Date</td>
                    <td><?=date("D, M d, o",strtotime(_h($this->jentry[0]['gl_jentry_date'])));?></td>
                </tr>

            </table>
		
		</div>
		
		<table id="items">
		
		  <tr>
		      <th>Account</th>
		      <th>Memo</th>
		      <th>Amount</th>
		  </tr>
		  <?php if($this->jentry != '') : foreach($this->jentry as $k => $v) { ?>
		  <tr class="item-row">
		      <td class="item-name"><?=_h($v['gl_acct_name']);?></td>
		      <td class="description"><?=_h($v['gl_trans_memo']);?></td>
		      <?php if(_h($v['gl_trans_debit']) == 0) { ?>
		      <td><?=_h($v['gl_trans_credit']);?></td>
		      <?php } else { ?>
	      	  <td><?=_h($v['gl_trans_debit']);?></td>
	      	  <?php } ?>
		  </tr>
		  <?php } endif; ?>
		  
		  <tr id="hiderow">
		    <td colspan="3">&nbsp;</td>
		  </tr>
		  
		  <tr>
		  		<td colspan="2" class="blank"></td>
		      	<td class="total-line">Debit <?=number_format(0+_h($this->jentryTrans[0]['Debit']));?></td>
		  </tr>
		  <tr>
				<td colspan="2" class="blank"></td>
		    	<td class="total-line">Credit <?=number_format(0+_h($this->jentryTrans[0]['Credit']));?></td>
		  </tr>
		  <tr>
		  		<td colspan="2" class="blank"></td>
		      	<td class="total-line balance">Balance <?=number_format(0+_h($this->jentryTrans[0]['Credit'])+_h($this->jentryTrans[0]['Debit']));?></td>
		  </tr>
		
		</table>
		
		<div id="terms">
		  <div><?=_t( 'This computer generated statement does not need signature.' );?></div>
		</div>
	
	</div>
	
</body>

</html>