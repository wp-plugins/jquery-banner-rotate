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
					<option value="none"><?php jbr_the_translate('Select...'); ?></option>
					<option value="fade">Fade</option>
					<option value="fadeout">Fade out</option>
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