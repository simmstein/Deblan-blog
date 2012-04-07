<div id="similar">
	<h3><?php echo __('Vous aimerez sans doute :'); ?></h3>

	<ul>
		<?php foreach($posts as $k => $post): ?>
			<li class="similar">
				<a href="<?php echo url_for('@post?id='.$post->getId().'&slugy_path='.$post->getSlugyPath()); ?>"><?php echo $post->getTitle(); ?></a>
			</li>
		<?php endforeach; ?>
	</ul>
</div>
