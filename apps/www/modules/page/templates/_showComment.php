<?php if($comment): if(($comment->hasParent() && $level > 1) || !$comment->hasParent()):  ?>
	<div class="clear"></div>

	<div class="comment" style="padding-left:<?php echo ($level-1)*30; ?>px">
		<article id="c<?php echo $comment->getId(); ?>">
			<header>
				<div class="comment_author">
					<strong>
						<?php if(trim($comment->getWebsite()) != ''): ?>
							<a href="<?php echo html($comment->getWebsite()); ?>" rel="no-follow">
								<?php echo html($comment->getAuthor()); ?>
							</a>
						<?php else: ?>
							<?php echo html($comment->getAuthor()); ?>
						<?php endif; ?>
					</strong>, 
					<?php echo __('Le'); ?> 
					<?php echo date_format(new DateTime($comment->getCreatedAt()), 'd/m/Y'); ?>
					<?php echo __('à'); ?>
					<?php echo date_format(new DateTime($comment->getCreatedAt()), 'H:i'); ?>

					<a href="#c<?php echo $comment->getId(); ?>">#</a>
				</div>
				
				<div class="avatar">
					<a title="<?php echo html($comment->getAuthor()); ?>" href="<?php echo $comment->getGravatar(); ?>">
						<img title="<?php echo html($comment->getAuthor()); ?>" alt="<?php echo html($comment->getAuthor()); ?>" src="<?php echo $comment->getGravatar(); ?>">
					</a>	
				</div>    
			</header>
	
			<div class="comment_content">
				<?php echo parse_commentaire($comment->getContent()); ?>	

				<p><a rel="<?php echo $comment->getId(); ?>" class="answerto" href="#comment_form"><?php echo __("Répondre à ce message"); ?></a></p>
			</div>
		</article>
	</div>

	<?php if($comment->hasChildren()): ?>
		<?php foreach($comment->getChildren() as $commentC): ?>
			<?php include_component('page', 'showComment', array('foo', 'level' => ($level+1), 'comment' => $commentC)); ?>
		<?php endforeach; ?>
	<?php endif; ?>
<?php endif; endif; ?>
