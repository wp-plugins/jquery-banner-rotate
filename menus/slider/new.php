<form action="" method="post" style="width:450px;">
	<h2><?php jbr_the_translate('New Slider'); ?></h2>
	<table class="wp-list-table widefat fixed">
		<tr>
			<td>
				<label for="nome"><?php jbr_the_translate("Slider's name"); ?></label>
			</td>
			<td>
				<input type="text" name="nome" id="nome">
			</td>
		</tr>
		<tr>
			<td><?php jbr_the_translate("Slider's effect"); ?></td>
			<td>
				<select name="efeito">
					<option value="default"><?php jbr_the_translate('Select...'); ?></option>
					<option value="fade">Fade</option>
					<option value="shuffle">Shuffle</option>
					<option value="zoom">Zoom</option>
					<option value="turnDown">Turn Down</option>
					<option value="curtainX">Curtain X</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<input class="button-primary" type="submit" id="Salvar" value="<?php jbr_the_translate('Save'); ?>">
			</td>
		</tr>
	</table>
	<br>
	<a href="admin.php?page=jbr-all-sliders"><?php jbr_the_translate('Back'); ?></a>
</form>