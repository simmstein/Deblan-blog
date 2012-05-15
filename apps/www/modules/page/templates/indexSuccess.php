<?php foreach($pager as $page): ?>
	<?php include_component('page', 'showPost', array('post' => $page)); ?>	
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
window.currentPage = 1;
$(document).ready(function() {
	infinityScroll('<?php echo url_for('@homepage_page?page=-page-'); ?>');
});
</script> */ ?>
