<?php

function jbr_init_plugin()
{
	$jbr_banner = new JBRBanner();
	$jbr_slider = new JBRSlider();

	$jbr_banner->createTable();
	$jbr_slider->createTable();

	if (!get_option('jbr_hash_key'))
	{
		$alpha = 'AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz0123456789!@#$%&*(){}[]';
		$key = '';

		for ($i = 1; $i <= 20; $i++) {
			$index = mt_rand(0, 19);

			$key .= $alpha[$index];
		}

		add_option('jbr_hash_key', $key);
		add_option('jbr_active_notices', 'true');
	}
}

register_activation_hook($JBR_PLUGIN['__FILE__'], 'jbr_init_plugin');

function jbr_uninstall_plugin()
{
	$jbr_banner = new JBRBanner();
	$jbr_slider = new JBRSlider();

	$jbr_banner->dropTable();
	$jbr_slider->dropTable();

	delete_option('jbr_hash_key');
	delete_option('jbr_active_notices');
}

register_uninstall_hook($JBR_PLUGIN['__FILE__'], 'jbr_uninstall_plugin');

function jbr_general_page()
{
	global $JBR_PLUGIN;

	include($JBR_PLUGIN['dir'] . 'jbr-general-page.php');
}

function jbr_hash_value($value)
{
	$key = get_option('jbr_hash_key');
	$part1 = substr($key, 0, 10);
	$part2 = substr($key, 10);

	return hash('sha256', $part1 . $value . $part2);
}

function jbr_message_success($message)
{
	echo '<div class="wrap">';
	echo '<div class="updated">';
	echo '<p>' . jbr_get_translate($message) . '</p>';
	echo '</div>';
	echo '</div>';
}

function jbr_message_error($message)
{
	echo '<div class="wrap">';
	echo '<div class="error">';
	echo '<p>' . jbr_get_translate($message) . '</p>';
	echo '</div>';
	echo '</div>';
}

function jbr_date_mysql($_date = null)
{
	$format = '/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/';

	if ($_date != null && preg_match($format, $_date, $partes))
	{
		return $partes[3] . '-' . $partes[2] . '-' . $partes[1];
	}

	return '';
}

function jbr_date($data)
{
	return date('d/m/Y', strtotime($data));
}

function jbr_validate_date($data_atual, $data_expira)
{
	if($data_expira == '' || $data_expira == '0000-00-00')
		return true;
	
	list($aa, $ma, $da) = split('-', $data_atual);
	list($ae, $me, $de) = split('-', $data_expira);
	
	if (intval($aa) > intval($ae))
	{
		return false;
	}
	else if (intval($aa) == intval($ae))
	{
		if (intval($ma) > intval($me))
		{
			return false;
		}
		else if (intval($ma) == intval($me))
		{	
			if (intval($da) > intval($de))
			{
				return false;
			}
			else
			{
				return true;
			}
		}
		else
		{
			return true;
		}
	}
	else
	{
		return true;
	}
}

function jbr_textdomain()
{
	global $JBR_PLUGIN;

	load_plugin_textdomain($JBR_PLUGIN['textdomain'], false, dirname(plugin_basename(__FILE__)) . '/lang/');
}

function jbr_get_translate($message)
{
	global $JBR_PLUGIN;

	return __($message, $JBR_PLUGIN['textdomain']);
}

function jbr_the_translate($message)
{
	global $JBR_PLUGIN;

	_e($message, $JBR_PLUGIN['textdomain']);
}

function jbr_resource_url($relativePath)
{
	return plugins_url($relativePath, plugin_basename(__FILE__));
}

function jbr_update_status_notices()
{
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		if (isset($_POST['jbr-notices-form']) && $_POST['jbr-notices-form'] == 1)
		{
			if (isset($_POST['jbr-notices-form-hash']) &&
				$_POST['jbr-notices-form-hash'] == jbr_hash_value('jbr-notices-form'))
			{
				if (isset($_POST['jbr_active_notices']) && $_POST['jbr_active_notices'] == 'true')
				{
					update_option('jbr_active_notices', $_POST['jbr_active_notices']);
				}
				else
				{
					update_option('jbr_active_notices', 'false');
				}
			}
		}
	}
}

add_action('init', 'jbr_update_status_notices');

function jbr_notices()
{
	$acn = get_option('jbr_active_notices');

	if ($acn == 'true')
	{
		echo '<div class="error"><p>';

		jbr_the_translate(
			'The shortcode [banner-rotativo] is obsolete and will be removed in future versions. Replace it by [jquery-banner-rotate]'
		);

		echo ' - <b>jQuery Banner Rotate</b>';
		echo '</p></div>';
	}
}