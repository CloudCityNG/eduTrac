<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/*
Plugin Name: ET SMTP
Plugin URI: http://www.7mediaws.org/
Version: 1.0.2
Description: ET SMTP will allow you to send emails through an SMTP server and override the PHP mail() as well as the eduTrac et_mail() sending methods.
Author: Joshua Parker
Author URI: http://www.7mediaws.org/
Plugin Slug: et-smtp
*/

use \eduTrac\Classes\Libraries\Hooks;
use \eduTrac\Classes\Core\DB;

Hooks::add_action( 'admin_menu', 'et_smtp_page', 10 );

function et_smtp_page() {
    // parameters: page slug, page title, and function that will display the page itself
	Hooks::register_admin_page( 'et_smtp', 'ET SMTP', 'et_smtp_do_page' );
}

function et_smtp_do_page() {
$val = new \eduTrac\Classes\Core\Val;
$email = new \eduTrac\Classes\Libraries\Email;

	$options = array( 'et_smtp_from', 'et_smtp_fromname', 'et_smtp_host', 'et_smtp_smtpsecure', 'et_smtp_port', 'et_smtp_smtpauth', 'et_smtp_username', 'et_smtp_password' );
	
	if ( $_POST ) {
		foreach ( $options as $option_name ) {
			if ( ! isset($_POST[$option_name]) )
				continue;
			$value = $_POST[$option_name];
			Hooks::update_option( $option_name, $value );
		}
		
		// Update more options here
		Hooks::do_action( 'update_options' );
		
		if(!$val->is_valid_email(isPostSet("et_smtp_from"))){
		$amessage = '<div class="alert alert-block alert-error fade in">
						<h4 class="alert-heading">Error!</h4>
						<p>The field "From" must be a valid email address!</p>
					</div>';
		}
		elseif(empty($_POST["et_smtp_host"])){
			$amessage = '<div class="alert alert-block alert-error fade in">
							<h4 class="alert-heading">Error!</h4>
							<p>The field "Host" can not be left blank!</p>
						</div>';
		}
		else{
			$amessage = '<div class="alert alert-block alert-success fade in">
							<h4 class="alert-heading">Success!</h4>
							<p>Options saved.</p>
						</div>';
		}
	}

	if(isset($_POST['et_smtp_test'])){
		$to = $_POST['et_smtp_to'];
		$subject = $_POST['et_smtp_subject'];
		$message = $_POST['et_smtp_message'];
		$failed = 0;
		if(!empty($to) && !empty($subject) && !empty($message)){
			try{
				$result = $email->et_mail($to,$subject,$message);
			}catch(phpmailerException $e){
				$failed = 1;
			}
		} else {
			$failed = 1;
		}
		if(!$failed){
			if($result==TRUE){
				$amessage = '<div class="alert alert-block alert-success fade in">
								<h4 class="alert-heading">Success!</h4>
								<p>Message sent!</p>
							</div>';
			} else {
				$failed = 1;
			}
		}
		if($failed){
			$amessage = '<div class="alert alert-block alert-error fade in">
							<h4 class="alert-heading">Error!</h4>
							<p>Some errors occurred!</p>
						</div>';
		}
	}
	
	if(isset($_POST['et_smtp_uninstall'])) {
		foreach($options as $option) {
	 		Hooks::delete_option($option);
		}
		DB::inst()->delete( "plugin", "location LIKE '%et-smtp.plugin.php%'" );
		redirect( BASE_URL . 'plugins');
	}
?>

<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
<script type="text/javascript">
	tinymce.init({selector: "textarea"});
</script>

<ul class="breadcrumb">
    <li><?=_t( 'You are here' );?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?=_t( 'Dashboard' );?></a></li>
	<li class="divider"></li>
    <li><a href="<?=BASE_URL;?>plugins/<?=bm();?>" class="glyphicons cogwheel"><i></i> <?=_t( 'Plugins' );?></a></li>
    <li class="divider"></li>
	<li><?=_t( 'eduTrac SMTP Settings' );?></li>
</ul>

<h3><?=_t( 'eduTrac SMTP Settings' );?></h3>
<div class="innerLR">
		
		<!-- Widget -->
		<div class="widget widget-heading-simple widget-body-gray">
		
			<!-- Widget heading -->
			<!--<div class="widget-head">
				<h4 class="heading"></h4>
			</div>-->
			<!-- // Widget heading END -->
			
			<div class="widget-body">
			    
			    <form class="form-horizontal margin-none" action="<?=BASE_URL;?>plugins/options/?page=et_smtp" id="validateSubmitForm" method="post" autocomplete="off">
			
				<!-- Row -->
				<div class="row">
					<!-- Column -->
					<div class="col-md-6">
                    
                		<div class="form-group">
                			<label class="col-md-3 control-label"><?=_t('From Email:'); ?></label> 
                			<div class="col-md-8"><input id='input01' class="form-control" name="et_smtp_from" type="text" value="<?=_h(Hooks::get_option('et_smtp_from'));?>" /></div>
                		</div>
                		
                		<div class="form-group">
                			<label class="col-md-3 control-label" for='input01'><?=_t('From Name:'); ?></label> 
                			<div class="col-md-8"><input id='input01' class="form-control" name="et_smtp_fromname" type="text" value="<?=_h(Hooks::get_option('et_smtp_fromname'));?>" /></div>
                		</div>
                		
                		<div class="form-group">
                			<label class="col-md-3 control-label" for='input01'><?=_t('Host:'); ?></label> 
                			<div class="col-md-8"><input id='input01' class="form-control" name="et_smtp_host" type="text" value="<?=_h(Hooks::get_option('et_smtp_host'));?>" /></div>
                		</div>
                		
                		<div class="form-group">
                			<label class="col-md-3 control-label" for='input01'><?=_t('SMTP Secure:'); ?></label> 
                			<input id='input01' name="et_smtp_smtpsecure" type="radio" value=""<?=checked( _h(Hooks::get_option( 'et_smtp_smtpsecure' )), '', false );?> /> None
                			<input id='input01' name="et_smtp_smtpsecure" type="radio" value="ssl"<?=checked( _h(Hooks::get_option( 'et_smtp_smtpsecure' )), 'ssl', false );?> /> SSL
                			<input id='input01' name="et_smtp_smtpsecure" type="radio" value="tls"<?=checked( _h(Hooks::get_option( 'et_smtp_smtpsecure' )), 'tls', false );?> /> TLS
                		</div>
                        
                    </div>
                        
                    <!-- Column -->
					<div class="col-md-6">
                        
                        <div class="form-group">
                    		<label class="col-md-3 control-label" for='input01'><?=_t('Port:'); ?></label> 
                			<div class="col-md-8"><input id='input01' class="form-control" name="et_smtp_port" type="text" value="<?=_h(Hooks::get_option('et_smtp_port')); ?>" /></div>
                		</div>
                		
                		<div class="form-group">
                			<label class="col-md-3 control-label" for='input01'><?=_t('SMTP Authentication:'); ?></label> 
                			<div class="col-md-8"><input id='input01' name="et_smtp_smtpauth" type="radio" value="no"<?=checked( _h(Hooks::get_option( 'et_smtp_smtpauth' )), 'no', false );?> /> No</div>
                			<div class="col-md-8"><input id='input01' name="et_smtp_smtpauth" type="radio" value="yes"<?=checked( _h(Hooks::get_option( 'et_smtp_smtpauth' )), 'yes', false );?> /> Yes</div>
                		</div>
                		
                		<div class="form-group">
                			<label class="col-md-3 control-label" for='input01'><?=_t('Username:'); ?></label> 
                			<div class="col-md-8"><input id='input01' class="form-control" name="et_smtp_username" type="text" value="<?=_h(Hooks::get_option('et_smtp_username'));?>" /></div>
                		</div>
                		
                		<div class="form-group">
                			<label class="col-md-3 control-label" for='input01'><?=_t('Password:'); ?></label> 
                			<div class="col-md-8"><input id='input01' class="form-control" name="et_smtp_password" type="password" value="<?=_h(Hooks::get_option('et_smtp_password'));?>" /></div>
                		</div>
                    
                    </div>
                    <!-- // Column END -->
                </div>
                <!-- // Row END -->
                
                        <input type="hidden" name="et_smtp_update" value="update" />
                        <hr class="separator" />
                        
                        <!-- Form actions -->
                        <div class="form-actions">
                            <button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?=_t( 'Submit' );?></button>
                        </div>
                        <!-- // Form actions END -->
                        
                </form>
                <!-- // Form END -->
                
                <div class="break"></div>
                
                <form class="form-horizontal margin-none" action="<?=BASE_URL;?>plugins/options/?page=et_smtp" id="validateSubmitForm" method="post" autocomplete="off">
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-md-12">

                        <fieldset>
                        	<legend><?=_t( 'Send Test Email' ); ?></legend>
                        		<div class="form-group">
                        			<label class="col-md-3 control-label" for='input01'><?=_t('To:'); ?></label> 
                        			<div class="col-md-8"><input id='input01' class="form-control" name="et_smtp_to" type="text" value="" /></div>
                        		</div>
                        		
                        		<div class="form-group">
                        			<label class="col-md-3 control-label" for='input01'><?=_t('Subject:'); ?></label> 
                        			<div class="col-md-8"><input id='input01' class="form-control" name="et_smtp_subject" type="text" value="" /></div>
                        		</div>
                        		
                        		<div class="form-group">
                        			<label class="col-md-3 control-label" for='input01'><?=_t('Message:'); ?></label> 
                        			<div class="col-md-8">
                        			    <textarea id="mustHaveId" class="col-md-12 form-control" name="et_smtp_message" rows="5"></textarea>
                    			    </div>
                        		</div>
                        </fieldset>
                        
                        </div>
    				<!-- // Column END -->
				</div>
				<!-- // Row END -->
				
				<input type="hidden" name="et_smtp_test" value="test" />
                <hr class="separator" />
                
                <!-- Form actions -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?=_t( 'Submit' );?></button>
                </div>
                <!-- // Form actions END -->
				
				</form>
                <!-- // Form END -->
				
			</div>
		</div>
		<!-- // Widget END -->
	
</div>	
		
		</div>
		<!-- // Content END -->


<?php

}

function et_smtp($etMailer) {
	$etMailer->Mailer = "smtp";
	$etMailer->From = _h(Hooks::get_option("et_smtp_from"));
	$etMailer->FromName = _h(Hooks::get_option("et_smtp_fromname"));
	$etMailer->Sender = $etMailer->From; //Return-Path
	$etMailer->AddReplyTo($etMailer->From,$etMailer->FromName); //Reply-To
	$etMailer->Host = _h(Hooks::get_option("et_smtp_host"));
	$etMailer->SMTPSecure = _h(Hooks::get_option("et_smtp_smtpsecure"));
	$etMailer->Port = _h(Hooks::get_option("et_smtp_port"));
	$etMailer->SMTPAuth = (_h(Hooks::get_option("et_smtp_smtpauth")) == "yes") ? TRUE : FALSE;
	if($etMailer->SMTPAuth) {
		$etMailer->Username = _h(Hooks::get_option("et_smtp_username"));
		$etMailer->Password = _h(Hooks::get_option("et_smtp_password"));
	}
}
Hooks::add_action('etMailer_init','et_smtp');