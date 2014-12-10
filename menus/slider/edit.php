<form action="" method="post" style="width:450px;">
	<h2><?php jbr_the_translate('Edit Slider'); ?></h2>
	<table class="wp-list-table widefat fixed">
		<tr>
			<td>
				<label for="nome"><?php jbr_the_translate("Slider's name"); ?></label>
			</td>
			<td>
				<input type="hidden" name="id" value="<?= $slider->id ?>" />
				<input type="hidden" name="hash_id" value="<?= jbr_hash_value($slider->id) ?>" />
				<input type="hidden" name="action" value="update" />
				<input type="hidden" name="hash_action" value="<?= jbr_hash_value('update') ?>" />
				<input type="text" name="nome" id="nome" value="<?= $slider->nome ?>">
			</td>
		</tr>
		<tr>
			<td><?php jbr_the_translate("Slider's effect"); ?></td>
			<td>
				<select name="efeito">
					<option value="default"><?php jbr_the_translate('Select...'); ?></option>
					<option value="fade" <?php if($slider->efeito == 'fade') echo 'selected';?>>Fade</option>
					<option value="shuffle" <?php if($slider->efeito == 'shuffle') echo 'selected';?>>Shuffle</option>
					<option value="zoom" <?php if($slider->efeito == 'zoom') echo 'selected';?>>Zoom</option>
					<option value="turnDown" <?php if($slider->efeito == 'turnDown') echo 'selected';?>>Turn Down</option>
					<option value="curtainX" <?php if($slider->efeito == 'curtainX') echo 'selected';?>>Curtain X</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<input class="button-primary" type="submit" id="atualizar" value="<?php jbr_the_translate('Update'); ?>">
			</td>
		</tr>
	</table>
	<br>
	<a href="admin.php?page=jbr-all-sliders"><?php jbr_the_translate('Back'); ?></a>

</form>