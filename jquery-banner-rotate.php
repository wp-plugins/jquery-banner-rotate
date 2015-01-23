<?php
/*
Plugin Name: jQuery Banner Rotate
Plugin URI: https://wordpress.org/plugins/jquery-banner-rotate/
Description: Cria banners rotativos usando jQuery Cycle usando controle por datas de expiração.
Version: 4.0.5.1
Author: Pedro Marcelo
Author URI: https://www.linkedin.com/profile/view?id=265534858
License: GPL3
*/

$JBR_PLUGIN = array(
	'url' => plugin_dir_url(__FILE__),
	'dir' => plugin_dir_path(__FILE__),
	'textdomain' => 'jbr-textdomain-lang',
	'__FILE__' => __FILE__
);

include($JBR_PLUGIN['dir'] . 'db/class.jbrbanner.php');
include($JBR_PLUGIN['dir'] . 'db/class.jbrslider.php');

$jbr_banner = new JBRBanner();
$jbr_slider = new JBRSlider();

include($JBR_PLUGIN['dir'] . 'menus/class.jquerybannerrotatemenu.php');
include($JBR_PLUGIN['dir'] . 'jbr-functions.php');
include($JBR_PLUGIN['dir'] . 'jbr-shortcode.php');
include($JBR_PLUGIN['dir'] . 'jbr-widget.php');
new JqueryBannerRotateMenu();


add_action('admin_notices', 'jbr_notices');
add_action('plugins_loaded', 'jbr_textdomain');