<?php global $JBR_PLUGIN; ?>

<form action="" method="post" style="width:490px;" onsubmit="return valida(this);">
	<h2><?php jbr_the_translate('New Banner'); ?></h2>
	<table class="wp-list-table widefat fixed">
		<tr>
			<td width="100">
				<label for="link"><?php jbr_the_translate('Image URL'); ?></label>
			</td>
			<td>
				<input type="text" name="link" id="link"> <?php jbr_the_translate('or'); ?>
				<a class="button-primary" href="#" id="jbr_upload_image_button"
					data-title="<?php jbr_the_translate('Upload image'); ?>">
					<?php jbr_the_translate('Upload image'); ?>
				</a>
				<div id="jbr_upload_image_thumb"></div>
			</td>
		</tr>
		<tr>
			<td>
				<label for="dataRetirada"><?php jbr_the_translate('Expiry date'); ?></label>
			</td>
			<td>
				<input type="text" name="dataRetirada" id="dataRetirada" placeholder="dd/mm/yyyy">
			</td>
		</tr>
		<tr>
			<td>
				<label for="pagina"><?php jbr_the_translate('Page URL'); ?></label>
			</td>
			<td>
				<input type="text" name="pagina" id="pagina">
			</td>
		</tr>
		<tr>
			<td><?php jbr_the_translate('Slider'); ?></td>
			<td>
				<select name="slider_id">
					<option value="0"><?php jbr_the_translate('Select...'); ?></option>
					<?php foreach ($sliders as $slider) : ?>
						<option value="<?= $slider->id ?>"><?= $slider->nome ?></option>
					<?php endforeach; ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<label for="nova"><?php jbr_the_translate('New tab'); ?></label>
			</td>
			<td>
				<input type="checkbox" name="nova" id="nova" value="1">
			</td>
		</tr>
		<tr>
			<td>
				<input class="button-primary" type="submit" id="button" value="<?php jbr_the_translate('Save'); ?>">
			</td>
		</tr>
	</table>
	<br/>
	<a href="admin.php?page=jbr-all-banners"><?php jbr_the_translate('Back'); ?></a>
</form>