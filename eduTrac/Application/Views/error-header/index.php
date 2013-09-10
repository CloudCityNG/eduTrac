<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * Error Header
 *  
 * PHP 5
 *
 * eduTrac(tm) : Student Information System (http://edutrac.org/)
 * Copyright 2013, eduTrac, LLC (http://edutrac.org/)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2013, eduTrac, LLC (http://edutrac.org/)
 * @link http://edutrac.org/ eduTrac(tm) Project
 * @since eduTrac(tm) v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

ob_start();
ob_implicit_flush(0);
use \eduTrac\Classes\Libraries\Hooks;
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7 fluid sticky-sidebar"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8 fluid sticky-top sticky-sidebar"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9 fluid sticky-top sticky-sidebar"> <![endif]-->
<!--[if gt IE 8]> <html class="ie gt-ie8 fluid sticky-top sticky-sidebar"> <![endif]-->
<!--[if !IE]><!--><html class="fluid sticky-top sticky-sidebar"><!-- <![endif]-->
<head>
    <title><?php if(isset($this->staticTitle)) { foreach($this->staticTitle as $title) { echo $title . ' - ' . Hooks::get_option('site_title'); } } else { echo '404 Error'; } ?></title>
	
	<!-- Meta -->
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />
	<link rel="shortcut icon" href="<?=BASE_URL;?>favicon.ico" type="image/x-icon">
	
	<!-- Bootstrap -->
	<link href="<?php echo BASE_URL; ?>static/common/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo BASE_URL; ?>static/common/bootstrap/css/responsive.css" rel="stylesheet" type="text/css" />
	
	<!-- Glyphicons Font Icons -->
	<link href="<?php echo BASE_URL; ?>static/common/theme/fonts/glyphicons/css/glyphicons.css" rel="stylesheet" />
	
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>static/common/theme/fonts/font-awesome/css/font-awesome.min.css">
	<!--[if IE 7]><link rel="stylesheet" href="<?php echo BASE_URL; ?>static/common/theme/fonts/font-awesome/css/font-awesome-ie7.min.css"><![endif]-->
	
	<!-- Uniform Pretty Checkboxes -->
	<link href="<?php echo BASE_URL; ?>static/common/theme/scripts/plugins/forms/pixelmatrix-uniform/css/uniform.default.css" rel="stylesheet" />
	
	<!-- PrettyPhoto -->
    <link href="<?php echo BASE_URL; ?>static/common/theme/scripts/plugins/gallery/prettyphoto/css/prettyPhoto.css" rel="stylesheet" />
	
	<!-- Main Theme Stylesheet :: CSS -->
	<link href="<?php echo BASE_URL; ?>static/common/theme/css/style-default.css?1371788393" rel="stylesheet" type="text/css" />
	
	
	<!-- LESS.js Library -->
	<script src="<?php echo BASE_URL; ?>static/common/theme/scripts/plugins/system/less.min.js"></script>
</head>
<body class="login ">
	
	<!-- Wrapper -->
<div id="login">

	<div class="container">