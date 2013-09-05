<?php namespace tinyPHP\Classes\Libraries;
/**
 *
 * Email Class
 *  
 * PHP 5
 *
 * eduTrac(tm) : Student Information System (http://www.7mediaws.org/)
 * Copyright (C) 2013 Joshua Parker
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
 * @since eduTrac(tm) v 1.0
 * @license GNU General Public License v3 (http://www.gnu.org/licenses/gpl-3.0.html)
 */

if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');

use \tinyPHP\Classes\Libraries\Hooks;
class Email {
	
	private $_mailer;
	
	public function __construct() {
		$this->_mailer = new \tinyPHP\Classes\Libraries\PHPMailer(true);
	}
	
	 /**
	  * Borrowed from WordPress
	  *
	  * Send mail, similar to PHP's mail
	  * A true return value does not automatically mean that the user received the
	  * email successfully. It just only means that the method used was able to
	  * process the request without any errors.
	  */
	 public function tn_mail( $to, $subject, $message, $headers = '' ) {
		$charset = 'UTF-8';
		
		// From email and name
		// If we don't have a name from the input headers
		if ( !isset( $from_name ) )
			$from_name = 'tinyCampaign';
		
		if ( !isset( $from_email ) ) {
			// Get the site domain and get rid of www.
			$sitename = strtolower( $_SERVER['SERVER_NAME'] );
			if ( substr( $sitename, 0, 4 ) == 'www.' ) {
				$sitename = substr( $sitename, 4 );
			}

			$from_email = 'tinyCampaign@' . $sitename;
		}
		
		// Plugin authors can override the default mailer
		$this->_mailer->From     = Hooks::apply_filter( 'tn_mail_from'     , $from_email );
		$this->_mailer->FromName = Hooks::apply_filter( 'tn_mail_from_name', $from_name  );
		
		// Set destination addresses
		if ( !is_array( $to ) )
			$to = explode( ',', $to );

		foreach ( (array) $to as $recipient ) {
			try {
				// Break $recipient into name and address parts if in the format "Foo <bar@baz.com>"
				$recipient_name = '';
				if( preg_match( '/(.*)<(.+)>/', $recipient, $matches ) ) {
					if ( count( $matches ) == 3 ) {
						$recipient_name = $matches[1];
						$recipient = $matches[2];
					}
				}
				$this->_mailer->AddAddress( $recipient, $recipient_name);
			} catch ( phpmailerException $e ) {
				continue;
			}
		}

		// Set mail's subject and body
		$this->_mailer->Subject = $subject;
		$this->_mailer->Body    = $message;
		
		// Set to use PHP's mail()
		$this->_mailer->IsMail();

		// Set Content-Type and charset
		// If we don't have a content-type from the input headers
		if ( !isset( $content_type ) )
			$content_type = 'text/plain';

			$content_type = Hooks::apply_filter( 'tn_mail_content_type', $content_type );

			$this->_mailer->ContentType = $content_type;

		// Set whether it's plaintext, depending on $content_type
		if ( 'text/html' == $content_type )
			$this->_mailer->IsHTML( true );

			// Set the content-type and charset
			$this->_mailer->CharSet = Hooks::apply_filter( 'tn_mail_charset', $charset );

		// Set custom headers
		if ( !empty( $headers ) ) {
			foreach( (array) $headers as $name => $content ) {
				$this->_mailer->AddCustomHeader( sprintf( '%1$s: %2$s', $name, $content ) );
			}

			if ( false !== stripos( $content_type, 'multipart' ) && ! empty($boundary) )
				$this->_mailer->AddCustomHeader( sprintf( "Content-Type: %s;\n\t boundary=\"%s\"", $content_type, $boundary ) );
		}
		
		if ( !empty( $attachments ) ) {
			foreach ( $attachments as $attachment ) {
				try {
					$this->_mailer->AddAttachment($attachment);
				} catch ( phpmailerException $e ) {
					continue;
				}
			}
		}
		
		Hooks::do_action_array( 'tnMailer_init', array( &$this->_mailer ) );
		
		// Send!
		try {
			$this->_mailer->Send();
		} catch ( phpmailerException $e ) {
			return false;
		}

			return true;
	 }

	public function tn_subscribe_email($name, $email, $pass, $host) {
		$message = 
		"Hello $name,\n
		Thank you for subscribing to our mailing list. Below are your login and subscription details...\n
		
		User ID: $email
		Password: $pass \n
		
		Thank You
		
		Administrator
		$host
		______________________________________________________
		THIS IS AN AUTOMATED RESPONSE. 
		***DO NOT RESPOND TO THIS EMAIL****
		";
		
		$headers  = "From: \"".Hooks::get_option('system_name')." Subscription\" <auto-reply@$host>\r\n";
		$headers .= "X-Mailer: PHP/" . phpversion();
		
		$this->tn_mail($email,"Newsletter Subscription",$message,$headers);
		
		return Hooks::apply_filter('subscribe_email',$message,$headers);
	}
	
	public function tn_confirm_email($name, $email, $pass, $alink, $host) {
		$message = 
		"Hello $name,\n
		Thank you for your interest in our newsletter. Below are your account details...\n
		
		User ID: $email
		Password: $pass \n
		
		Click the link to confirm your subscription to our newsletter: $alink
		
		Thank You
		
		Administrator
		$host
		______________________________________________________
		THIS IS AN AUTOMATED RESPONSE. 
		***DO NOT RESPOND TO THIS EMAIL****
		";
		
		$headers  = "From: \"".Hooks::get_option('system_name')." Confirm Subscription\" <auto-reply@$host>\r\n";
		$headers .= "X-Mailer: PHP/" . phpversion();
		
		$this->tn_mail($email,"Newsletter Subscription",$message,$headers);
		
		return Hooks::apply_filter('confirm_email',$message,$headers);
	}
	
	public function tn_reset_pass($email, $pass, $host) {
		$message = 
		"Below is the new password you requested ...\n
		
		Password: $pass \n
		
		Thank You
		
		Administrator
		$host
		______________________________________________________
		THIS IS AN AUTOMATED RESPONSE. 
		***DO NOT RESPOND TO THIS EMAIL****
		";

		$headers  = "From: \"".Hooks::get_option('system_name')." Reset Password\" <auto-reply@$host>\r\n";
		$headers .= "X-Mailer: PHP/" . phpversion();
	
		$this->tn_mail($email,"Reset Password",$message,$headers);
		return Hooks::apply_filter('reset_pass',$message,$headers);
	}
  
}