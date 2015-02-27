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
					<option value="none"><?php jbr_the_translate('Select...'); ?></option>
					<option value="fade" <?php if($slider->efeito == 'fade') echo 'selected'; ?>>Fade</option>
					<option value="fadeout" <?php if($slider->efeito == 'fadeout') echo 'selected'; ?>>Fade out</option>
					<option value="scrollHorz" <?php if($slider->efeito == 'scrollHorz') echo 'selected'; ?>>
						Scroll Horizontal
					</option>
					<option value="scrollVert" <?php if($slider->efeito == 'scrollVert') echo 'selected'; ?>>
						Scroll Vertical
					</option>
					<option value="flipHorz" <?php if($slider->efeito == 'flipHorz') echo 'selected'; ?>>
						Flip Horizontal
					</option>
					<option value="flipVert" <?php if($slider->efeito == 'flipVert') echo 'selected'; ?>>
						Flip Vertical
					</option>
					<option value="shuffle" <?php if($slider->efeito == 'shuffle') echo 'selected'; ?>>Shuffle</option>
					<option value="tileSlide-vert" <?php if($slider->efeito == 'tileSlide-vert') echo 'selected'; ?>>
						Tile Slide Vertical
					</option>
					<option value="tileSlide-horz" <?php if($slider->efeito == 'tileSlide-horz') echo 'selected'; ?>>
						Tile Slide Horizontal
					</option>
					<option value="tileBlind-vert" <?php if($slider->efeito == 'tileBlind-vert') echo 'selected'; ?>>
						Tile Blind Vertical
					</option>
					<option value="tileBlind-horz" <?php if($slider->efeito == 'tileBlind-horz') echo 'selected'; ?>>
						Tile Blind Horizontal
					</option>
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