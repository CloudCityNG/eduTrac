<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * Manage Parents View
 *  
 * PHP 5
 *
 * eGrades(tm) : Online Grading System (http://egrades.org/)
 * Copyright 2012, 7 Media Web Solutions, LLC (http://www.7mediaws.org/)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2012, 7 Media Web Solutions, LLC (http://www.7mediaws.org/)
 * @link http://egrades.org/ eGrades(tm) Project
 * @since eGrades(tm) v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>

<ul class="breadcrumb">
	<li><?php _e( _t( 'You are here' ) ); ?></li>
	<li><a href="<?php echo BASE_URL; ?>admin/" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><?php _e( _t( 'Students' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Manage Students' ) ); ?></h3>
<div class="innerLR">

	<!-- Widget -->
	<div class="widget widget-heading-simple widget-body-gray">
		<div class="widget-body">
		
			<!-- Table -->
			<table class="dynamicTable tableTools table table-striped table-bordered table-condensed table-white">
			
				<!-- Table heading -->
				<thead>
					<tr>
						<th class="center"><?php _e( _t( 'School') ); ?></th>
						<th class="center"><?php _e( _t( 'Name' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Email' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Grade' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Actions' ) ); ?></th>
					</tr>
				</thead>
				<!-- // Table heading END -->
				
				<!-- Table body -->
				<tbody>
				<?php if($this->studentList != '') : foreach($this->studentList as $key => $value) { ?>
                <tr class="gradeX">
                    <td class="center"><?php echo get_school_name(clean($value['schoolid'])) . ' - ' . clean($value['schoolid']); ?></td>
                    <td class="center"><?php echo clean($value['lname']) . ', ' . clean($value['fname']); ?></td>
                    <td class="center"><a href="mailto:<?php echo clean($value['email']); ?>"><?php echo clean($value['email']); ?></a></td>
                    <td class="center"><?php echo clean($value['grade']); ?></td>
                    <td class="center">
                    	<a href="<?php echo BASE_URL; ?>admin/edit_student/<?php echo clean($value['sid']); ?>" title="Edit Student" class="btn btn-circle"><i class="icon-edit"></i></a>
                        <a href="<?php echo BASE_URL; ?>admin/manage_student_role/<?php echo clean($value['sid']); ?>" title="Edit User Role" class="btn btn-primary btn-circle"><i class="icon-key"></i></a>
                        <a href="<?php echo BASE_URL; ?>admin/manage_student_perms/<?php echo clean($value['sid']); ?>" title="Edit User Permissions" class="btn btn-warning btn-circle"><i class="icon-unlock"></i></a>
                        <a href="<?php echo BASE_URL; ?>admin/delete_student/<?php echo clean($value['sid']); ?>" title="Delete Student" class="btn btn-danger btn-circle"><i class="icon-trash"></i></a>
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
	
</div>	
	
		
		</div>
		<!-- // Content END -->