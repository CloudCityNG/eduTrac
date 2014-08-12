<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Manage Courses View
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
use \eduTrac\Classes\Libraries\Hooks;
?>

<ul class="breadcrumb">
	<li><?=_t( 'You are here' );?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?=_t( 'Dashboard' );?></a></li>
	<li class="divider"></li>
	<li><?=_t( 'Courses' );?></li>
</ul>

<h3><?=_t( 'Search Course' );?></h3>
<div class="innerLR">

	<!-- Widget -->
	<div class="widget widget-heading-simple widget-body-gray">
		<div class="widget-body">
		
			<div class="tab-pane" id="search-users">
				<div class="widget widget-heading-simple widget-body-white margin-none">
					<div class="widget-body">
						
						<div class="widget widget-heading-simple widget-body-simple text-right form-group">
							<form class="form-search text-center" action="<?=BASE_URL;?>course/<?=bm();?>" method="post" autocomplete="off">
							  	<input type="text" name="crse" class="form-control" placeholder="Search subject or course code . . . " /> 
							</form>
						</div>
						
					</div>
				</div>
			</div>
			
			<div class="separator bottom"></div>
			
			<?php if(isPostSet('crse')) { ?>
			<!-- Table -->
			<table class="dynamicTable tableTools table table-striped table-bordered table-condensed table-white">
			
				<!-- Table heading -->
				<thead>
					<tr>
						<th class="text-center"><?=_t( 'Course Code' );?></th>
						<th class="text-center"><?=_t( 'Short Title' );?></th>
						<th class="text-center"><?=_t( 'Status' );?></th>
						<th class="text-center"><?=_t( 'Effective Date' );?></th>
						<th class="text-center"><?=_t( 'End Date' );?></th>
						<th class="text-center"><?=_t( 'Actions' );?></th>
					</tr>
				</thead>
				<!-- // Table heading END -->
				
				<!-- Table body -->
				<tbody>
				<?php if($this->search != '') : foreach($this->search as $k => $v) { ?>
                <tr class="gradeX">
                    <td class="text-center"><?=_h($v['courseCode']);?></td>
                    <td class="text-center"><?=_h($v['courseShortTitle']);?></td>
                    <td class="text-center"><?=_h($v['Status']);?></td>
                    <td class="text-center"><?=_h($v['startDate']);?></td>
                    <td class="text-center"><?=(_h($v['endDate']) > '0000-00-00' ? _h($v['endDate']) : '');?></td>
                    <td class="text-center">
                    	<div class="btn-group dropup">
                            <button class="btn btn-default btn-xs" type="button"><?=_t( 'Actions' ); ?></button>
                            <button data-toggle="dropdown" class="btn btn-xs btn-primary dropdown-toggle" type="button">
                                <span class="caret"></span>
                                <span class="sr-only"><?=_t( 'Toggle Dropdown' ); ?></span>
                            </button>
                            <ul role="menu" class="dropdown-menu dropup-text pull-right">
                                <li><a href="<?=BASE_URL;?>course/view/<?=_h($v['courseID']);?>/<?=bm();?>"><?=_t( 'View' ); ?></a></li>
                                <?php if(_h($v['currStatus']) == _t( 'A' ) && _h($v['endDate']) == '0000-00-00') : ?>
                                <li<?=ae('add_course_sec');?>><a href="<?=BASE_URL;?>section/add/<?=_h($v['courseID']);?>/<?=bm();?>"><?=_t( 'Create Section' ); ?></a></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </td>
                </tr>
				<?php } endif; ?>
				</tbody>
				<!-- // Table body END -->
				
			</table>
			<!-- // Table END -->
			
			<?php } ?>
			
		</div>
	</div>
	<div class="separator bottom"></div>
	<!-- // Widget END -->
	
</div>	
	
		
		</div>
		<!-- // Content END -->