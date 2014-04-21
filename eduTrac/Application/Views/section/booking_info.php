<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Course Section Booking View
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
 * @since       4.0.9
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */
define('TIMEPICKER',true);
$dowMap = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
if(isPostSet('check_event')) {
	$data = [];
	$data['title'] = isPostSet('courseSecCode');
	$data['roomCode'] = isPostSet('roomCode');
	$data['termCode'] = isPostSet('termCode');
	$data['startDate'] = isPostSet('startDate');
	$data['endDate'] = isPostSet('endDate');
	$data['startTime'] = isPostSet('startTime');
	$data['endTime'] = isPostSet('endTime');
	$data['repeats'] = isPostSet('repeats');
	$data['repeatFreq'] = isPostSet('repeatFreq');
	$data['check_event'] = isPostSet('check_event');
}
if(isPostSet('add_event')) {
	$data = [];
	$data['title'] = isPostSet('courseSecCode');
	$data['roomCode'] = isPostSet('roomCode');
	$data['termCode'] = isPostSet('termCode');
	$data['startDate'] = isPostSet('startDate');
	$data['endDate'] = isPostSet('endDate');
	$data['startTime'] = isPostSet('startTime');
	$data['endTime'] = isPostSet('endTime');
	$data['repeats'] = isPostSet('repeats');
	$data['repeatFreq'] = isPostSet('repeatFreq');
	$data['add_event'] = isPostSet('add_event');
	room_booking($data);
}
?>

                <ol class="breadcrumb">
                        <li><a href="<?=BASE_URL;?>dashboard/"><?=_t( 'Dashboard' );?></a></li>
                        <li><a href="<?=BASE_URL;?>section/<?=bm();?>"><?=_t( 'Search Section' );?></a></li>
                        <li><a href="<?=BASE_URL;?>section/view/<?=_h($this->bookInfo[0]['courseSecID']);?>/<?=bm();?>"><?=_h($this->bookInfo[0]['termCode']);?>-<?=_h($this->bookInfo[0]['courseSecCode']);?></a></li>
                        <li class="active"><?=_t( 'Booking Info' );?></li>
                </ol>
                <!-- //breadcrumb-->
                
                <div id="content">
                
                        <div class="row">
                        
                                <div class="col-lg-12">
                                        <section class="panel corner-flip">
                                                <header class="panel-heading sm" data-color="theme-inverse">
                                                        <h2><strong><?=_t( 'Booking' );?></strong> <?=_t( 'Info' );?></h2>
                                                        <label class="color"><font color="red">*</font> <?=_t( 'Indicates field is required' );?></label>
                                                        <label class="color pull-right"><?=_h($this->bookInfo[0]['termCode']);?>-<?=_h($this->bookInfo[0]['courseSecCode']);?></label>
                                                </header>
                                                <div class="panel-body">
                                                    <div class="alert alert-info centered">
                                                            <strong><?=_t( 'Notice!' );?></strong> <?=_t( 'If a class meets more than once day a week, then you will need to fill out the form for each of the days the class meets in a week.' );?>
                                                    </div>
                                                    <?php if(isPostSet('check_event')) : ?>
                                                            <?=room_booking($data);?>
                                                    <?php endif; ?>
                                                    <form id="validateSubmitForm" class="form-horizontal" data-collabel="3" data-alignlabel="left" action="<?=BASE_URL;?>section/booking_info/<?=_h($this->bookInfo[0]['courseSecID']);?>/" method="post" autocomplete="off" data-label="color" parsley-validate>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label"><?=_t( 'Book Classroom' );?></label>
                                                                <div>
                                                                    <input type="text" readonly class="form-control centered" value="<?=_h($this->bookInfo[0]['roomCode']);?>" />
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label"><?=_t( 'Book Days' );?></label>
                                                                <div>
                                                                    <input type="text" readonly class="form-control centered" value="<?=_h($this->bookInfo[0]['dotw']);?>" />
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label"><?=_t( 'Book Time' );?></label>
                                                                <div>
                                                                    <input type="text" readonly class="form-control centered" value="<?=_h($this->bookInfo[0]['startTime']);?> - <?=_h($this->bookInfo[0]['endTime']);?>" />
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label"><?=_t( 'Term Dates' );?></label>
                                                                <div>
                                                                    <input type="text" readonly class="form-control centered" value="<?=_h($this->bookInfo[0]['termStartDate']);?> <?=_t( 'to' );?> <?=_h($this->bookInfo[0]['termEndDate']);?>" />
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label"><font color="red">*</font> <?=_t( 'Classroom' );?></label>
                                                                <div>
                                                                    <select name="roomCode"<?=csio();?> id="roomCode" class="selectpicker form-control show-menu-arrow" data-style="btn-purple" data-size="10" data-live-search="true" parsley-required="true">
                                                                        <option value="">&nbsp;</option>
                                                                        <?php table_dropdown('room','roomCode <> "NULL"','roomCode','roomCode','roomNumber',isPostSet('roomCode')); ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label"><font color="red">*</font> <?=_t( 'First Day' );?></label>
                                                                <div>
                                                                    <div class="input-group date form_datetime col-lg-12" data-picker-position="bottom-left" data-date-format="yyyy-mm-dd">
                                                                        <input type="text"<?=csio();?> name="startDate" id="startDate" class="form-control" value="<?=isPostSet('startDate');?>" parsley-required="true"/>
                                                                        <span class="input-group-btn">
                                                                        <button class="btn btn-default" type="button"><i class="fa fa-times"></i></button>
                                                                        <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- //col-md-6-->
                                                        
                                                        <div class="col-md-6">
                                                        	<div class="form-group">
                                                                <label class="control-label"><font color="red">*</font> <?=_t( 'Last Day' );?></label>
                                                                <div>
                                                                    <div class="input-group date form_datetime col-lg-12" data-picker-position="bottom-left" data-date-format="yyyy-mm-dd">
                                                                        <input type="text"<?=csio();?> name="endDate" id="endDate" class="form-control" value="<?=isPostSet('endDate');?>" parsley-required="true"/>
                                                                        <span class="input-group-btn">
                                                                        <button class="btn btn-default" type="button"><i class="fa fa-times"></i></button>
                                                                        <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label"><font color="red">*</font> <?=_t( 'Start Time' );?></label>
                                                                <div>
                                                                    <div class="input-append input-group col-lg-12 bootstrap-timepicker">
                                                                        <input id="altTimepicker1"<?=csio();?> type="text" name="startTime" class="form-control" value="<?=isPostSet('startTime');?>" parsley-required="true"/>
                                                                        <span class="input-group-btn add-on">
                                                                        <button class="btn btn-default" type="button"><i class="fa fa-clock-o"></i></button>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label"><font color="red">*</font> <?=_t( 'End Time' );?></label>
                                                                <div>
                                                                    <div class="input-append input-group col-lg-12 bootstrap-timepicker">
                                                                        <input id="altTimepicker2"<?=csio();?> type="text" name="endTime" id="endTime" class="form-control" value="<?=isPostSet('endTime');?>" parsley-required="true"/>
                                                                        <span class="input-group-btn add-on">
                                                                        <button class="btn btn-default" type="button"><i class="fa fa-clock-o"></i></button>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label"><?=_t( 'Repeat?' );?></label>
                                                                <div>
                                                                    <ul class="iCheck" data-color="purple">
                                                                        <li>
                                                                                <input type="checkbox" name="repeats" id="repeats" value="1"<?php if(isPostSet('repeats') == 1) { echo ' checked="checked"'; } ?> />
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label"><?=_t( 'Repeat Occurrence' );?></label>
                                                                <div>
                                                                    <ul class="iCheck"  data-color="red">
                                                                        <li>
                                                                                <input type="radio" value="1" id="repeatFreq" name="repeatFreq"<?php if(isPostSet('repeatFreq') == 1) { echo ' checked="checked"'; } ?> />
                                                                                <label><?=_t( 'Every Day' );?></label>
                                                                        </li>
                                                                        <li>
                                                                                <input type="radio" value="7" id="repeatFreq" name="repeatFreq"<?php if(isPostSet('repeatFreq') == 7) { echo ' checked="checked"'; } ?> />
                                                                                <label><?=_t( 'Weekly' );?></label>
                                                                        </li>
                                                                        <li>
                                                                                <input type="radio" value="14" id="repeatFreq" name="repeatFreq"<?php if(isPostSet('repeatFreq') == 14) { echo ' checked="checked"'; } ?> />
                                                                                <label><?=_t( 'Biweekly' );?></label>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- //col-md-6-->                                                        
                                                        
                                                        <div class="col-md-12">
                                                        <!-- //col-md-12-->
                                                        <div class="form-group">
                                                                <div>
                                                                    <footer class="panel-footer">
                                                                        <input type="hidden" name="courseSecID" value="<?=_h($this->bookInfo[0]['courseSecID']);?>" />
                                                                        <input type="hidden" name="termCode" value="<?=_h($this->bookInfo[0]['termCode']);?>" />
                                                                        <input type="hidden" name="courseSecCode" value="<?=_h($this->bookInfo[0]['courseSecCode']);?>" />
                                                                        <input type="submit"<?=csids();?> name="check_event" class="btn btn-theme" value="<?=_t( 'Check Availability' );?>" />
                                                                        <input type="submit"<?=csids();?> name="add_event" class="btn btn-theme" value="<?=_t( 'Submit' );?>" />
                                                                        <button type="button" class="btn btn-theme" onclick="window.location='<?=BASE_URL;?>section/view/<?=_h($this->bookInfo[0]['courseSecID']);?>/<?=bm();?>'"><?=_t( 'Cancel' );?></button>
                                                                    </footer>
                                                                </div>
                                                        </div>
                                                        </div>

                                                    </form>
                                                    
                                                    <?php if($this->booking[0]['eventMetaID'] != '') : ?>
                                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped" id="table-example">
                                                            <thead>
                                                                    <tr>
                                                                            <th><?=_t( 'Meeting Day' );?></th>
                                                                            <th><?=_t( 'Start Date/Time' );?></th>
                                                                            <th><?=_t( 'End Date/Time' );?></th>
                                                                            <th><?=_t( 'Classroom' );?></th>
                                                                            <th><?=_t( 'Actions' );?></th>
                                                                    </tr>
                                                            </thead>
                                                            <tbody>
                                                                    <?php if($this->booking != '') : foreach($this->booking as $k => $v) { ?>
                                                                    <tr>
                                                                        <td class="centered"><?=$dowMap[_h($v['weekDay'])];?></td>
                                                                        <td class="centered"><?=date("F d, o h:i A",strtotime(_h($v['start'])));?></td>
                                                                        <td class="centered"><?=date("F d, o h:i A",strtotime(_h($v['end'])));?></td>
                                                                        <td class="centered"><?=_h($v['roomCode']);?></td>
                                                                        <td class="centered">
                                                                            <a href="<?=BASE_URL;?>section/deleteEventDay/<?=_h($v['eventMetaID']);?>/" class="btn btn-theme"><i class="fa fa-trash-o"></i></button>
                                                                        </td>
                                                                    </tr>
                                                                    <?php } endif; ?>
                                                            </tbody>
                                                    </table>
                                                    <?php endif; ?>
                                                        
                                                </div>
                                        </section>
                                </div>
                                <!-- //content > row > col-lg-12 -->
                                
                        </div>
                        <!-- //content > row-->
                        
                </div>
                <!-- //content-->