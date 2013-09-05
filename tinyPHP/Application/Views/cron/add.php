<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * Add Cron Job View
 *  
 * PHP 5
 *
 * eduTrac(tm) : Student Information System (http://www.7mediaws.org/)
 * Copyright (C) 2013 Joshua Parker
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
 * @since eduTrac(tm) v 1.0
 * @license GNU General Public License v3 (http://www.gnu.org/licenses/gpl-3.0.html)
 */
?>

<ul class="breadcrumb">
	<li><?php _e( _t( 'You are here') ); ?></li>
	<li><a href="<?=BASE_URL;?>dashbaord/<?=bm();?>" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><a href="<?=BASE_URL;?>cron/<?=bm();?>" class="glyphicons pin_flag"><i></i> <?php _e( _t( 'Cron Jobs' ) ); ?></a></li>
	<li class="divider"></li>
	<li><?php _e( _t( 'Add Cron Job' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Add Cron Job' ) ); ?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" name="cron" onsubmit="return add();" action="<?=BASE_URL;?>cron/runCron/" id="validateSubmitForm" method="post" autocomplete="off">
		
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
							<label class="control-label" for="ccdKey"><font color="red">*</font> <?php _e( _t( 'Script to Run' ) ); ?></label>
							<div class="controls"><input class="span12" id="ccdKey" name="ccdKey" type="text" required /></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="ccdName"><font color="red">*</font> <?php _e( _t( 'Job Name' ) ); ?></label>
							<div class="controls"><input class="span12" id="ccdName" name="ccdName" type="text" required /></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
                        <div class="control-group">
                            <label class="control-label" for="minutes"><?php _e( _t( 'Minutes' ) ); ?></label>
                            <div class="controls">
                                <select style="width:15%" name="minutes" onchange="disable_others()" value="0">
                                    <option selected value="-1">0</option>
                                    <option value="1">1 </option>
                                    <option value="2">2 </option>
                                    <option value="3">3 </option>
                                    <option value="4">4 </option>
                                    <option value="5">5 </option>
                                    <option value="6">6 </option>
                                    <option value="7">7 </option>
                                    <option value="8">8 </option>
                                    <option value="9">9 </option>
                                    <option value="10">10 </option>
                                    <option value="11">11 </option>
                                    <option value="12">12 </option>
                                    <option value="13">13 </option>
                                    <option value="14">14 </option>
                                    <option value="15">15 </option>
                                    <option value="16">16 </option>
                                    <option value="17">17 </option>
                                    <option value="18">18 </option>
                                    <option value="19">19 </option>
                                    <option value="20">20 </option>
                                    <option value="21">21 </option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30 </option>
                                    <option value="31">31 </option>
                                    <option value="32">32 </option>
                                    <option value="33">33 </option>
                                    <option value="34">34 </option>
                                    <option value="35">35 </option>
                                    <option value="36">36 </option>
                                    <option value="37">37 </option>
                                    <option value="38">38 </option>
                                    <option value="39">39 </option>
                                    <option value="40">40 </option>
                                    <option value="41">41 </option>
                                    <option value="42">42 </option>
                                    <option value="43">43 </option>
                                    <option value="44">44 </option>
                                    <option value="45">45 </option>
                                    <option value="46">46 </option>
                                    <option value="47">47 </option>
                                    <option value="48">48 </option>
                                    <option value="49">49 </option>
                                    <option value="50">50 </option>
                                    <option value="51">51</option>
                                    <option value="52">52</option>
                                    <option value="53">53 </option>
                                    <option value="54">54 </option>
                                    <option value="55">55 </option>
                                    <option value="56">56 </option>
                                    <option value="57">57 </option>
                                    <option value="58">58 </option>
                                    <option value="59">59 </option>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label" for="hours"><?php _e( _t( 'Hourly' ) ); ?></label>
                            <div class="controls">
                                <select style="width:15%" name="hours" onchange="disable_others()" value="0">
                                    <option selected value="-1">0</option>
                                    <option value="1">1 </option>
                                    <option value="2">2 </option>
                                    <option value="3">3 </option>
                                    <option value="4">4 </option>
                                    <option value="5">5 </option>
                                    <option value="6">6 </option>
                                    <option value="7">7 </option>
                                    <option value="8">8 </option>
                                    <option value="9">9 </option>
                                    <option value="10">10 </option>
                                    <option value="11">11 </option>
                                    <option value="12">12 </option>
                                    <option value="13">13 </option>
                                    <option value="14">14 </option>
                                    <option value="15">15 </option>
                                    <option value="16">16 </option>
                                    <option value="17">17 </option>
                                    <option value="18">18 </option>
                                    <option value="19">19 </option>
                                    <option value="20">20 </option>
                                    <option value="21">21 </option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label" for="days"><?php _e( _t( 'Daily' ) ); ?></label>
                            <div class="controls">
                                <select style="width:15%" name="days" onchange="disable_others()">
                                    <option selected value="-1">0</option>
                                    <option value="1">1 </option>
                                    <option value="2">2 </option>
                                    <option value="3">3 </option>
                                    <option value="4">4 </option>
                                    <option value="5">5 </option>
                                    <option value="6">6 </option>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label" for="weeks"><?php _e( _t( 'Weekly' ) ); ?></label>
                            <div class="controls">
                                <select style="width:15%" name="weeks" onchange="disable_others()">
                                    <option selected value="-1">0</option>
                                    <option value="1">1 </option>
                                    <option value="2">2 </option>
                                    <option value="3">3 </option>
                                    <option value="4">4 </option>
                                    <option value="5">5 </option>
                                    <option value="6">6 </option>
                                    <option value="7">7 </option>
                                    <option value="8">8 </option>
                                    <option value="9">9 </option>
                                    <option value="10">10 </option>
                                    <option value="11">11 </option>
                                    <option value="12">12 </option>
                                    <option value="13">13 </option>
                                    <option value="14">14 </option>
                                    <option value="15">15 </option>
                                    <option value="16">16 </option>
                                    <option value="17">17 </option>
                                    <option value="18">18 </option>
                                    <option value="19">19 </option>
                                    <option value="20">20 </option>
                                    <option value="21">21 </option>
                                    <option value="22">22 </option>
                                    <option value="23">23 </option>
                                    <option value="24">24 </option>
                                    <option value="25">25 </option>
                                    <option value="26">26 </option>
                                    <option value="27">27 </option>
                                    <option value="28">28 </option>
                                    <option value="29">29 </option>
                                    <option value="30">30 </option>
                                    <option value="31">31 </option>
                                    <option value="32">32 </option>
                                    <option value="33">33 </option>
                                    <option value="34">34 </option>
                                    <option value="35">35 </option>
                                    <option value="36">36 </option>
                                    <option value="37">37 </option>
                                    <option value="38">38 </option>
                                    <option value="39">39 </option>
                                    <option value="40">40 </option>
                                    <option value="41">41 </option>
                                    <option value="42">42 </option>
                                    <option value="43">43 </option>
                                    <option value="44">44 </option>
                                    <option value="45">45 </option>
                                    <option value="46">46 </option>
                                    <option value="47">47 </option>
                                    <option value="48">48 </option>
                                    <option value="49">49 </option>
                                    <option value="50">50 </option>
                                    <option value="51">51</option>
                                    <option value="52">52</option>
                                </select>
                            </div>
                        </div>
                        <!-- // Group END -->
                        
                        <!-- Group -->
                        <div class="control-group">
                            <label class="control-label" for="ccdName"><font color="red">*</font> <?php _e( _t( 'How Often?' ) ); ?></label>
                            <div class="controls">
                                <select style="width:50%" name="" id="select2_9" required>
                                    <option value="0"><?php _e( _t( 'Until I Delete It' ) ); ?></option>
                                    <option value="1"><?php _e( _t( 'Only Once, Then Delete The Job' ) ); ?></option>
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
				    <input type="hidden" name="id" value="0" />
				    <input type="hidden" name="time_last_fired" value="0" />
					<button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok" onclick="add()"><i></i><?php _e( _t( 'Save' ) ); ?></button>
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

<script type="text/javaScript">
<!--
original_minutes=0;
original_hours=0;
original_days=0;
original_weeks=0;

function disable_others()
{
 validcount=0;
 with (document.cron)
 {
  if (minutes.options[minutes.selectedIndex].value<0) validcount=validcount+minutes.options[minutes.selectedIndex].value *1; 
  if (hours.options[hours.selectedIndex].value<0) validcount=validcount+hours.options[hours.selectedIndex].value *1; 
  if (days.options[days.selectedIndex].value<0) validcount=validcount+days.options[days.selectedIndex].value *1;
  if (weeks.options[weeks.selectedIndex].value<0) validcount=validcount+weeks.options[weeks.selectedIndex].value *1; 
  if (validcount!=-3) 
  {
   minutes.value=-1;
   minutes.value=-1;
   hours.value=-1;
   days.value=-1;
   weeks.value=-1;
   alert("You can only choose one value: minutes, hourly, daily, or weekly.");
  }
 }
}
function add()
{
 with (document.cron)
 {
  if ( (minutes.options[minutes.selectedIndex].value<0) & 
  (hours.options[hours.selectedIndex].value<0) & 
  (days.options[days.selectedIndex].value<0) & 
  (weeks.options[weeks.selectedIndex].value<0) ) {
  alert("Please select a period to run this script:\n\n MINUTES, HOURLY, DAILY or WEEKLY");
  return false;
  } else { submit(); }
 }
} // -->
</script>