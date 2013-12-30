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
use \eduTrac\Classes\Core\Session;
$installurl = 'http://'. $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'];
$installurl = str_replace('index.php','',$installurl);
Session::init();
Session::set('installurl',$installurl);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="en-us" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=_t( 'eduTrac Installer' );?></title>

<!-- JQuery -->
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script> 
<script type="text/javascript" src="<?=Session::get('installurl');?>static/assets/js/validate.js"></script> 
<script type="text/javascript" src="<?=Session::get('installurl');?>static/assets/js/hoverIntent.js"></script>
<script type="text/javascript" src="<?=Session::get('installurl');?>static/assets/js/wizardPro.js"></script>
<link href="<?=Session::get('installurl');?>static/assets/css/wizardPro.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
	$(document).ready(function(){
		$("#wizard").wizardPro();
	});
</script>
</head>
<body>

<div id="container">
    
    <h2><?=_t( 'eduTrac Installation Wizard' );?></h2>
    
    <div id="wizard" class="wizard-default-style js">
        
        <div class="step_content">
            <?php if(isGetSet('step') == 1) { ?>
            <!-- Wizard - Step 1 -->
            <div id="step-1" class="step one_column">
                
                <div class="column_one">
                    <h3><?=_t( 'Step 1 - Introduction' );?></h3>
                    
                    <p><strong><?=_t( 'Welcome to eduTrac. 
                    Before getting started, we need some information on the database. 
                    You will need to know the following items before proceeding.' );?></strong></p>
                    
                    <ol>
                        <li><?=_t( 'Database name' );?></li>
                        <li><?=_t( 'Database username' );?></li>
                        <li><?=_t( 'Database password' );?></li>
                        <li><?=_t( 'Database host' );?></li>
                    </ol>
                    
                    <p><?=_t( 'If for any reason this automatic file creation doesn\'t work, don\'t worry. 
                    All this does is fill in the database information to a configuration file. 
                    You may also simply open eduTrac/Config/contants-sample.php in a text editor, fill in your information, 
                    and save it as constants.php.' );?></p>
                    
                    <p><?=_t( 'In all likelihood, these items were supplied to you by your Web Host. 
                    If you do not have this information, then you will need to contact them before you can continue. 
                    If you\'re all ready...' );?></p>
                    <button class="next" onclick="window.location='<?=Session::get('installurl');?>install/?step=2'"><span><?=_t( 'Next Step' );?></span></button>
                </div>
                
            </div>
            <!-- </Wizard - Step 1 -->
            <?php } ?>
            
            <?php if(isGetSet('step') == 2) { ?>
            <!-- Wizard - Step 2 -->
            <div id="step-2" class="step two_column">
                
                <!-- Helper -->
                <div id="help-dbname" class="helper">
                    <div class="text">
                        <h3><?=_t( 'Database Name' );?></h3>
                        <p><?=_t( 'The name of the database you want to run eduTrac in.' );?></p>
                    </div>
                </div>
                <!-- </Helper -->
                
                <div class="column_one">
                    <h3><?=_t( 'Step 2 - Database Information' );?></h3>

                    <p><?=_t( 'On the right side you should enter your database connection details. 
                    If you\'re not sure about these, contact your host.' );?></p>
                </div>
                
                <div class="column_two">
                	<?=Session::error();?>
                    <form action="<?=Session::get('installurl');?>install/runInstall/" class="defaultRequest" method="post">
                        <fieldset>
                            <p><label><a href="#help-dbname" class="show_helper"><span>(?)</span> <?=_t( 'Database Name' );?></a></label>
                            <input type="text" name="dbname" class="required" /></p>
                            
                            <p><label><?=_t( 'Username' );?></label>
                            <input type="text" name="dbuser" class="required" /></p>
                            
                            <p><label><?=_t( 'Password' );?></label>
                            <input type="text" name="dbpass" class="required" /></p>
                            
                            <p><label><?=_t( 'Database Host' );?></label>
                            <input type="text" name="dbhost" class="required" /></p>
                        </fieldset>
                        
                        <fieldset>
                             <p><label>&nbsp;</label>
                             <button type="submit"><span><?=_t( 'Next Step' );?></span></button></p>
                        </fieldset>
                    </form>

                </div>
                
            </div>
            <!-- </Wizard - Step 2 -->
            <?php } ?>
            
            <?php if(isGetSet('step') == 3) { ?>
            <!-- Wizard - Step 3 -->
            <div id="step-3" class="step two_column">
            
                <!-- Helper -->
                <div id="help-username" class="helper">
                    <div class="text">
                        <h3><?=_t( 'Username' );?></h3>
                        <p><?=_t( 'Usernames can have only alphanumeric characters, spaces, 
                        underscores, hyphens, periods and the @ symbol.' );?></p>
                    </div>
                </div>
                <!-- </Helper -->
                
                <!-- Helper -->
                <div id="help-password" class="helper">
                    <div class="text">
                        <h3><?=_t( 'Password' );?></h3>
                        <p><strong><?=_t( 'A password will be automatically generated for you if you leave this blank.' );?></strong></p>
                        <p><?=_t( 'Hint: The password should be at least seven characters long.
                        To make it stronger, use upper and lower case letters, numbers and symbols like ! " ? $ % ^ &amp; ).' );?></p>
                    </div>
                </div>
                <!-- </Helper -->
                
                <div class="column_one">
                    <h3><?=_t( 'Step 3 - Website Information' );?></h3>
                    <p><?=_t( 'Welcome to the eduTrac installation process! 
                    Fill in the information below and you’ll be on your way to 
                    using the most user friendly college management system.' );?></p>
                </div>
                
                <div class="column_two">
                    
                    <form action="<?=Session::get('installurl');?>install/runInstallDB/" class="defaultRequest" method="post">
                        <fieldset>
                            <p><label><?=_t( 'Site Title' );?></label>
                            <input type="text" name="sitetitle" class="required" /></p>
                            
                            <p><label><?=_t( 'Site URL' );?></label>
                            <input type="text" name="siteurl" class="required" value="<?=Session::get('installurl');?>" /></p>
                            
                            <p><label><a href="#help-username" class="show_helper"><span>(?)</span> <?=_t( 'Username' );?></a></label>
                            <input type="text" name="uname" class="required" /></p>
                            
                            <p><label><?=_t( 'First Name' );?></label>
                            <input type="text" name="fname" class="required" /></p>
                            
                            <p><label><?=_t( 'Last Name' );?></label>
                            <input type="text" name="lname" class="required" /></p>
                            
                            <p><label><a href="#help-password" class="show_helper"><span>(?)</span> <?=_t( 'Password' );?></a></label>
                            <input type="password" name="password" class="required" /></p>
                            
                            <p><label><?=_t( 'Your E-mail' );?></label>
                            <input type="text" name="email" class="required email" /></p>
                        </fieldset>
                        
                        <fieldset>
                             <p><label>&nbsp;</label>
                             <button type="submit"><span><?=_t( 'Install DB Tables' );?></span></button></p>
                        </fieldset>
                    </form>
                    
                </div>
                
            </div>
            <!-- </Wizard - Step 3 -->
            <?php } ?>
            
            <?php if(isGetSet('step') == 4) { ?>
            <!-- Wizard - Step 4 -->
            <div id="step-4" class="step one_column">
                
                <div class="column_one">
                    <h3><?=_t( 'Success!' );?></h3>
                    
                    <p><?=_t( 'eduTrac has been installed. Click the button below in order to flush the installer and be redirected to the login page.' );?></p>
                    <form action="<?=Session::get('installurl');?>install/runInstallFinish/" class="defaultRequest" method="post">
                        <p><button type="submit"><span><?=_t( 'Finish Installer' );?></span></button></p>
                    </form>
                </div>
                
            </div>
            <!-- </Wizard - Step 4 -->
            <?php } ?>
            
        </div>
        
        <div class="no_javascript">
            <img src="<?=Session::get('installurl');?>static/assets/img/warning.png" alt="Javascript Required" />
            <p><?=_t( 'Javascript is required in order to use this installer.' );?><br />
            <a href="https://support.google.com/adsense/answer/12654"><?=_t( 'How to enable javascript' );?></a>
            -
            <a href="http://www.mozilla.com/firefox/"><?=_t( 'Upgrade Browser' );?></a></p>
        </div>
    </div>
    
</div>

</body>
</html>