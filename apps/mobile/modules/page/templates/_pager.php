<?php if($pager): ?>
	<?php if(0 < $current_page-1): ?>
		<?php 
			echo link_to(
				'<button class="pager-button flleft">'.__('Précédent').'</button>', 
				$route.'&page='.($current_page-1)
			);
		?>
	<?php endif; ?>

	<?php if($next_page != $current_page): ?>
		<?php 
			echo link_to(
				'<button class="pager-button flright">'.__('Suivant').'</button>', 
				$route.'&page='.($current_page+1)
			);
		?>
	<?php endif; ?>
<?php endif; ?>
