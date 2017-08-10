<?php
/*
Template Name:Variant
Description:瑾忆博客
Version:1.0
Author:瑾忆
Author Url:http://www.drlog.pw
Sidebar Amount:0
*/
if(!defined('EMLOG_ROOT')) {exit('error!');}

require_once View::getView('module');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?php echo $site_title; ?> - <?php echo $site_key; ?> - <?php echo $site_description; ?></title>
    <meta name="keywords" content="<?php echo $site_key; ?>" />
    <meta name="description" content="<?php echo $site_description; ?>" />
	<meta name="generator" content="emlog" />
    <meta name="HandheldFriendly" content="True" /> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="<?php echo TEMPLATE_URL; ?>images/tx.png">
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?php echo BLOG_URL; ?>xmlrpc.php?rsd" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="<?php echo BLOG_URL; ?>wlwmanifest.xml" />
<link rel="alternate" type="application/rss+xml" title="RSS"  href="<?php echo BLOG_URL; ?>rss.php" />
<link type="<?php echo TEMPLATE_URL; ?>images/favicon.ico" href="<?php echo TEMPLATE_URL; ?>images/favicon.ico" rel="shortcut icon">
<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL; ?>style.css">
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/lib.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/plugins.js"></script>
<script src="<?php echo BLOG_URL; ?>include/lib/js/common_tpl.js" type="text/javascript"></script>
<style>
.post [rel="gallery"]:after {background: #666666;}
.post [rel="gallery"]:after {background: #666666;background: -moz-linear-gradient(top,  #666666 0%, #666666 100%);background: -webkit-gradient(linear, top center, bottom center, color-stop(0%,#666666), color-stop(100%,#666666));background: -webkit-linear-gradient(top,  #666666 0%,#666666 100%);background: -o-linear-gradient(top,  #666666 0%,#666666 100%);background: -ms-linear-gradient(top,  #666666 0%,#666666 100%);background: linear-gradient(to bottom,  #666666 0%,#666666 100%);}
.wpcf7-text:focus,.wpcf7-number:focus,.wpcf7-select:focus,.wpcf7-textarea:focus,.text-input:focus {border-color: #666666;}[id="submit"],.wpcf7-submit,.btn--primary {background: #666666;}.post-status {color: #666666;}
a {color: #666666;}
</style>

<?php doAction('index_head'); ?>
</head>
<body class="home blog fancy-captions round-avatars">
<header>
<a id="logo" href="<?php echo BLOG_URL; ?>" title="<?php echo $blogname; ?>">
<img src="<?php echo _g("logo");?>" alt="<?php echo $blogname; ?>" /></a>
<a id="nav-toggle" href="#"><span></span></a>
<nav>
<div class="menu-top-container">
	<ul id="menu-top" class="menu">
		<?php blog_navi();?>
	</ul>
</div>
</nav>
<i class=" js-toggle-search iconfont"></i>
</header>

<div class="m-header ">
	<section id="hero1" class="hero">
	<div class="inner">
	</div>
	</section>
	<figure class="top-image" style="background-image: url(<?php echo _g('topimg');?>);"></figure>
	<canvas height="550" width="1152" id="wave-canvas"></canvas>
	<canvas id="wave-canvas"></canvas>
<canvas id="wave-canvas"></canvas>
</div>