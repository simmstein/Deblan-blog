<ul data-split-theme="d" data-split-icon="gear" data-role="listview" class="ui-listview">
	<?php foreach($pager as $page): ?>
		<li>
			<a href="<?php echo url_for('@post?id='.$page->getId().'&slugy_path='.$page->getSlugyPath()); ?>">
				<img src="/images/blank.gif" style="background:url('<?php echo $page->getPicture(); ?>'); center center" height="80" width="90" />
				<h3><?php echo $page->getTitle(); ?></h3>
				<p><?php echo implode(', ', $page->getCategories()); ?></p>
			</a>
		</li>
	<?php endforeach; ?>
</ul>

<?php 
	/*include_partial(
		'page/pager', 
		array(
			'pager' => $pager, 
			'route' => '@homepage_page?',
			'current_page' => $current_page,
			'next_page' => $next_page
		)
	);*/
?>


