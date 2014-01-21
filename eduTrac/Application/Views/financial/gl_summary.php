<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * General Ledger Summary View
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
	
	<title><?=_t( 'General Ledger Summary' );?></title>
	
	<link rel='stylesheet' href='<?=BASE_URL;?>static/assets/css/style.css'>
	<link rel='stylesheet' href='<?=BASE_URL;?>static/assets/css/print.css' media="print">

</head>

<body>

	<div id="page-wrap">

		<div id="header"><?=_t( 'General Ledger Summary' );?></div>
		
		<div style="clear:both"></div>
		
		<div id="customer">

            <table id="meta-right">
                <tr>
                    <td class="meta-head">Today's Date</td>
                    <td><?=date('Y-m-d');?></td>
                </tr>
                <tr>

                    <td class="meta-head">Statement Period</td>
                    <td><?=date("D, M d, o",strtotime(_h(isGetSet('from'))));?> - <?=date("D, M d, o",strtotime(_h(isGetSet('to'))));?></td>
                </tr>

            </table>
		
		</div>
		
		<table id="items">
		
		  <tr>
		      <th>GL Number</th>
		      <th>Account Title</th>
		      <th>Type</th>
		      <th>Opening</th>
		      <th>Debit</th>
		      <th>Credit</th>
		      <th>Closing</th>
		  </tr>
		  <?php if($this->glfilter != '') : foreach($this->glfilter as $k => $v) { ?>
		  <?php $opening_balance = number_format(0+_h($this->glfilterSum[0]['Debit'])+_h($this->glfilterSum[0]['Credit'])); ?>
		  <tr class="item-row">
		      <td><?=_h($v['gl_acct_number']);?></td>
		      <td><?=_h($v['gl_acct_name']);?></td>
	      	  <td><?=_h($v['gl_acct_type']);?></td>
	      	  <td><?=$opening_balance;?></td>
	      	  <td><?=number_format(0+_h($v['Debit']));?></td>
	      	  <td><?=number_format(0+_h($v['Credit']));?></td>
	      	  <td><?=number_format($opening_balance+0+_h($v['Debit'])+_h($v['Credit']));?></td>
		  </tr>
		  <?php } endif; ?>
		  
		  <tr id="hiderow">
		    <td colspan="7">&nbsp;</td>
		  </tr>
		  
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td class="total-line balance">Total</td>
		      <td class="total-value balance"><div class="due"><?=$opening_balance;?></div></td>
		      <td class="total-value balance"><div class="due"><?=number_format(0+_h($this->glfilter[0]['Debit']));?></div></td>
		      <td class="total-value balance"><div class="due"><?=number_format(0+_h($this->glfilter[0]['Credit']));?></div></td>
		      <td class="total-value balance"><div class="due"><?=number_format(0+_h($this->glfilter[0]['Debit'])+_h($this->glfilter[0]['Credit']));?></div></td>
		  </tr>
		
		</table>
		
		<div id="terms">
		  <div><?=_t( 'This computer generated statement does not need signature.' );?></div>
		</div>
	
	</div>
	
</body>

</html>