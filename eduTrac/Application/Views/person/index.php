<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Person Search View
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

$person = new \eduTrac\Classes\DBObjects\Person;
$parent = new \eduTrac\Classes\DBObjects\Parents;
?>

<ul class="breadcrumb">
	<li><?=_t( 'You are here' );?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?=_t( 'Dashboard' );?></a></li>
	<li class="divider"></li>
	<li><?=_t( 'Person' );?></li>
</ul>

<h3><?=_t( 'Search Person' );?></h3>
<div class="innerLR">

	<!-- Widget -->
	<div class="widget widget-heading-simple widget-body-gray">
		<div class="widget-body">
		
			<div class="tab-pane" id="search-users">
				<div class="widget widget-heading-simple widget-body-white margin-none">
					<div class="widget-body">
						
						<div class="widget widget-heading-simple widget-body-simple text-right form-group">
							<form class="form-search text-center" action="<?=BASE_URL;?>person/<?=bm();?>" method="post" autocomplete="off">
							  	<input type="text" name="person" class="form-control" placeholder="Search by person ID or name . . . " /> 
							  	<a href="#myModal" data-toggle="modal"><img src="<?=BASE_URL;?>static/common/theme/images/help.png" /></a>
							</form>
						</div>
						
					</div>
				</div>
			</div>
			
			<div class="separator bottom"></div>
			
			<?php if(isPostSet('person')) { ?>
			<!-- Table -->
			<table class="dynamicTable tableTools table table-striped table-bordered table-condensed table-white">
			
				<!-- Table heading -->
				<thead>
					<tr>
						<th class="text-center"><?=_t( 'ID' );?></th>
						<th class="text-center"><?=_t( 'Last Name' );?></th>
						<th class="text-center"><?=_t( 'First Name' );?></th>
						<th class="text-center"><?=_t( 'Actions' );?></th>
					</tr>
				</thead>
				<!-- // Table heading END -->
				
				<!-- Table body -->
				<tbody>
				<?php if($this->search != '') : foreach($this->search as $k => $v) { $parent->Load_from_key($v['personID']); ?>
                <tr class="gradeX">
                    <td class="text-center"><?=_h($v['personID']);?></td>
                    <td class="text-center"><?=_h($v['lname']);?></td>
                    <td class="text-center"><?=_h($v['fname']);?></td>
                    <td class="text-center">
                        <div class="btn-group dropup">
                            <button class="btn btn-default btn-xs" type="button"><?=_t( 'Actions' );?></button>
                            <button data-toggle="dropdown" class="btn btn-xs btn-primary dropdown-toggle" type="button">
                                <span class="caret"></span>
                                <span class="sr-only"><?=_t( 'Toggle Dropdown' );?></span>
                            </button>
                            <ul role="menu" class="dropdown-menu dropup-text pull-right">
                                <li><a href="<?=BASE_URL;?>person/view/<?=_h($v['personID']);?>/<?=bm();?>"><?=_t( 'View' );?></a></li>
                                                                                        
                                <?php if(!isset($_COOKIE['SWITCH_USERBACK']) && _h($v['personID']) != $auth->getPersonField('personID')) : ?>
                                <li<?=ae('login_as_user');?>><a href="<?=BASE_URL;?>index/switchUserTo/<?=_h($v['personID']);?>/"><?=_t( 'Switch to User' );?></a></li>
                                <?php endif; ?>
                                
                                <?php if($person->isStaffID($v['personID']) != $v['personID']) { ?>
                                <li<?=ae('create_staff_record');?>><a href="<?=BASE_URL;?>staff/add/<?=_h($v['personID']);?>/<?=bm();?>"><?=_t( 'Create Staff Record' );?></a></li>
                                <?php } ?>
                                
                                <?php if(hasAppl($v['personID']) != $v['personID']) { ?>
                                <li<?=hl('applications','access_application_screen');?>><a href="<?=BASE_URL;?>application/add/<?=_h($v['personID']);?>/<?=bm();?>"><?=_t( 'Create Application' );?></a></li>
                                <?php } ?>
                                
                                <li<?=ae('access_user_role_screen');?>><a href="<?=BASE_URL;?>person/role/<?=_h($v['personID']);?>/<?=bm();?>"><?=_t( 'Role' );?></a></li>
                                
                                <li<?=ae('access_user_permission_screen');?>><a href="<?=BASE_URL;?>person/perms/<?=_h($v['personID']);?>/<?=bm();?>"><?=_t( 'Permissions' );?></a></li>
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
	
	<!-- Modal -->
	<div class="modal fade" id="myModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- Modal heading -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 class="modal-title"><?=_t( 'Person Search' );?></h3>
				</div>
				<!-- // Modal heading END -->
				<!-- Modal body -->
				<div class="modal-body">
					<?=file_get_contents( APP_PATH . 'Info/person-search.txt' );?>
				</div>
				<!-- // Modal body END -->
				<!-- Modal footer -->
				<div class="modal-footer">
					<a href="#" class="btn btn-default" data-dismiss="modal"><?=_t( 'Close' );?></a> 
				</div>
				<!-- // Modal footer END -->
			</div>
		</div>
	</div>
	<!-- // Modal END -->
	
	<!-- // Widget END -->
	
</div>	
	
		
		</div>
		<!-- // Content END -->