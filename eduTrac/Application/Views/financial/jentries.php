<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * General Ledger Journal Entries View
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
	
	<title><?=_t( 'General Journal Entries' );?></title>
	
	<link rel='stylesheet' href='<?=BASE_URL;?>static/assets/css/style.css'>
	<link rel='stylesheet' href='<?=BASE_URL;?>static/assets/css/print.css' media="print">

</head>

<body>

	<div id="page-wrap">

		<div id="header"><?=_t( 'Journal Entry Summary' );?></div>
		
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
		      <th>Date</th>
		      <th>Manual ID</th>
		      <th>Title</th>
		      <th colspan="2">Description</th>
		      <th>Posted by</th>
		      <th>Amount</th>
		  </tr>
		  <?php if($this->jefilter != '') : foreach($this->jefilter as $k => $v) { ?>
		  <tr class="item-row">
		      <td><?=_h($v['gl_jentry_date']);?></td>
		      <td><?=_h($v['gl_jentry_manual_id']);?></td>
	      	  <td><?=_h($v['gl_jentry_title']);?></td>
	      	  <td colspan="2"><?=_h($v['gl_jentry_description']);?></td>
	      	  <td><?=get_name(_h($v['gl_jentry_personID']));?></td>
	      	  <td><?=number_format(0+_h($v['gl_trans_debit']));?></td>
		  </tr>
		  <?php } endif; ?>
		  
		  <tr id="hiderow">
		    <td colspan="7">&nbsp;</td>
		  </tr>
		  
		  <tr>
		      <td colspan="3" class="blank"> </td>
		      <td colspan="3" class="total-line balance">Total Amount</td>
		      <td class="total-value balance"><div class="due"><?=number_format(0+_h($this->jefilterSum[0]['Debit']));?></div></td>
		  </tr>
		
		</table>
		
		<div id="terms">
		  <div><?=_t( 'This computer generated statement does not need signature.' );?></div>
		</div>
	
	</div>
	
</body>

</html>