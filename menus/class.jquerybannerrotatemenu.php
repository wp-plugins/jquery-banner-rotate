<?php

class JqueryBannerRotateMenu
{
	private $banner_menu_dir;

	private $slider_menu_dir;

	private $titles;

	private $image_url;

	public function __construct()
	{
		global $JBR_PLUGIN;

		$this->banner_menu_dir = $JBR_PLUGIN['dir'] . 'menus/banner/';
		$this->slider_menu_dir = $JBR_PLUGIN['dir'] . 'menus/slider/';
		$this->image_url = $JBR_PLUGIN['url'] . 'img/logo.png';

		add_action('admin_menu', array($this, 'initMenu'));
	}

	public function initMenu()
	{
		$this->titles = array(
			'all-banners' => jbr_get_translate('All Banners'),
			'new-banner' => jbr_get_translate('New Banner'),
			'all-sliders' => jbr_get_translate('All Sliders'),
			'new-slider' => jbr_get_translate('New Slider')
		);

		add_menu_page(
			'jQuery Banner Rotate',
			'jQuery Banner Rotate',
			'upload_files',
			'jquery-banner-rotate',
			'jbr_general_page',
			$this->image_url
		);

		add_submenu_page(
			'jquery-banner-rotate',
			$this->titles['all-banners'],
			$this->titles['all-banners'],
			'upload_files',
			'jbr-all-banners',
			array($this, 'allBanners')
		);

		add_submenu_page(
			'jquery-banner-rotate',
			$this->titles['new-banner'],
			$this->titles['new-banner'],
			'upload_files',
			'jbr-new-banner',
			array($this, 'newBanner')
		);

		add_submenu_page(
			'jquery-banner-rotate',
			$this->titles['all-sliders'],
			$this->titles['all-sliders'],
			'upload_files',
			'jbr-all-sliders',
			array($this, 'allSliders')
		);

		add_submenu_page(
			'jquery-banner-rotate',
			$this->titles['new-slider'],
			$this->titles['new-slider'],
			'upload_files',
			'jbr-new-slider',
			array($this, 'newSlider')
		);
	}

	public function allBanners()
	{
		global $jbr_banner, $jbr_slider;

		if (isset($_GET['delete']) && is_numeric($_GET['delete']) &&
			(intval($_GET['delete']) == floatval($_GET['delete'])))
		{
			if (jbr_hash_value($_GET['delete']) == $_GET['h'])
			{
				$jbr_banner->delete($_GET['delete']);

				jbr_message_success('Banner deleted successfully');
			}
			else
			{
				jbr_message_error('Action not allowed');
			}
		}

		$banners = $jbr_banner->listAll();

		include($this->banner_menu_dir . 'list.php');
	}

	public function newBanner()
	{
		global $jbr_banner, $jbr_slider, $JBR_PLUGIN;

		if ($_SERVER['REQUEST_METHOD'] === 'POST')
		{
			if (isset($_POST['id']) && is_numeric($_POST['id']) && (intval($_POST['id']) == floatval($_POST['id'])))
			{
				if (isset($_POST['action']) && $_POST['action'] == 'update')
				{
					if (jbr_hash_value($_POST['action']) == $_POST['hash_action'])
					{
						if (jbr_hash_value($_POST['id']) == $_POST['hash_id'])
						{
							$id = $_POST['id'];

							unset($_POST['id']);
							unset($_POST['hash_id']);
							unset($_POST['action']);
							unset($_POST['hash_action']);

							$values = array(
								'link' => $_POST['link'],
								'data_retirada' => jbr_date_mysql($_POST['dataRetirada']),
								'pagina' => $_POST['pagina'],
								'nova' => $_POST['nova'],
								'slider_id' => $_POST['slider_id']
							);

							$jbr_banner->update($id, $values);

							jbr_message_success('Banner updated successfully');
						}
						else
						{
							jbr_message_error('Action not allowed');
						}
					}
					else
					{
						jbr_message_error('Action not allowed');
					}
				}
				else
				{
					jbr_message_error('Action not allowed');
				}
			}
			else
			{
				$values = array(
					'link' => $_POST['link'],
					'data_insercao' => date('Y-m-d'),
					'data_retirada' => jbr_date_mysql($_POST['dataRetirada']),
					'pagina' => $_POST['pagina'],
					'nova' => $_POST['nova'],
					'slider_id' => $_POST['slider_id']
				);

				$jbr_banner->save($values);

				jbr_message_success('Banner registered successfully');
			}
		}

		$sliders = $jbr_slider->listAll();

		wp_register_script(
			'jbr-form',
			$JBR_PLUGIN['url'] . 'js/banner-rotativo.min.js',
			array(),
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

		wp_enqueue_script('jbr-form');
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');

		if (isset($_GET['id']) && is_numeric($_GET['id']) && (intval($_GET['id']) == floatval($_GET['id'])))
		{
			$banner = $jbr_banner->find($_GET['id']);
		}

		if ($banner)
		{
			include($this->banner_menu_dir . 'edit.php');
		}
		else
		{
			include($this->banner_menu_dir . 'new.php');
		}
	}

	public function allSliders()
	{
		global $jbr_slider, $jbr_banner;

		if (isset($_GET['delete']) && is_numeric($_GET['delete']) &&
			(intval($_GET['delete']) == floatval($_GET['delete'])))
		{
			if (jbr_hash_value($_GET['delete']) == $_GET['h'])
			{
				$jbr_slider->delete($_GET['delete'], $jbr_banner->getTableName());

				jbr_message_success('Slider deleted successfully');
			}
			else
			{
				jbr_message_error('Action not allowed');
			}
		}

		$sliders = $jbr_slider->listAll();

		include($this->slider_menu_dir . 'list.php');
	}

	public function newSlider()
	{
		global $jbr_slider;

		if ($_SERVER['REQUEST_METHOD'] === 'POST')
		{
			if (isset($_POST['id']) && is_numeric($_POST['id']) && (intval($_POST['id']) == floatval($_POST['id'])))
			{
				if (isset($_POST['action']) && $_POST['action'] == 'update')
				{
					if (jbr_hash_value($_POST['action']) == $_POST['hash_action'])
					{
						if (jbr_hash_value($_POST['id']) == $_POST['hash_id'])
						{
							$id = $_POST['id'];

							unset($_POST['id']);
							unset($_POST['hash_id']);
							unset($_POST['action']);
							unset($_POST['hash_action']);

							$jbr_slider->update($id, $_POST);

							jbr_message_success('Slider updated successfully');
						}
						else
						{
							jbr_message_error('Action not allowed');
						}
					}
					else
					{
						jbr_message_error('Action not allowed');
					}
				}
				else
				{
					jbr_message_error('Action not allowed');
				}
			}
			else
			{
				$jbr_slider->save($_POST);

				jbr_message_success('Slider registered successfully');
			}
		}

		if (isset($_GET['id']) && is_numeric($_GET['id']) && (intval($_GET['id']) == floatval($_GET['id'])))
		{
			$slider = $jbr_slider->find($_GET['id']);
		}

		if ($slider)
		{
			include($this->slider_menu_dir . 'edit.php');
		}
		else
		{
			include($this->slider_menu_dir . 'new.php');
		}
	}
}