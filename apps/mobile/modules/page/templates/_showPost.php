<?php use_helper('Post'); ?>

<?php if(!empty($post)): ?>
	<div class="ui-body ui-body-d">
		<h2>
			<?php echo link_to(
				$post->getTitle(), 
				'@post?id='.$post->getId().'&slugy_path='.$post->getSlugyPath(),
				array(
					'class' => 'hash'
				)
			); ?>
		</h2>

		<h3>
			<strong class="article-header-arrow">→</strong> Par 
				<a href="<?php echo url_for('@profile?username='.$post->getSfGuardUser()->getUsername()); ?>">
					<?php echo $post->getSfGuardUser()->getUsername(); ?>
				</a>, 
			
				<?php echo __('Le'); ?> 
				<?php echo date_format(new DateTime($post->getPublishedAt()), 'd/m/Y'); ?>
				<?php echo __('à'); ?>
				<?php echo date_format(new DateTime($post->getPublishedAt()), 'H:i'); ?>
		</h3>

		<div class="article-body">
			<?php echo parse_texte(utf8_decode($post->getContent())); ?>	
		</div>
<?php endif; ?>
