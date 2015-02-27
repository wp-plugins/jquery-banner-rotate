<?php global $JBR_PLUGIN; ?>

<form action="" method="post">
	<input type="hidden" name="jbr-notices-form" value="1">
	<input type="hidden" name="jbr-notices-form-hash" value="<?= jbr_hash_value('jbr-notices-form'); ?>">
	<table class="form-table">
		<tbody>
			<tr>
				<th>
					<label for="jbr_active_notices">
						<?php jbr_the_translate('Enable notices'); ?>
					</label>
				</th>
				<td>
					<input type="checkbox" name="jbr_active_notices" id="jbr_active_notices" value="true"
						<?php if (get_option('jbr_active_notices') == 'true') echo 'checked'; ?>>
				</td>
			</tr>
			<tr>
				<th>
					<input type="submit" class="button-primary" value="<?php jbr_the_translate('Update'); ?>">
				</th>
			</tr>
		</tbody>
	</table>
</form>

<link href="<?php echo $JBR_PLUGIN['url']; ?>css/banner-rotativo.css" rel="stylesheet" />
<table class="wp-list-table widefat fixed" style="width:600px; margin-top:15px;">
	<tr>
		<td>
			<h2>jQuery Banner Rotate</h2>
		</td>
	</tr>
	<tr>
		<td>
			<?php
				jbr_the_translate(
					'To use the slide of the saved banners just use the shortcode'
				);
			?>
			<span class="shortcode">[jquery-banner-rotate]</span>.
			<?php
				jbr_the_translate(
					'It also uses the parameters for height and width of the slide, just put the width and height parameters as in the example:'
					);
			?>
			<span class="shortcode">[jquery-banner-rotate width=200 height=200]</span>.
			<?php
				jbr_the_translate(
					'If the images are in a specific slide just specify the id of the slide:'
				);
			?>
			<span class="shortcode">[jquery-banner-rotate id=1]</span>.
			<?php
				jbr_the_translate(
					'If you want to show images from any slide just not specify the id. You can also specify a max number of slides using'
				);
			?>
			<span class="shortcode">[jquery-banner-rotate count=7]</span>.
		</td>
	</tr>
	<tr>
		<td>
			<span class="descricao">
				<p>
					<?php
						jbr_the_translate(
							'This plugin was developed by Pedro Marcelo. Send suggestions to pedromarcelodesaalves@gmail.com'
						);
					?>
				</p>
			</span>
		</td>
	</tr>
</table>

<table class="wp-list-table widefat fixed" style="width:600px; margin-top:15px;">
	<thead>
		<tr>
			<th colspan="3" style="text-align:center">
				<h3><?php jbr_the_translate('Shortcode parameters'); ?></h3>
			</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<strong>id (<?php jbr_the_translate('optional'); ?>)</strong>
			</td>
			<td>
				<?php
					jbr_the_translate('Contains an integer value representing the slider ID that will be displayed');
				?>
			</td>
			<td><?php jbr_the_translate('Default value'); ?>: ''</td>
		</tr>
		<tr>
			<td>
				<strong>width (<?php jbr_the_translate('optional'); ?>)</strong>
			</td>
			<td><?php jbr_the_translate("Slider's width"); ?> <?php jbr_the_translate('(in px)'); ?></td>
			<td><?php jbr_the_translate('Default value'); ?>: 300px</td>
		</tr>
		<tr>
			<td>
				<strong>height (<?php jbr_the_translate('optional'); ?>)</strong>
			</td>
			<td><?php jbr_the_translate("Slider's height"); ?> <?php jbr_the_translate('(in px)'); ?></td>
			<td><?php jbr_the_translate('Default value'); ?>: 313px</td>
		</tr>
		<tr>
			<td>
				<strong>count (<?php jbr_the_translate('optional'); ?>)</strong>
			</td>
			<td><?php jbr_the_translate('Maximum number of banners'); ?></td>
			<td><?php jbr_the_translate('Default value'); ?>: ''</td>
		</tr>
		<tr>
			<td>
				<strong>delay (<?php jbr_the_translate('optional'); ?>)</strong>
			</td>
			<td><?php jbr_the_translate('Time interval between the images (in milliseconds)'); ?></td>
			<td><?php jbr_the_translate('Default value'); ?>: 300</td>
		</tr>
		<tr>
			<td>
				<strong>page_on_hover (<?php jbr_the_translate('optional'); ?>)</strong>
			</td>
			<td><?php jbr_the_translate('Pause the Slider placing the mouse over it'); ?></td>
			<td><?php jbr_the_translate('Default value'); ?>: true</td>
		</tr>
		<tr>
			<td>
				<strong>showpager (<?php jbr_the_translate('optional'); ?>)</strong>
			</td>
			<td><?php jbr_the_translate('Add a pager in the Slider'); ?></td>
			<td><?php jbr_the_translate('Default value'); ?>: true</td>
		</tr>
		<tr>
			<td>
				<strong>positionpager (<?php jbr_the_translate('optional'); ?>)</strong>
			</td>
			<td><?php jbr_the_translate('Position of the pager'); ?></td>
			<td><?php jbr_the_translate('Default value'); ?>: bottom-center</td>
		</tr>
		<tr>
			<td>
				<strong>effect (<?php jbr_the_translate('optional'); ?>)</strong>
			</td>
			<td><?php jbr_the_translate("Slider's effect"); ?></td>
			<td><?php jbr_the_translate('Default value'); ?>: none</td>
		</tr>
	</tbody>
</table>