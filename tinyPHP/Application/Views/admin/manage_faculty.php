<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * Manage Courses View
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
	<li><?php _e( _t( 'Faculty' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Manage Faculty' ) ); ?></h3>
<div class="innerLR">

	<!-- Widget -->
	<div class="widget widget-heading-simple widget-body-gray">
		<div class="widget-body">
		
			<!-- Table -->
			<table class="dynamicTable tableTools table table-striped table-bordered table-condensed table-white">
			
				<!-- Table heading -->
				<thead>
					<tr>
						<th class="center"><?php _e( _t( 'School' ) ); ?></th>
						<th class="center"><?php _e( _t( 'ID' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Username' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Last Name' ) ); ?></th>
						<th class="center"><?php _e( _t( 'First Name' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Email' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Type' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Actions' ) ); ?></th>
					</tr>
				</thead>
				<!-- // Table heading END -->
				
				<!-- Table body -->
				<tbody>
				<?php if($this->facultyList != '') : foreach($this->facultyList as $key => $value) { ?>
                <tr class="gradeX">
                    <td class="center"><?php echo clean($value['school_name'] . ' - ' . $value['school_id']); ?></td>
                    <td class="center"><?php echo clean($value['facid']); ?></td>
                    <td class="center"><?php echo clean($value['uname']); ?></td>
                    <td class="center"><?php echo clean($value['lname']); ?></td>
                    <td class="center"><?php echo clean($value['fname']); ?></td>
                    <td class="center"><?php if($value['email'] == '') { echo 'N/A'; } else { echo '<a href="mailto:'.clean($value['email']).'">'.clean($value['email']).'</a>'; } ?></td>
                    <td class="center"><?php echo clean(ucfirst($value['type'])); ?></td>
                    <td class="center">
                    	<a href="<?php echo BASE_URL; ?>admin/edit_faculty/<?php echo clean($value['facid']); ?>" title="Edit Faculty" class="btn btn-circle"><i class="icon-edit"></i></a>
                    	<a href="<?php echo BASE_URL; ?>admin/manage_faculty_role/<?php echo clean($value['facid']); ?>" title="Edit Faculty Role" class="btn btn-primary btn-circle"><i class="icon-key"></i></a>
                    	<a href="<?php echo BASE_URL; ?>admin/manage_faculty_perms/<?php echo clean($value['facid']); ?>" title="Edit Faculty Permissions" class="btn btn-warning btn-circle"><i class="icon-unlock"></i></a>
                        <a href="<?php echo BASE_URL; ?>admin/delete_faculty/<?php echo clean($value['facid']); ?>" title="Delete Student" class="btn btn-danger btn-circle"><i class="icon-trash"></i></a>
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