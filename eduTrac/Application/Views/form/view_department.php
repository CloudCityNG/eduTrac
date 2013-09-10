<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * Add Department View
 *  
 * PHP 5
 *
 * eduTrac(tm) : Student Information System (http://edutrac.org/)
 * Copyright 2013, eduTrac, LLC (http://edutrac.org/)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2013, eduTrac, LLC (http://edutrac.org/)
 * @link http://edutrac.org/ eduTrac(tm) Project
 * @since eduTrac(tm) v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>

<ul class="breadcrumb">
	<li><?php _e( _t( 'You are here') ); ?></li>
	<li><a href="<?=BASE_URL;?>dashbaord/<?=bm();?>" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><a href="<?=BASE_URL;?>form/department/<?=bm();?>" class="glyphicons pin_flag"><i></i> <?php _e( _t( 'Department' ) ); ?></a></li>
	<li class="divider"></li>
	<li><?php _e( _t( 'View Department' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'View Deparment' ) ); ?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>form/runEditDept/" id="validateSubmitForm" method="post" autocomplete="off">
		
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
							<label class="control-label" for="deptCode"><font color="red">*</font> <?php _e( _t( 'Department Code' ) ); ?></label>
							<div class="controls"><input class="span12" id="deptCode"<?=gio();?> name="deptCode" type="text" value="<?=_h($this->dept[0]['deptCode']);?>" required /></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
                        <div class="control-group">
                            <label class="control-label" for="deptType"><font color="red">*</font> <?php _e( _t( 'Department Type' ) ); ?></label>
                            <div class="controls">
                                <?=dept_type_select(_h($this->dept[0]['deptType']));?>
                            </div>
                        </div>
                        <!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="deptName"><font color="red">*</font> <?php _e( _t( 'Department Name' ) ); ?></label>
							<div class="controls"><input class="span12" id="deptName"<?=gio();?> name="deptName" type="text" value="<?=_h($this->dept[0]['deptName']);?>" required /></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="deptDesc"><?php _e( _t( 'Short Description' ) ); ?></label>
							<div class="controls"><input class="span12" id="deptDesc"<?=gio();?> name="deptDesc" type="text" value="<?=_h($this->dept[0]['deptDesc']);?>" /></div>
						</div>
						<!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
				</div>
				<!-- // Row END -->
			
				<hr class="separator" />
				
				<!-- Form actions -->
				<div class="form-actions">
					<input class="span12" name="deptID" type="hidden" value="<?=_h($this->dept[0]['deptID']);?>" required />
					<button type="submit"<?=gids();?> class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?php _e( _t( 'Update' ) ); ?></button>
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