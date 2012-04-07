<?php foreach($pager as $page): ?>
	<?php include_component('page', 'showPost', array('post' => $page)); ?>	
<?php endforeach; ?>

<?php if(!$has_resultats): ?>
	<div class="alert-message error"><?php echo __('Aucun résultat'); ?></div>
<?php else: ?>
	<?php 
		include_partial(
			'page/pager', 
			array(
				'pager' => $pager, 
				'route' => '@search?query='.$search,
				'current_page' => $current_page,
				'next_page' => $next_page
			)
		);
	?>
<?php endif; ?>
