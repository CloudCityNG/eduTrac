<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Lock Screen
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
 * @since       3.0.0
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */
$auth = new \eduTrac\Classes\Libraries\Cookies;
use \eduTrac\Classes\Libraries\Hooks;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<!-- Meta information -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<!-- Title-->
<title><?php if(isset($this->staticTitle)) { foreach($this->staticTitle as $title) { echo $title; } } ?></title>
<!-- Favicons -->
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?=BASE_URL;?>static/assets/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?=BASE_URL;?>static/assets/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?=BASE_URL;?>static/assets/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="<?=BASE_URL;?>static/assets/ico/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="<?=BASE_URL;?>favicon.ico">
<!-- CSS Stylesheet-->
<link type="text/css" rel="stylesheet" href="<?=BASE_URL;?>static/assets/css/bootstrap/bootstrap.min.css" />
<link type="text/css" rel="stylesheet" href="<?=BASE_URL;?>static/assets/css/bootstrap/bootstrap-themes.css" />
<link type="text/css" rel="stylesheet" href="<?=BASE_URL;?>static/assets/css/default.css" />
<?php head();?>
</head>
<body class="full-lg">
<div id="wrapper">

<div id="loading-top">
		<div id="canvas_loading"></div>
		<span><?=_t( 'Checking...' ); ?></span>
</div>

<div id="main">
		<div class="real-border">
				<div class="row">
						<div class="col-xs-1"></div>
						<div class="col-xs-1"></div>
						<div class="col-xs-1"></div>
						<div class="col-xs-1"></div>
						<div class="col-xs-1"></div>
						<div class="col-xs-1"></div>
						<div class="col-xs-1"></div>
						<div class="col-xs-1"></div>
						<div class="col-xs-1"></div>
						<div class="col-xs-1"></div>
						<div class="col-xs-1"></div>
						<div class="col-xs-1"></div>
				</div>
		</div>
		<div class="container">
				<div class="row">
						<div class="col-lg-12">
						
								<div class="account-wall">
										<section class="align-lg-center">
										<!--<div class="site-logo"></div>-->
										<h1 class="login-title"><span><?=_t( 'eduTrac' );?></span><?=_t( ' ERP' );?> <small> <?=Hooks::get_option('site_title');?></small></h1>
										</section>
										<form id="form-signin" class="form-signin">
												<!--<section class="align-lg-center">
														<span class="account-avatar easy-chart" data-percent="100" data-color="theme" data-track-color="#EDECE5" data-line-width="5" data-size="118">
															<?=get_user_avatar($auth->getPersonField('email'), 100, 'circle');?>
														</span>
												</section>-->
												<section>
														<input  type="hidden" name="uname" value="<?=$auth->getPersonField('uname');?>">
														<div class="input-group">
																<div class="input-group-addon"><i class="fa fa-key"></i></div>
																<input type="password" class="form-control"  name="password" placeholder="Password">
														</div>
														<button class="btn btn-lg btn-theme-inverse btn-block" type="submit" id="sign-in"><i class="fa fa-unlock"></i> <?=_t( 'Unlock' );?> </button>
												</section>
										</form>
								</div>	
								<!-- //account-wall-->
								
						</div>
						<!-- //col-sm-6 col-md-4 col-md-offset-4-->
				</div>
				<!-- //row-->
		</div>
		<!-- //container-->
		
</div>
<!-- //main-->

		
</div>
<!-- //wrapper-->


<!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->
		
<!-- Jquery Library -->
<script type="text/javascript" src="<?=BASE_URL;?>static/assets/js/jquery.min.js"></script>
<script type="text/javascript" src="<?=BASE_URL;?>static/assets/js/jquery.ui.min.js"></script>
<script type="text/javascript" src="<?=BASE_URL;?>static/assets/plugins/bootstrap/bootstrap.min.js"></script>
<!-- Modernizr Library For HTML5 And CSS3 -->
<script type="text/javascript" src="<?=BASE_URL;?>static/assets/js/modernizr/modernizr.js"></script>
<script type="text/javascript" src="<?=BASE_URL;?>static/assets/plugins/mmenu/jquery.mmenu.js"></script>
<!-- Holder Images -->
<script type="text/javascript" src="<?=BASE_URL;?>static/assets/plugins/holder/holder.js"></script>
<!-- Form plugins -->
<script type="text/javascript" src="<?=BASE_URL;?>static/assets/plugins/form/form.js"></script>
<!-- Library Themes Customize-->
<script type="text/javascript" src="<?=BASE_URL;?>static/assets/js/caplet.custom.js"></script>
<script type="text/javascript">
$(function() {
		   //Login animation to center 
			function toCenter(){
					var mainH=$("#main").outerHeight();
					var accountH=$(".account-wall").outerHeight();
					var marginT=(mainH-accountH)/2;
						   if(marginT>30){
							   $(".account-wall").css("margin-top",marginT-15);
							}else{
								$(".account-wall").css("margin-top",30);
							}
				}
				toCenter();
				var toResize;
				$(window).resize(function(e) {
					clearTimeout(toResize);
					toResize = setTimeout(toCenter(), 500);
				});
				
			//Canvas Loading
			  var throbber = new Throbber({  size: 32, padding: 17,  strokewidth: 2.8,  lines: 12, rotationspeed: 0, fps: 15 });
			  throbber.appendTo(document.getElementById('canvas_loading'));
			  throbber.start();
	
			
			$("#form-signin").submit(function(event){
					event.preventDefault();
					var main=$("#main");
					//scroll to top
					main.animate({
						scrollTop: 0
					}, 500);
					main.addClass("slideDown");		
					
					// send username and password to php check login
					$.ajax({
						url: "<?=BASE_URL;?>lock/runLoginCheck/", data: $(this).serialize(), type: "POST", dataType: 'json',
						success: function (e) {
								setTimeout(function () { main.removeClass("slideDown") }, !e.status ? 500:3000);
								 if (!e.status) { 
									 $.notific8('Check Your Password again !! ',{ life:5000,horizontalEdge:"bottom", theme:"danger" ,heading:" ERROR :-( "});
									return false;
								 }
								 setTimeout(function () { $("#loading-top span").text("Access granted...") }, 500);
								 setTimeout(function () { $("#loading-top span").text("Redirecting to dashboard...")  }, 1500);
								 setTimeout( "window.location.href='<?=BASE_URL;?>dashboard/'", 3100 );
						}
					});	
			
			});
	});
</script>
</body>
</html>