<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * Edit Parent View
 *  
 * PHP 5
 *
 * eGrades(tm) : Online Grading System (http://egrades.org/)
 * Copyright 2013, 7 Media Web Solutions, LLC (http://www.7mediaws.org/)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2013, 7 Media Web Solutions, LLC (http://www.7mediaws.org/)
 * @link http://egrades.org/ eGrades(tm) Project
 * @since eGrades(tm) v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>

<ul class="breadcrumb">
	<li><?php _e( _t( 'You are here' ) ); ?></li>
	<li><a href="<?php echo BASE_URL; ?>admin/" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><a href="<?php echo BASE_URL; ?>admin/manage_parents/" class="glyphicons parents"><i></i> <?php _e( _t( 'Parents' ) ); ?></a></li>
	<li class="divider"></li>
	<li><?php _e( _t( 'Edit Parent' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Edit Parent' ) ); ?></h3>
<div class="innerLR">

	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?php echo BASE_URL; ?>admin/editParent" id="validateSubmitForm" method="post" autocomplete="off">
		
		<!-- Widget -->
		<div class="widget widget-heading-simple widget-body-gray">
		
			<!-- Widget heading -->
			<div class="widget-head">
				<h4 class="heading"><font color="red">*</font> <?php _e( _t( 'Indicates field is required.' ) ); ?></h4>
			</div>
			<!-- // Widget heading END -->
			
			<div class="widget-body">
			
				<!-- Row -->
				<div class="row-fluid">
					<?php if($this->Parent != '') : foreach($this->Parent as $key => $value) { ?>
					<!-- Column -->
					<div class="span6">
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="pID"><?php _e( _t( 'Parent ID' ) ); ?></label>
							<div class="controls"><input class="span12" id="pID" type="text" disabled value="<?php echo clean($value['pID']); ?>" /></div>
						</div>
						<!-- // Group END -->
					
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="uname"><?php _e( _t( 'Username' ) ); ?></label>
							<div class="controls"><input class="span12" id="uname" type="text" disabled value="<?php echo clean($value['uname']); ?>" /></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="fname"><font color="red">*</font> <?php _e( _t( 'First Name' ) ); ?></label>
							<div class="controls"><input class="span12" id="fname" name="fname" type="text" value="<?php echo clean($value['fname']); ?>" required /></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="lname"><font color="red">*</font> <?php _e( _t( 'Last Name' ) ); ?></label>
							<div class="controls"><input class="span12" id="lname" name="lname" type="text" value="<?php echo clean($value['lname']); ?>" required /></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="email"><font color="red">*</font> <?php _e( _t( 'Email' ) ); ?></label>
							<div class="controls"><input class="span12" id="email" name="email" type="email" value="<?php echo clean($value['email']); ?>" required /></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="password"><?php _e( _t( 'Password' ) ); ?></label>
							<div class="controls"><input class="span12" id="password" name="password" type="password" /></div>
						</div>
						<!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					<?php } endif; ?>
				</div>
				<!-- // Row END -->
			
				<hr class="separator" />
				
				<!-- Form actions -->
				<div class="form-actions">
					<input class="span12" name="pID" type="hidden" value="<?php if($this->Parent != '') : foreach($this->Parent as $key => $value) { echo $value['pID']; } endif; ?> "/>
					<button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?php _e( _t( 'Save' ) ); ?></button>
				</div>
				<!-- // Form actions END -->
				
			</div>
		</div>
		<!-- // Widget END -->
		
	</form>
	<!-- // Form END -->
	
	<?php if($this->parentStudent != '')  { ?>
	<!-- Widget -->
	<div class="widget widget-heading-simple widget-body-gray">
		<div class="widget-body">
		
			<!-- Table -->
			<table class="dynamicTable tableTools table table-striped table-bordered table-condensed table-white">
			
				<!-- Table heading -->
				<thead>
					<tr>
						<th><?php _e( _t( 'Student ID' ) ); ?></th>
						<th><?php _e( _t( 'School' ) ); ?></th>
						<th><?php _e( _t( 'First Name' ) ); ?></th>
						<th><?php _e( _t( 'Last Name' ) ); ?></th>
						<th><?php _e( _t( 'Actions' ) ); ?></th>
					</tr>
				</thead>
				<!-- // Table heading END -->
				
				<!-- Table body -->
				<tbody>
				<?php if($this->parentStudent != '') : foreach($this->parentStudent as $key => $value) { ?>
                <tr class="gradeX">
                    <td class="center"><?php echo clean($value['student_id']); ?></td>
                    <td class="center"><?php echo clean($value['school_name'] . ' - ' . $value['school_id']); ?></td>
                    <td class="center"><?php echo clean($value['fname']); ?></td>
                    <td class="center"><?php echo clean($value['lname']); ?></td>
                    <td class="center">
                    	<a href="<?php echo BASE_URL; ?>admin/edit_student/<?php echo clean($value['student_id']); ?>" title="Edit Student" class="btn btn-circle"><i class="icon-edit"></i></a>
                        <a href="<?php echo BASE_URL; ?>admin/detach/<?php echo clean($value['student_id']); ?>" title="Detach Student" class="btn btn-danger btn-circle"><i class="icon-trash"></i></a>
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
	<!-- // Widget END -->
	<?php } ?>
</div>	
	
		
		</div>
		<!-- // Content END -->