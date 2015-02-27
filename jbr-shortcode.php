<?php

function jbr_shortcode($atts)
{
	global $JBR_PLUGIN, $jbr_banner, $jbr_slider;
	
	$atts = shortcode_atts(
		array(
			'id' => '',
			'width' => '300',
			'height' => '313',
			'count' => ''
		),
		$atts
	);

	$count = (is_numeric($atts['count']) && (intval($atts['count']) == floatval($atts['count'])))? $atts['count'] : '0';
	
	$output = '';
	$banners = null;
	$i = 0;
	
	if ($atts['id'] == '')
	{
		if (intval($count) == 0)
		{
			$banners = $jbr_banner->getBanners();
		}
		else
		{
			$banners = $jbr_banner->getBanners($count);
		}
		
		$cycle_script = $JBR_PLUGIN['url'] . 'js/fade-slider-cycle.min.js';
	}
	else
	{
		if (intval($count) == 0)
		{
			$banners = $jbr_banner->getBannersBySlider($atts['id']);
		}
		else
		{
			$banners = $jbr_banner->getBannersBySlider($atts['id'], $count);
		}

		$slider = $jbr_slider->find($atts['id']);
		
		if ($slider->efeito == 'default')
		{
			$cycle_script = $JBR_PLUGIN['url'] . 'js/fade-slider-cycle.min.js';
		}
		else
		{
			$cycle_script = $JBR_PLUGIN['url'] . 'js/' . $slider->efeito . '-slider-cycle.min.js';
		}
	}

	if ($banners)
	{
		$output .= '<style type="text/css" media="screen, print">';
		$output .= '#jbr-banners{overflow:hidden}#jbr-banners a{float:left}';
		$output .= '</style>';
		$output .= '<div id="jbr-banners" style="width: ' . $atts['width'] . 'px; height: ' . $atts['height'] . 'px;">';
		
		foreach ($banners as $banner) {
			$blank = ($banner->nova == '1')? 'target="_blank"' : '';
			$output .= '<a href="' . $banner->pagina . '" ' . $blank . '>';
			$output .= '<img src="' . $banner->link . '">';
			$output .= '</a>';
		}
		
		$output .= '</div>';

		wp_enqueue_script(
			'jbr-cycle',
			$JBR_PLUGIN['url'] . 'js/cycle.min.js',
			array('jquery', 'jquery-effects-core'),
			null,
			true
		);

		wp_enqueue_script(
			'jbr-cycle-exec',
			$cycle_script,
			array('jquery', 'jbr-cycle'),
			null,
			true
		);
	}
		
	
	return $output;
}

add_shortcode('banner-rotativo', 'jbr_shortcode');
add_shortcode('jquery-banner-rotate', 'jbr_shortcode');