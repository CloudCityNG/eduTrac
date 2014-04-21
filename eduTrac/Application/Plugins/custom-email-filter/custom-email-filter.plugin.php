<?php
/*
Plugin Name: Custom Email Filter
Plugin URI: http://www.7mediaws.org/
Version: 1.0.0
Description: This plugin gives you the ability to override the default 'eduTrac' from name and email address.
Author: Joshua Parker
Author URI: http://www.7mediaws.org/
Plugin Slug: custom-email-filter
*/

\eduTrac\Classes\Libraries\Util::_include( PLUGINS_DIR . 'custom-email-filter/CustomEmailFilter.php' );

\eduTrac\Classes\Libraries\Hooks::{'add_action'}( 'admin_menu', 'custom_email_filter_page', 10 );

function custom_email_filter_page() {
    // parameters: page slug, page title, and function that will display the page itself
	\eduTrac\Classes\Libraries\Hooks::{'register_admin_page'}( 'custom_email_filter', 'Custom Email Filter', 'custom_email_filter_do_page' );
}

// Display Custom Email Filter Settings page
function custom_email_filter_do_page() {
	// Check if a form was submitted
	if( isPostSet('custom_email_filter') && isPostSet('custom_email_filter') == 1 )
		update_custom_email_filter_option();
?>

<ul class="breadcrumb">
    <li><?php _e( _t( 'You are here' ) ); ?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?php _e( _t( 'Dashboard' ) ); ?></a></li>
	<li class="divider"></li>
    <li><a href="<?=BASE_URL;?>plugins/<?=bm();?>" class="glyphicons cogwheel"><i></i> <?php _e( _t( 'Plugins' ) ); ?></a></li>
    <li class="divider"></li>
	<li><?php _e( _t( 'Custom Email Filter' ) ); ?></li>
</ul>

<h3><?php _e( _t( 'Custom Email Filter' ) ); ?></h3>
<div class="innerLR">
		
		<!-- Widget -->
		<div class="widget widget-heading-simple widget-body-gray">
		
			<!-- Widget heading -->
			<!--<div class="widget-head">
				<h4 class="heading"></h4>
			</div>-->
			<!-- // Widget heading END -->
			
			<div class="widget-body">
			    
			    <form class="form-horizontal margin-none" action="<?=BASE_URL;?>plugins/options/?page=custom_email_filter" id="validateSubmitForm" method="post" autocomplete="off">
			
				<!-- Row -->
				<div class="row">
					<!-- Column -->
					<div class="col-md-6">
                    
                		<div class='form-group'>
                			<label class='col-md-3 control-label' for='input01'><?=_t('From Name:'); ?></label> 
                			<div class="col-md-8"><input class="form-control" name="fromName" type="text" value="<?=_h(\eduTrac\Classes\Libraries\Hooks::{'get_option'}('fromName'));?>" /></div>
                		</div>
                        
                    </div>
                        
                    <!-- Column -->
    				<div class="col-md-6">
                        
                        <div class='form-group'>
                    		<label class='col-md-3 control-label' for='input01'><?=_t('From Email:'); ?></label> 
                			<div class="col-md-8"><input class="form-control" name="fromEmail" type="text" value="<?=_h(\eduTrac\Classes\Libraries\Hooks::{'get_option'}('fromEmail')); ?>" /></div>
                		</div>
                    
                    </div>
                    <!-- // Column END -->
                </div>
                <!-- // Row END -->
                
                        <hr class="separator" />
                        
                        <!-- Form actions -->
                        <div class="form-actions">
                        	<input type="hidden" name="custom_email_filter" value="1" />
                            <button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?php _e( _t( 'Submit' ) ); ?></button>
                        </div>
                        <!-- // Form actions END -->
                        
                </form>
                <!-- // Form END -->
                
                <div class="break"></div>
				
			</div>
		</div>
		<!-- // Widget END -->
	
</div>	
		
		</div>
		<!-- // Content END -->


<?php

}

// Update options in database
function update_custom_email_filter_option() {
	$fromName = $_POST['fromName'];
	$fromEmail = $_POST['fromEmail'];
	// Update values in database
	\eduTrac\Classes\Libraries\Hooks::{'update_option'}( 'fromName', $fromName );
	\eduTrac\Classes\Libraries\Hooks::{'update_option'}( 'fromEmail', $fromEmail );
	redirect( BASE_URL . 'plugins/options/?page=' . isGetSet('page'));
}