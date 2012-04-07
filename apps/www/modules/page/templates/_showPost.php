<?php use_helper('Post'); ?>

<?php if(!empty($post)): ?>
	<div class="article-header">
		<h2>
			<?php echo image_tag(
				'/images/blank.gif', 
				array(
					'alt' => $post->getTitle(),
					'title' => $post->getTitle(),
					'width' => 17,
					'height' => 17,
					'style' => 'background:url(\''.$post->getPicture().'\') center center'
				)
			); ?>
			
			<?php echo link_to(
				$post->getTitle(), 
				'@post?id='.$post->getId().'&slugy_path='.$post->getSlugyPath(),
				array(
					'class' => 'hash'
				)
			); ?>
		</h2>

		<p class="author">
			<strong class="article-header-arrow">→</strong> Par 
				<a href="<?php echo url_for('@profile?username='.$post->getSfGuardUser()->getUsername()); ?>">
					<?php echo $post->getSfGuardUser()->getUsername(); ?>
				</a>, 
			
				<?php echo __('Le'); ?> 
				<?php echo date_format(new DateTime($post->getPublishedAt()), 'd/m/Y'); ?>
				<?php echo __('à'); ?>
				<?php echo date_format(new DateTime($post->getPublishedAt()), 'H:i'); ?>
		</p>
		
		<ul class="tags">
			<?php foreach($post->getCategories() as $category): ?>
				<li class="category"><a class="hash" href="<?php echo url_for('@category?id='.$category->getId().'&slugy_path='.$category->getSlugyPath()); ?>"><?php echo $category->getName(); ?></a></li>
			<?php endforeach; ?>
			<?php foreach($post->getTagsAsArray() as $tags): ?>	
				<li><a href="<?php echo url_for('@tag?page=1&tag='.$tags); ?>" class="hash"><?php echo $tags; ?></a></li>
			<?php endforeach; ?>
		</ul>

		<div class="clear"></div>
		<p class="total-comments"><a
		rel="popover-right"	
		data-original-title="<?php echo __('Réaction'), ($post->getCountComments() > 0 ? 's' : ''); ?>"
		data-content="<?php
			if(!$post->getCountComments()) {
				echo __("Aucun commentaire n'a été posté, soyez le premier !");
			}
			else {
				if($post->getCountComments() == 1) {
					echo __("Un seul commentaire a été posté.");
				}
				else {
					echo $post->getCountComments(), __(" commentaires ont été postés pour cet article.");
				}
			}
		?>"
		href="<?php echo url_for('@post?id='.$post->getId().'&slugy_path='.$post->getSlugyPath()); ?>#comments"><?php echo $post->getCountComments(); ?></a></p>
	</div>

	<div class="article-body">
		<?php echo parse_texte(utf8_decode($post->getContent())); ?>	
	</div>

	<?php if(false && sfContext::getInstance()->getActionName() != 'post' && $post->getHasMore()): ?>
			<?php echo link_to(
				'<button class="page-button">'.__("Lire l'article complet").'</button>', 
				'@post?id='.$post->getId().'&slugy_path='.$post->getSlugyPath(),
				array(
					'class' => 'hash'
				)
			); ?>		
	<?php endif; ?>
<?php endif; ?>
