<?php

class JBRWidget extends WP_Widget
{
	public function __construct()
	{
		parent::WP_Widget(false, 'jQuery Banner Rotate', array('description' => ''));
	}

	public function widget($args, $instance)
	{
		$title = trim($instance['jbr_title']);
		$id = ($instance['jbr_slider'] > 0)? ' id="' . $instance['jbr_slider'] . '"' : '';
		$width = (isset($instance['jbr_width']) && trim($instance['jbr_width']) != '' &&
			(intval($instance['jbr_width']) == floatval($instance['jbr_width'])))?
			' width="' . $instance['jbr_width'] . '"' : '';
		$height = (isset($instance['jbr_height']) && trim($instance['jbr_height']) != '' &&
			(intval($instance['jbr_height']) == floatval($instance['jbr_height'])))?
			' height="' . $instance['jbr_height'] . '"' : '';
		$count = (isset($instance['jbr_count']) && trim($instance['jbr_count']) != '' &&
			(intval($instance['jbr_count']) == floatval($instance['jbr_count'])))?
			' count="' . $instance['jbr_count'] . '"' : '';
		$delay = (isset($instance['jbr_delay']) && trim($instance['jbr_delay']) != '' &&
			(intval($instance['jbr_delay']) == floatval($instance['jbr_delay'])))?
			' delay="' . trim($instance['jbr_delay']) . '"' : '';
		$pause_on_hover = (in_array($instance['jbr_pause_on_hover'], array('true', 'false')))?
			' pause_on_hover="' . $instance['jbr_pause_on_hover'] . '"': '';
		$showpager = (in_array($instance['jbr_showpager'], array('true', 'false')))?
			' showpager="' . $instance['jbr_showpager'] . '"': '';
		$effect = ' effect="' . $instance['jbr_effect'] . '"';
		$positionpager = ' positionpager="' . $instance['jbr_positionpager'] . '"';

		$atts = $id . $width . $height . $count . $delay . $pause_on_hover . $showpager . $effect . $positionpager;

		echo $args['before_widget'];

		if ($title != '')
		{
			echo $args['before_title'];
			echo $title;
			echo $args['after_title'];
		}

		echo do_shortcode("[jquery-banner-rotate{$atts}]");
		echo $args['after_widget'];
	}

