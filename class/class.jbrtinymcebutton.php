<?php

class JBRTinyMCEButton
{
	public function __construct()
	{
		add_action('init', array($this, 'init'));
		add_filter('tiny_mce_version', array($this, 'jbrRefreshMCE'));
		add_action('wp_ajax_jquery_banner_rotate_tinymce_ajax', array($this, 'tinymceButtonPage'));
	}

	public function init()
	{
		if (!current_user_can('edit_posts') && !current_user_can('edit_pages'))
			return;

		if (get_user_option('rich_editing') == 'true')
		{
			add_filter('mce_external_plugins', array($this, 'addJqueryBannerRotateTinyMCEPlugin'));
			add_filter('mce_buttons', array($this, 'registerJqueryBannerRotateButton'));
		}
	}

	public function addJqueryBannerRotateTinyMCEPlugin($plugin_array)
	{
		global $JBR_PLUGIN;

		$plugin_array['jquerybannerrotate'] = $JBR_PLUGIN['url'] . 'js/jbr-tinymce-button.js';
		return $plugin_array;
	}

	public function registerJqueryBannerRotateButton($buttons)
	{
		array_push($buttons, "|", "jquerybannerrotate");
		return $buttons;
	}

	public function jbrRefreshMCE($ver)
	{
		$ver += 3;
		return $ver;
	}

