	</div>
</div>
<div class="span4" id="sidebar">
	<div id="side-categories">
		<ul>
			<?php foreach($categories as $k => $category): ?>
				<li class="<?php echo $k > 5 ? 'hidden more-categories-list' : ''; ?> <?php echo $category->getIsCurrentCategory() ? 'active' : ''; ?>">
					<a class="hash" href="<?php echo url_for('@category?id='.$category->getId().'&slugy_path='.$category->getSlugyPath()); ?>">
						<?php echo __($category->getName()); ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
		<p id="more-categories"><?php echo __('En afficher plus'); ?></p>
	</div>

	<div class="no-padding">
		<h4><?php echo __('Vidéo à la une'); ?></h4>
		<div id="lecteur_27111"></div>	
		<script type="text/javascript" src="http://www.supportduweb.com/page/js/flashobject.js"></script>
    <script type="text/javascript">
			var flashvars_27111 = {};
			var params_27111 = {
				quality: "high",
				bgcolor: "#000000",
				allowScriptAccess: "always",
				allowFullScreen: "true",
				wmode: "transparent",	
				flashvars: "fichier=<?php echo urlencode("http://http5.senat.yacast.net/senat/VOD/commission/2012/AC20120111-07-gadaix.flv"); ?>&apercu=<?php echo urlencode('http://media.senat.fr/VOD/commission/2012/AC20120111-07-gadaix.jpg'); ?>"
			};
			
			var attributes_27111 = {};
      flashObject("http://flash.supportduweb.com/lecteur_flv/v1_27.swf", "lecteur_27111", "218", "126", "8", false, flashvars_27111, params_27111, attributes_27111);
    //-->
    </script>
	</div>

	<h4><?php echo __('Derniers avis'); ?></h4>
	<div id="side-comments">
		<?php foreach($comments as $comment): ?>
			<p>
				<a rel="popover-left" 
					data-original-title="<?php echo __('Le').' '.date_format(new DateTime($comment->getCreatedAt()), 'd/m/Y').' '.__('à').' '.date_format(new DateTime($comment->getCreatedAt()), 'H:i');
?>" 
					data-content="<?php echo html(__('Dans').' « '.$comment->getPost()->getTitle().' »'); ?>" 
				href="<?php echo url_for('@post?id='.$comment->getPost()->getId().'&slugy_path='.$comment->getPost()->getSlugyPath()); ?>#c<?php echo $comment->getId(); ?>">
					<img src="<?php echo $comment->getGravatar(); ?>" alt="<?php echo html($comment->getAuthor()); ?>" title="<?php echo html($comment->getAuthor()); ?>" />
					<span class="side-comment-author"><?php echo html($comment->getAuthor()); ?></span>
					<span class="side-comment-excerpt"><?php echo html(truncate_text($comment->getContent(), 25, '…', true)); ?></span>
				</a>
			</p>
		<?php endforeach; ?>
	</div>
	
	<div id="side-links-bloc">
		<h4><?php echo __('À voir'); ?></h4>
		<div id="side-links">
			<ul>
				<?php foreach($links as $k => $link): ?>
					<li>
						<a 
						<?php if($link->getDescription()): ?>
							rel="popover-left" data-original-title="<?php echo html($link->getName()); ?>" data-content="<?php echo html($link->getDescription()); ?>"
						<?php endif; ?>

						href="<?php echo html($link->getUrl()); ?>">
							<?php echo $link->getName(); ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
			<div class="clear"></div>
		</div>
	</div>
</div>
