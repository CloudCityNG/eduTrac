<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Install View
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
 * @since       1.1.3
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="en-us" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>eduTrac Installer</title>

<!-- JQuery -->
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script> 
<script type="text/javascript" src="<?=$siteurl;?>static/assets/js/validate.js"></script> 
<script type="text/javascript" src="<?=$siteurl;?>static/assets/js/hoverIntent.js"></script>
<script type="text/javascript" src="<?=$siteurl;?>static/assets/js/wizardPro.min.js"></script>
<link href="<?=$siteurl;?>static/assets/css/wizardPro.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
	$(document).ready(function(){
		$("#wizard").wizardPro();
	});
</script>


</head>
<body>

<div id="container">
    
    <h2>eduTrac Installation Wizard</h2>
    
    <div id="wizard" class="wizard-default-style js">
        <ul class="steps">
            <li>1. Introduction</li>
            <li>2. Database Information</li>
            <li>3. Website Information</li>
            <li>4. Finish Installation</li>
        </ul>
        
        <div class="step_content">
            
            <!-- Wizard - Step 1 -->
            <div id="step-1" class="step one_column">
                
                <div class="column_one">
                    <h3>Step 1 - Introduction</h3>
                    
                    <p><strong>Welcome to WordPress. 
                    Before getting started, we need some information on the database. 
                    You will need to know the following items before proceeding.</strong></p>
                    
                    <ol>
                        <li>Database name</li>
                        <li>Database username</li>
                        <li>Database password</li>
                        <li>Database host</li>
                        <li>Table prefix (if you want to run more than one WordPress in a single database)</li>
                    </ol>
                    
                    <p>If for any reason this automatic file creation doesn't work, don't worry. 
                    All this does is fill in the database information to a configuration file. 
                    You may also simply open wp-config-sample.php in a text editor, fill in your information, 
                    and save it as wp-config.php. </p>
                    
                    <p>In all likelihood, these items were supplied to you by your Web Host. 
                    If you do not have this information, then you will need to contact them before you can continue. 
                    If you're all ready...</p>
                    <button class="next"><span>Next Step</span></button>
                </div>
                
            </div>
            <!-- </Wizard - Step 1 -->
            
            <!-- Wizard - Step 2 -->
            <div id="step-2" class="step two_column">
                
                <!-- Helper -->
                <div id="help-dbname" class="helper">
                    <div class="text">
                        <h3>Database Name</h3>
                        <p>The name of the database you want to run WP in. </p>
                    </div>
                </div>
                <!-- </Helper -->
                
                <!-- Helper -->
                <div id="help-dbprefix" class="helper">
                    <div class="text">
                        <h3>Table Prefix</h3>
                        <p>If you want to run multiple WordPress installations in a single database, change this.</p>
                    </div>
                </div>
                <!-- </Helper -->
                
                <div class="column_one">
                    <h3>Step 2 - Database Information</h3>

                    <p>On the right side you should enter your database connection details. 
                    If you're not sure about these, contact your host. </p>
                </div>
                
                <div class="column_two">
                	<?php
                		if (isset($this->errors)) {
					
					        foreach ($this->errors as $error) {
					            echo '<div class="errormsg">'.$error.'</div>';
					        }
					
					    }
					?>
                    <form action="<?=$siteurl;?>install/?step=2" class="defaultRequest" method="post">
                        <fieldset>
                            <p><label><a href="#help-dbname" class="show_helper"><span>(?)</span> Database Name</a></label>
                            <input type="text" name="dbname" class="required" /></p>
                            
                            <p><label>Username</label>
                            <input type="text" name="dbuser" class="required" /></p>
                            
                            <p><label>Password</label>
                            <input type="text" name="dbpass" class="required" /></p>
                            
                            <p><label>Database Host</label>
                            <input type="text" name="dbhost" class="required" /></p>
                        </fieldset>
                        
                        <fieldset>
                             <p><label>&nbsp;</label>
                             <button type="submit"><span>Next Step</span></button></p>
                        </fieldset>
                    </form>

                </div>
                
            </div>
            <!-- </Wizard - Step 2 -->
            
            <!-- Wizard - Step 3 -->
            <div id="step-3" class="step two_column">
            
                <!-- Helper -->
                <div id="help-username" class="helper">
                    <div class="text">
                        <h3>Username</h3>
                        <p>Usernames can have only alphanumeric characters, spaces, 
                        underscores, hyphens, periods and the @ symbol.</p>
                    </div>
                </div>
                <!-- </Helper -->
                
                <!-- Helper -->
                <div id="help-password" class="helper">
                    <div class="text">
                        <h3>Password</h3>
                        <p><strong>A password will be automatically generated for you if you leave this blank.</strong></p>
                        <p>Hint: The password should be at least seven characters long.
                        To make it stronger, use upper and lower case letters, numbers and symbols like ! " ? $ % ^ &amp; ).</p>
                    </div>
                </div>
                <!-- </Helper -->
                
                <div class="column_one">
                    <h3>Step 3 - Website Information</h3>
                    <p>Welcome to the famous five minute WordPress installation process! 
                    You may want to browse the ReadMe documentation  at your leisure. 
                    Otherwise, just fill in the information below and you’ll be on your way to 
                    using the most extendable and powerful personal publishing platform in the world.</p>
                </div>
                
                <div class="column_two">
                    
                    <form action="<?=$siteurl;?>install/?step=3" class="defaultRequest" method="post">
                        <fieldset>
                            <p><label>Site Title</label>
                            <input type="text" name="sitetitle" class="required" /></p>
                            
                            <p><label>Site URL</label>
                            <input type="text" name="siteurl" class="required" value="<?=$siteurl;?>" /></p>
                            
                            <p><label><a href="#help-username" class="show_helper"><span>(?)</span> Username</a></label>
                            <input type="text" name="uname" class="required" /></p>
                            
                            <p><label>First Name</label>
                            <input type="text" name="fname" class="required" /></p>
                            
                            <p><label>Last Name</label>
                            <input type="text" name="lname" class="required" /></p>
                            
                            <p><label><a href="#help-password" class="show_helper"><span>(?)</span> Password</a></label>
                            <input type="password" name="password" class="required" /></p>
                            
                            <p><label>Your E-mail</label>
                            <input type="text" name="email" class="required email" /></p>
                        </fieldset>
                        
                        <fieldset>
                             <p><label>&nbsp;</label>
                             <button type="submit"><span>Install eduTrac</span></button></p>
                        </fieldset>
                    </form>
                    
                </div>
                
            </div>
            <!-- </Wizard - Step 3 -->
            
            <!-- Wizard - Step 4 -->
            <div id="step-4" class="step one_column">
                
                <div class="column_one">
                    <h3>Success!</h3>
                    
                    <p>eduTrac has been installed. Click the button below in order to flush the installer and be redirected to the login page.</p>
                    <form action="<?=$siteurl;?>install/?step=4" class="defaultRequest" method="post">
                        <input type="hidden" name="install_finish" value="1" />
                        <p><button type="submit"><span>Log In</span></button></p>
                    </form>
                </div>
                
            </div>
            <!-- </Wizard - Step 4 -->
            
        </div>
        
        <div class="no_javascript">
            <img src="<?=$siteurl;?>static/assets/img/warning.png" alt="Javascript Required" />
            <p>Javascript is required in order to use this wizard. <br />
            <a href="https://www.google.com/support/adsense/bin/answer.py?answer=12654">How to enable javascript</a>
            -
            <a href="http://www.mozilla.com/firefox/">Upgrade Browser</a></p>
        </div>
    </div>
    
</div>

</body>
</html>