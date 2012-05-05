<?php if($pager): ?>
	<div class="actions pagination">
		<?php if(0 < $current_page-1): ?>
			<div class="flleft">
				<?php 
					echo link_to(
						'<button class="btn">← '.__('Précédent').'</button>', 
						$route.'&page='.($current_page-1)
					);
				?>
			</div>
		<?php endif; ?>

		<?php if($next_page != $current_page): ?>
			<div class="flright">
				<?php 
					echo link_to(
						'<button class="btn">'.__('Suivant').' →</button>', 
						$route.'&page='.($current_page+1)
					);
				?>
			</div>
		<?php endif; ?>
	</div>
<?php endif; ?>