	public function form($instance)
	{
		global $jbr_slider;

		$s = $instance['jbr_slider'];
		$title = trim($instance['jbr_title']);
		$width = trim($instance['jbr_width']);
		$height = trim($instance['jbr_height']);
		$count = $instance['jbr_count'];
		$delay = trim($instance['jbr_delay']);
		$pause_on_hover = $instance['jbr_pause_on_hover'];
		$showpager = $instance['jbr_showpager'];
		$positionpager = $instance['jbr_positionpager'];
		$effect = $instance['jbr_effect'];

		$sliders = $jbr_slider->listAll();
		?>
		<p>
			<label for="<?= $this->get_field_id('jbr_title'); ?>">
				<strong><?php jbr_the_translate('Title') ?></strong><br>
				<input type="text" id="<?= $this->get_field_id('jbr_title'); ?>" class="widefat"
					name="<?= $this->get_field_name('jbr_title'); ?>" value="<?= $title ?>">
			</label>
		</p>
		<p>
			<label for="<?= $this->get_field_id('jbr_slider'); ?>">
				<strong><?php jbr_the_translate('Slider') ?></strong><br>
				<select id="<?= $this->get_field_id('jbr_slider'); ?>" name="<?= $this->get_field_name('jbr_slider'); ?>">
					<option value="0"><?php jbr_the_translate('Select...'); ?></option>
					<?php if ($sliders) : foreach ($sliders as $slider) : ?>
						<option value="<?= $slider->id ?>" <?= ($s == $slider->id)? 'selected' : ''?>>
							<?= $slider->nome ?>
						</option>
					<?php endforeach; endif; ?>
				</select>
			</label>
		</p>
		<p>
			<label for="<?= $this->get_field_id('jbr_width'); ?>">
				<strong><?php jbr_the_translate('Width') ?></strong><br>
				<input type="text" id="<?= $this->get_field_id('jbr_width'); ?>"
					name="<?= $this->get_field_name('jbr_width'); ?>" value="<?= $width ?>">
			</label>
		</p>
		<p>
			<label for="<?= $this->get_field_id('jbr_height'); ?>">
				<strong><?php jbr_the_translate('Height') ?></strong><br>
				<input type="text" id="<?= $this->get_field_id('jbr_height'); ?>"
					name="<?= $this->get_field_name('jbr_height'); ?>" value="<?= $height ?>">
			</label>
		</p>
		<p>
			<label for="<?= $this->get_field_id('jbr_count'); ?>">
				<strong><?php jbr_the_translate('Number of banners'); ?></strong><br>
				<input type="text" id="<?= $this->get_field_id('jbr_count'); ?>"
					name="<?= $this->get_field_name('jbr_count'); ?>" value="<?= $count ?>">
			</label>
		</p>
		<p>
			<label for="<?= $this->get_field_id('jbr_delay'); ?>">
				<strong><?php jbr_the_translate('Delay'); ?></strong><br>
				<input type="text" name="<?= $this->get_field_name('jbr_delay'); ?>" value="<?= $delay ?>"
					id="<?= $this->get_field_id('jbr_delay'); ?>">
				<em><?php jbr_the_translate('(in milliseconds)'); ?></em>
			</label>
		</p>
		<p>
			<label for="<?= $this->get_field_id('jbr_pause_on_hover'); ?>">
				<strong><?php jbr_the_translate('Pause on hover'); ?></strong><br>
				<select name="<?= $this->get_field_name('jbr_pause_on_hover'); ?>"
					id="<?= $this->get_field_id('jbr_pause_on_hover'); ?>">
					<option value="true" <?= ($pause_on_hover == 'true')? 'selected' : ''?>>
						<?php jbr_the_translate('Yes'); ?>
					</option>
					<option value="false" <?= ($pause_on_hover == 'false')? 'selected' : ''?>>
						<?php jbr_the_translate('No'); ?>
					</option>
				</select>
			</label>
		</p>
		<p>
			<label for="<?= $this->get_field_id('jbr_showpager'); ?>">
				<strong><?php jbr_the_translate('Show pager'); ?></strong><br>
				<select name="<?= $this->get_field_name('jbr_showpager'); ?>"
					id="<?= $this->get_field_id('jbr_showpager'); ?>">
					<option value="true" <?= ($showpager == 'true')? 'selected' : ''?>>
						<?php jbr_the_translate('Yes'); ?>
					</option>
					<option value="false" <?= ($showpager == 'false')? 'selected' : ''?>>
						<?php jbr_the_translate('No'); ?>
					</option>
				</select>
			</label>
		</p>
		<p>
			<label for="<?= $this->get_field_id('jbr_positionpager'); ?>">
				<strong><?php jbr_the_translate('Pager position'); ?></strong><br>
				<select name="<?= $this->get_field_name('jbr_positionpager'); ?>"
					id="<?= $this->get_field_id('jbr_positionpager'); ?>">
					<option value="top-left" <?= ($positionpager == 'top-left')? 'selected' : ''?>>
						<?php jbr_the_translate('Top-Left'); ?>
					</option>
					<option value="top-center" <?= ($positionpager == 'top-center')? 'selected' : ''?>>
						<?php jbr_the_translate('Top-Center'); ?>
					</option>
					<option value="top-right" <?= ($positionpager == 'top-right')? 'selected' : ''?>>
						<?php jbr_the_translate('Top-Right'); ?>
					</option>
					<option value="bottom-left" <?= ($positionpager == 'bottom-left')? 'selected' : ''?>>
						<?php jbr_the_translate('Down-Left'); ?>
					</option>
					<option value="bottom-center" <?= ($positionpager == 'bottom-center')? 'selected' : ''?>>
						<?php jbr_the_translate('Down-Center'); ?>
					</option>
					<option value="bottom-right" <?= ($positionpager == 'bottom-right')? 'selected' : ''?>>
						<?php jbr_the_translate('Down-Right'); ?>
					</option>
				</select>
			</label>
		</p>
		<p>
			<label for="<?= $this->get_field_id('jbr_effect'); ?>">
				<strong><?php jbr_the_translate('Effect'); ?></strong><br>
				<select name="<?= $this->get_field_name('jbr_effect'); ?>"
					id="<?= $this->get_field_id('jbr_effect'); ?>">
					<option value="none"><?php jbr_the_translate('Select...'); ?></option>
					<option value="fade" <?= ($effect == 'fade')? 'selected' : ''?>>Fade</option>
					<option value="fadeout" <?= ($effect == 'fadeout')? 'selected' : ''?>>Fade Out</option>
					<option value="scrollHorz" <?= ($effect == 'scrollHorz')? 'selected' : ''?>>
						Scroll Horizontal
					</option>
					<option value="scrollVert" <?= ($effect == 'scrollVert')? 'selected' : ''; ?>>
						Scroll Vertical
					</option>
					<option value="flipHorz" <?= ($effect == 'flipHorz')? 'selected' : ''; ?>>
						Flip Horizontal
					</option>
					<option value="flipVert" <?= ($effect == 'flipVert')? 'selected' : ''; ?>>
						Flip Vertical
					</option>
					<option value="shuffle" <?= ($effect == 'shuffle')? 'selected' : ''; ?>>Shuffle</option>
					<option value="tileSlide-vert" <?= ($effect == 'tileSlide-vert')? 'selected' : ''; ?>>
						Tile Slide Vertical
					</option>
					<option value="tileSlide-horz" <?= ($effect == 'tileSlide-horz')? 'selected' : ''; ?>>
						Tile Slide Horizontal
					</option>
					<option value="tileBlind-vert" <?= ($effect == 'tileBlind-vert')? 'selected' : ''; ?>>
						Tile Blind Vertical
					</option>
					<option value="tileBlind-horz" <?= ($effect == 'tileBlind-horz')? 'selected' : ''; ?>>
						Tile Blind Horizontal
					</option>
				</select><br>
				<em>
					<?php jbr_the_translate("<strong>Warning:</strong> The Slider's effect will overwrite this effect"); ?>
				</em>
			</label>
		</p>
	<?php }

	public function update($new_instance, $old_instance)
	{
		return array_merge($old_instance, $new_instance);
	}
}

add_action('widgets_init', create_function('', 'return register_widget("JBRWidget");'));