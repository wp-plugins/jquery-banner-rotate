<?php global $JBR_PLUGIN ?>

<link href="<?php echo $JBR_PLUGIN['url'] ?>css/banner-rotativo.css" rel="stylesheet" />
  <h1><?php jbr_the_translate('Banners'); ?> <a href="admin.php?page=jbr-new-banner" class="adicionar-novo"><?php jbr_the_translate('New'); ?></a></h1>
	<table class="wp-list-table widefat fixed banners">
    	<thead>
        	<th><?php jbr_the_translate('Image'); ?></th>
            <th><?php jbr_the_translate('Expiry date'); ?></th>
            <th><?php jbr_the_translate('Slider'); ?></th>
            <th><?php jbr_the_translate('Actions'); ?></th>
        </thead>
    	<tbody>
        	<?php $i = 1; ?>
        	<?php if (count($banners)) : ?>
				<?php foreach($banners as $banner) : ?>
					<?php $l = jbr_validate_date(date('Y-m-d'), $banner->data_retirada); ?>
					<?php $class = ($l == true)? "" : "class='alert-msg'"; ?>
						<tr>
							<td>
		                		<input name="id<?= $i ?>" type="hidden" value="<?= $banner->id ?>" />
								<img src="<?= $banner->link ?>" height="40" id="link<?= $i ?>" name="link<?= $i ?>" />
							</td>
							<td class="coluna-data">
								<label <?= $class ?> name="dataRetirada<?= $i ?>" id="dataRetirada<?= $i ?>">
									<?= ($banner->data_retirada != '')? jbr_date($banner->data_retirada) : '' ?>
								</label>
							</td>
		                    <td>
		                    	<?php if($banner->slider_id != 0) : ?>
									<?= $jbr_slider->find($banner->slider_id)->nome; ?>
								<?php endif; ?>
		                    </td>
							<td class="crud">
								<a href="admin.php?page=jbr-new-banner&id=<?= $banner->id ?>">Editar</a> -
								<a href="admin.php?page=jbr-all-banners&delete=<?= $banner->id ?>&h=<?= jbr_hash_value($banner->id); ?>"
									onclick="if(!confirm('<?php jbr_the_translate('Are you sure you want to delete this banner?'); ?>')) return false;">
									Excluir
								</a>
							</td>
							</tr>
					<?php $i++; ?>
				<?php endforeach; ?>
			<?php else : ?>
				<tr>
					<td colspan="4">Nenhuma imagem salva</td>
				</tr>
			<?php endif; ?>
  		</tbody>
	</table>
<script type="text/javascript" src="<?= $JBR_PLUGIN['url'] ?>js/banner-rotativo.js"></script>