	public function tinymceButtonPage()
	{
		global $JBR_PLUGIN, $jbr_slider;

		$sliders = $jbr_slider->listAll();
		?>
		<!DOCTYPE html>
		<html>
		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<title>jQuery Banner Rotate</title>
			<?php
				wp_enqueue_script('tiny_mce_popup.js', includes_url('js/tinymce/tiny_mce_popup.js'));
				wp_print_scripts('jquery');
				wp_print_scripts('tiny_mce_popup.js');
			?>
			<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,400,600,700' rel='stylesheet' type='text/css'>
			<link rel="stylesheet" href="<?= $JBR_PLUGIN['url']; ?>css/jbr-tinymce.min.css">
		</head>
		<body>
			<form id="jbr-super-table">
				<div class="jbr-super-cell">
					<div class="jbr-table">
						<div class="jbr-table-row">
							<div class="jbr-cell">
								<strong><?php jbr_the_translate('Slider') ?></strong>
							</div>
							<div class="jbr-cell">
								<select name="jbr_slider" id="jbr_slider">
									<option value="0"><?php jbr_the_translate('Select...') ?></option>
									<?php foreach ($sliders as $slider) : ?>
										<option value="<?= $slider->id ?>"><?= $slider->nome ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="jbr-table-row">
							<div class="jbr-cell">
								<label for="jbr_width">
									<strong><?php jbr_the_translate('Width') ?></strong>
								</label>
							</div>
							<div class="jbr-cell">
								<input type="text" name="jbr_width" id="jbr_width" class="jbr-number-field">
							</div>
						</div>
						<div class="jbr-table-row">
							<div class="jbr-cell">
								<label for="jbr_height">
									<strong><?php jbr_the_translate('Height') ?></strong>
								</label>
							</div>
							<div class="jbr-cell">
								<input type="text" name="jbr_height" id="jbr_height" class="jbr-number-field">
							</div>
						</div>
						<div class="jbr-table-row">
							<div class="jbr-cell">
								<label for="jbr_count">
									<strong><?php jbr_the_translate('Number of banners') ?></strong>
								</label>
							</div>
							<div class="jbr-cell">
								<input type="text" name="jbr_count" id="jbr_count" class="jbr-number-field">
							</div>
						</div>
						<div class="jbr-table-row">
							<div class="jbr-cell">
								<label for="jbr_delay">
									<strong><?php jbr_the_translate('Delay') ?></strong>
								</label>
							</div>
							<div class="jbr-cell">
								<input type="text" name="jbr_delay" id="jbr_delay" class="jbr-number-field">
								<br><em><?php jbr_the_translate('(in milliseconds)') ?></em>
							</div>
						</div>
					</div>
				</div>
				<div class="jbr-super-cell">
					<div class="jbr-table">
						<div class="jbr-table-row">
							<div class="jbr-cell">
								<label for="jbr_pause_on_hover">
									<strong><?php jbr_the_translate('Pause on hover') ?></strong>
								</label>
							</div>
							<div class="jbr-cell">
								<select name="jbr_pause_on_hover" id="jbr_pause_on_hover">
									<option value="true"><?php jbr_the_translate('Yes'); ?></option>
									<option value="false"><?php jbr_the_translate('No'); ?></option>
								</select>
							</div>
						</div>
						<div class="jbr-table-row">
							<div class="jbr-cell">
								<label for="jbr_show_pager">
									<strong><?php jbr_the_translate('Show pager') ?></strong>
								</label>
							</div>
							<div class="jbr-cell">
								<select name="jbr_show_pager" id="jbr_show_pager">
									<option value="true"><?php jbr_the_translate('Yes'); ?></option>
									<option value="false"><?php jbr_the_translate('No'); ?></option>
								</select>
							</div>
						</div>
						<div class="jbr-table-row">
							<div class="jbr-cell">
								<label for="jbr_positionpager">
									<strong><?php jbr_the_translate('Pager position') ?></strong>
								</label>
							</div>
							<div class="jbr-cell">
								<select name="jbr_positionpager" id="jbr_positionpager">
									<option value="top-left"><?php jbr_the_translate('Top-Left'); ?></option>
									<option value="top-center"><?php jbr_the_translate('Top-Center'); ?></option>
									<option value="top-right"><?php jbr_the_translate('Top-Right'); ?></option>
									<option value="bottom-left"><?php jbr_the_translate('Down-Left'); ?></option>
									<option value="bottom-center"><?php jbr_the_translate('Down-Center'); ?></option>
									<option value="bottom-right"><?php jbr_the_translate('Down-Right'); ?></option>
								</select>
							</div>
						</div>
						<div class="jbr-table-row">
							<div class="jbr-cell">
								<label for="jbr_effect">
									<strong><?php jbr_the_translate('Effect') ?></strong>
								</label>
							</div>
							<div class="jbr-cell">
								<select name="jbr_effect" id="jbr_effect">
									<option value="none"><?php jbr_the_translate('Select...'); ?></option>
									<option value="fade">Fade</option>
									<option value="fadeout">Fade Out</option>
									<option value="scrollHorz">Scroll Horizontal</option>
									<option value="scrollVert">Scroll Vertical</option>
									<option value="flipHorz">Flip Horizontal</option>
									<option value="flipVert">Flip Vertical</option>
									<option value="shuffle">Shuffle</option>
									<option value="tileSlide-vert">Tile Slide Vertical</option>
									<option value="tileSlide-horz">Tile Slide Horizontal</option>
									<option value="tileBlind-vert">Tile Blind Vertical</option>
									<option value="tileBlind-horz">Tile Blind Horizontal</option>
								</select>
								<br>
								<em>
									<?php jbr_the_translate("<strong>Warning:</strong> The Slider's effect will overwrite this effect"); ?>
								</em>
							</div>
						</div>
					</div>
				</div>
				<div class="buttons">
					<input type="submit" class="button-primary" value="<?php jbr_the_translate('Insert'); ?>">
					<input type="button" class="button" value="<?php jbr_the_translate('Cancel'); ?>">
				</div>
			</form>
			<script type="text/javascript">
				(function($){
					$('.jbr-number-field').keypress(function(e){
						if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
							return false;
						}
					});

					$('#jbr-super-table').submit(function(e){
						e.preventDefault();
						var slider = $('#jbr_slider').val().trim();
						var width = $('#jbr_width').val().trim();
						var height = $('#jbr_height').val().trim();
						var count = $('#jbr_count').val().trim();
						var delay = $('#jbr_delay').val().trim();
						var pause_on_hover = $('#jbr_pause_on_hover').val().trim();
						var show_pager = $('#jbr_show_pager').val().trim();
						var positionpager = $('#jbr_positionpager').val().trim();
						var effect = $('#jbr_effect').val().trim();
						var shortcode = '[jquery-banner-rotate';

						if (parseInt(slider) > 0)
						{
							shortcode += ' id="' + slider + '"';
						}

						if (width != "")
						{
							shortcode += ' width="' + width + '"';
						}

						if (height != "")
						{
							shortcode += ' height="' + height + '"';
						}

						if (count != "")
						{
							shortcode += ' count="' + count + '"';
						}

						if (delay != "")
						{
							shortcode += ' delay="' + delay + '"';
						}

						if (effect != "none")
						{
							shortcode += ' effect="' + effect + '"';
						}

						shortcode += ' pause_on_hover="' + pause_on_hover + '"';
						shortcode += ' showpager="' + show_pager + '"';
						shortcode += ' positionpager="' + positionpager + '"';
						shortcode += ']';

						tinyMCEPopup.execCommand('mceInsertContent', false, shortcode);
						tinyMCEPopup.close();
					});

					$('.button').click(function(e){
						e.preventDefault();
						tinyMCEPopup.close();
					});
				})(jQuery);
			</script>
		</body>
		</html>
		<?php
		die();
	}
}