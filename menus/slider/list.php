<?php global $JBR_PLUGIN; ?>

<link href="<?php echo $JBR_PLUGIN['url']; ?>css/banner-rotativo.css" rel="stylesheet" />
<h1><?php jbr_the_translate('Sliders'); ?> <a href="admin.php?page=jbr-new-slider" class="adicionar-novo"><?php jbr_the_translate('New'); ?></a></h1>
<table class="wp-list-table widefat fixed banners">
	<thead>
		<th>ID</th>
		<th><?php jbr_the_translate('Slider'); ?></th>
		<th><?php jbr_the_translate('Actions'); ?></th>
	</thead>
	<tbody>
        <?php if (count($sliders)) : ?>
			<?php foreach ($sliders as $slider) : ?>
				<tr>
					<td><?= $slider->id ?></td>
					<td class="coluna-data"><?= $slider->nome ?></td>
					<td class="crud">
						<a href="admin.php?page=jbr-new-slider&id=<?= $slider->id ?>" onclick=""><?php jbr_the_translate('Edit'); ?></a> -
						<a href="admin.php?page=jbr-all-sliders&delete=<?= $slider->id ?>&h=<?= jbr_hash_value($slider->id); ?>"
							onclick="if(!confirm('<?php jbr_the_translate('Are you sure you want to delete this slider?'); ?>')) return false;">
							<?php jbr_the_translate('Delete'); ?>
						</a>
					</td>
				</tr>
			<?php endforeach; ?>
		<?php else : ?>
			<tr>
				<td><?php jbr_the_translate('No slider saved'); ?></td>
			</tr>
		<?php endif; ?>
	</tbody>
</table>