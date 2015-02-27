<?php

function jbr_shortcode($atts)
{
	global $JBR_PLUGIN, $jbr_banner, $jbr_slider, $jbr_shortcode_index;
	
	$jbr_shortcode_index++;
	$si = $jbr_shortcode_index;

	$atts = shortcode_atts(
		array(
			'id' => '',
			'count' => '',
			'width' => '300',
			'height' => '313',
			'delay' => '300',
			'pause_on_hover' => 'true',
			'showpager' => 'true',
			'positionpager' => 'bottom-center',
			'effect' => 'none'
		),
		$atts
	);

	$count = (is_numeric($atts['count']) && (intval($atts['count']) == floatval($atts['count'])))? $atts['count'] : '0';
	
	$output = '';
	$banners = null;
	$i = 0;
	$effect = $atts['effect'];
	
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

		$count_banners = count($banners);
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

		$count_banners = count($banners);
		$slider = $jbr_slider->find($atts['id']);
		$effect = $slider->efeito;
	}

	if ($banners)
	{
		$effects = array(
			'none',
			'fade',
			'fadeout',
			'scrollHorz',
			'scrollVert',
			'flipHorz',
			'flipVert',
			'shuffle',
			'tileSlide-vert',
			'tileSlide-horz',
			'tileBlind-vert',
			'tileBlind-horz'
		);

		if (!in_array($effect, $effects))
		{
			$effect = 'none';
		}

		if (strpos($effect, 'tile') !== false)
		{
			$tile = spliti('-', $effect);
			$effect = $tile[0];
			$vert = $tile[1];

			if ($vert == 'horz')
			{
				$vert = 'data-cycle-tile-vertical="false"';
			}
			else
			{
				$vert = '';
			}
		}
		else
		{
			$vert = '';
		}

		$output .= '<div id="jbr-banners" data-cycle-prev="#jbr-prev-' . $si . '" data-cycle-next="#jbr-next-' . $si
			. '" data-cycle-slides="> a" ' . $vert . ' class="cycle-slideshow" data-cycle-fx="' . $effect
			. '" style="width: ' . $atts['width'] . 'px; height: ' . $atts['height'] . 'px;" data-cycle-pause-on-hover="'
			. $atts['pause_on_hover'] . '" data-cycle-speed="' . $atts['delay'] . '">';
		
		foreach ($banners as $banner) {
			$blank = ($banner->nova == '1')? 'target="_blank"' : '';
			$output .= '<a href="' . $banner->pagina . '" ' . $blank . '>';
			$output .= '<img src="' . $banner->link . '" width="' . $atts['width'] . '" height="' . $atts['height'] . '">';
			$output .= '</a>';
		}
		
		if ($atts['showpager'] == 'true' && $count_banners > 1)
		{
			$position = spliti('-', $atts['positionpager']);

			if (in_array('top', $position))
			{
				$vert_pos = 'top: 10px;';
			}
			else if (in_array('bottom', $position))
			{
				$vert_pos = 'bottom: 10px;';
			}
			else
			{
				$vert_pos = 'bottom: 10px;';
			}

			if (in_array('left', $position))
			{
				$horz_pos = 'text-align: left;';
			}
			else if (in_array('right', $position))
			{
				$horz_pos = 'text-align: right;';
			}
			else if (in_array('center', $position))
			{
				$horz_pos = 'text-align: center;';
			}
			else
			{
				$horz_pos = 'text-align: center;';
			}
			
			$output .= "<div class=\"cycle-pager\" style=\"$vert_pos $horz_pos\"></div>";
		}

		if ($count_banners > 1)
		{
			$output .= '<div class="jbr-table-controls">';
			$output .= '<div class="jbr-controls jbr-prev" id="jbr-prev-' . $si . '"></div>';
			$output .= '<div class="jbr-controls jbr-next" id="jbr-next-' . $si . '"></div>';
			$output .= '</div>';
		}

		$output .= '</div>';
		$output .= '<!-- jQuery Banner Rotate | Developed by Pedro Marcelo de Sá Alves -->';
	}
		
	
	return $output;
}

add_shortcode('banner-rotativo', 'jbr_shortcode');
add_shortcode('jquery-banner-rotate', 'jbr_shortcode');