<?php foreach($pager as $page): ?>
	<?php include_component('page', 'showPost', array('post' => $page)); ?>	
<?php endforeach; ?>

<?php 
	include_partial(
		'page/pager', 
		array(
			'pager' => $pager, 
			'route' => '@category?slugy_path='.$category->getSlugyPath().'&id='.$category->getId(),
			'current_page' => $current_page,
			'next_page' => $next_page
		)
	);
?>

<?php /*<script type="text/javascript">
$(document).ready(function() {
	infinityScroll('<?php echo url_for('@category?id='.sfContext::getInstance()->getRequest()->getParameter('page').'&page=-page-'); ?>');
});
</script> */ ?>
