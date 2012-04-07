<?php foreach($pager as $page): ?>
	<?php include_component('page', 'showPost', array('post' => $page)); ?>	
	<div class="page" rel="<?php echo $pager->getPage(); ?>"></div>
<?php endforeach; ?>

<?php 
	include_partial(
		'page/pager', 
		array(
			'pager' => $pager, 
			'route' => '@homepage_page?',
			'current_page' => $current_page,
			'next_page' => $next_page
		)
	);
?>

<?php /*<script type="text/javascript">
$(document).ready(function() {
	infinityScroll('<?php echo url_for('@homepage?page=-page-'); ?>');
});
</script> */ ?>
