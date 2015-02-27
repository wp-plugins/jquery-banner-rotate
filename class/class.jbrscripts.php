<?php

class JBRScripts
{
	public function __construct()
	{
		add_action('wp_enqueue_scripts', array($this, 'wpScripts'));
		add_action('wp_enqueue_scripts', array($this, 'wpStyles'));
		add_action('admin_enqueue_scripts', array($this, 'adminScripts'));
		add_action('admin_enqueue_scripts', array($this, 'adminStyles'));
	}

	public function wpScripts()
	{
		global $JBR_PLUGIN;

		wp_enqueue_script(
			'jbr-cycle2',
			$JBR_PLUGIN['url'] . 'js/cycle/jquery.cycle2.min.js',
			array('jquery'),
			null,
			true
		);

		wp_enqueue_script(
			'jbr-cycle2-transitions',
			$JBR_PLUGIN['url'] . 'js/cycle/transition-plugins/transitions.php',
			array('jquery', 'jbr-cycle2'),
			null,
			true
		);
	}

	public function wpStyles()
	{
		global $JBR_PLUGIN;

		wp_enqueue_style(
			'jbr-cycle',
			$JBR_PLUGIN['url'] . 'css/jbr-cycle.min.css',
			array(),
			null,
			'screen, print'
		);
	}

	public function adminScripts()
	{
		global $JBR_PLUGIN;

		wp_enqueue_script(
			'jbr-mask',
			$JBR_PLUGIN['url'] . 'js/jbr-mask.min.js',
			array('jquery'),
			null,
			true
		);

		wp_enqueue_script(
			'jbr-form',
			$JBR_PLUGIN['url'] . 'js/jbr.min.js',
			array('jquery', 'media-upload', 'thickbox', 'media-editor'),
			null,
			true
		);

		wp_localize_script(
			'jbr-form',
			'alerts',
			array(
				'msg1' => jbr_get_translate('Empty fields'),
				'msg2' => jbr_get_translate("It's required the image URL"),
				'msg3' => jbr_get_translate('Invalid date'),
			)
		);

		wp_localize_script(
			'jbr-form',
			'jbrattrs',
			array(
				'textbutton' => jbr_get_translate('Insert image')
			)
		);

		wp_enqueue_script('admin-bar');
	}

	public function adminStyles()
	{
		global $JBR_PLUGIN;
		
		wp_enqueue_style(
			'jbr-general',
			$JBR_PLUGIN['url'] . 'css/jbr.min.css'
		);

		wp_enqueue_media();
		wp_enqueue_style('thickbox');
	}
}