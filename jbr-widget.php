<?php

class JBRWidget extends WP_Widget
{
	public function __construct()
	{
		parent::WP_Widget(false, 'jQuery Banner Rotate', array('description' => ''));
	}

	public function widget($args, $instance)
	{
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

		echo $args['before_widget'];
		echo do_shortcode("[jquery-banner-rotate{$id}{$width}{$height}{$count}]");
		echo $args['after_widget'];
	}

	public function form($instance)
	{
		global $jbr_slider;

		$s = $instance['jbr_slider'];
		$width = $instance['jbr_width'];
		$height = $instance['jbr_height'];
		$count = $instance['jbr_count'];
		$sliders = $jbr_slider->listAll();
		?>
		<p>
			<label for="<?= $this->get_field_id('jbr_slider'); ?>">
				<b><?php jbr_the_translate('Slider') ?></b>
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
				<b><?php jbr_the_translate('Width') ?></b><br>
				<input type="text" id="<?= $this->get_field_id('jbr_width'); ?>"
					name="<?= $this->get_field_name('jbr_width'); ?>" value="<?= $width ?>">
			</label>
		</p>
		<p>
			<label for="<?= $this->get_field_id('jbr_height'); ?>">
				<b><?php jbr_the_translate('Height') ?></b><br>
				<input type="text" id="<?= $this->get_field_id('jbr_height'); ?>"
					name="<?= $this->get_field_name('jbr_height'); ?>" value="<?= $height ?>">
			</label>
		</p>
		<p>
			<label for="<?= $this->get_field_id('jbr_count'); ?>">
				<b><?php jbr_the_translate('Number of banners'); ?></b><br>
				<input type="text" id="<?= $this->get_field_id('jbr_count'); ?>"
					name="<?= $this->get_field_name('jbr_count'); ?>" value="<?= $count ?>">
			</label>
		</p>
	<?php }

	public function update($new_instance, $old_instance)
	{
		return array_merge($old_instance, $new_instance);
	}
}

add_action('widgets_init', create_function('', 'return register_widget("JBRWidget");'));