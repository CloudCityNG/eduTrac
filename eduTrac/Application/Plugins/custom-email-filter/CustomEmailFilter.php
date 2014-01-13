<?php

class CustomEmailFilter {
    public function __construct() {
         //add your filters to the constructor!
         \eduTrac\Classes\Libraries\Hooks::{'add_filter'}( 'et_mail_from_name', array( $this, 'custom_et_mail_from_name' ) );
         \eduTrac\Classes\Libraries\Hooks::{'add_filter'}( 'et_mail_from', array( $this, 'custom_et_mail_from' ) );
    }
	
	public function custom_et_mail_from_name() {
    	$fromName = \eduTrac\Classes\Libraries\Hooks::{'get_option'}('fromName');
    	return $fromName;
    }
    
    public function custom_et_mail_from() {
    	$fromEmail = \eduTrac\Classes\Libraries\Hooks::{'get_option'}('fromEmail');
    	return $fromEmail;
    }
	
}