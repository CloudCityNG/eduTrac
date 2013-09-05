<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * Audit Trail View
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
	<li><a href="<?php echo BASE_URL; ?>admin/dashboard/" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
	<li><?php _e( _t( 'Audit Trail' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Audit Trail' ) ); ?></h3>
<div class="innerLR">

	<!-- Widget -->
	<div class="widget widget-heading-simple widget-body-gray">
		<div class="widget-body">
		
			<!-- Table -->
			<table class="dynamicTable tableTools table table-striped table-bordered table-condensed table-white">
			
				<!-- Table heading -->
				<thead>
					<tr>
						<th class="center"><?php _e( _t( 'Event' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Type' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Record' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Username' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Action Date' ) ); ?></th>
						<th class="center"><?php _e( _t( 'Expire Date' ) ); ?></th>
					</tr>
				</thead>
				<!-- // Table heading END -->
				
				<!-- Table body -->
				<tbody>
				<?php if($this->logList != '') : foreach($this->logList as $key => $value) { ?>
                <tr class="gradeX">
                    <td class="center"><?php echo clean($value['event']); ?></td>
                    <td class="center"><?php echo clean($value['type']); ?></td>
                    <td class="center"><?php echo clean($value['record']); ?></td>
                    <td class="center"><?php echo clean($value['uname']); ?></td>
                    <td class="center"><?php echo date('D, M d, o',clean(strtotime($value['created_at']))); ?></td>
                    <td class="center"><?php echo date('D, M d, o',clean(strtotime($value['expires_at']))); ?></td>
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