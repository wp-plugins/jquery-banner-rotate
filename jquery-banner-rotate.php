<?php
/*
Plugin Name: jQuery Banner Rotate
Plugin URI: https://wordpress.org/plugins/jquery-banner-rotate/
Description: You can create Sliders with images that can have expiration date or not.
Version: 4.1
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

include($JBR_PLUGIN['dir'] . 'class/db/class.jbrbanner.php');
include($JBR_PLUGIN['dir'] . 'class/db/class.jbrslider.php');

$jbr_banner = new JBRBanner();
$jbr_slider = new JBRSlider();
$jbr_shortcode_index = 0;

include($JBR_PLUGIN['dir'] . 'class/class.jbrscripts.php');
include($JBR_PLUGIN['dir'] . 'class/class.jbrtinymcebutton.php');
include($JBR_PLUGIN['dir'] . 'menus/class.jquerybannerrotatemenu.php');
include($JBR_PLUGIN['dir'] . 'jbr-functions.php');
include($JBR_PLUGIN['dir'] . 'jbr-shortcode.php');
include($JBR_PLUGIN['dir'] . 'jbr-widget.php');
new JBRScripts();
new JBRTinyMCEButton();
new JqueryBannerRotateMenu();


add_action('admin_notices', 'jbr_notices');
add_action('plugins_loaded', 'jbr_textdomain');