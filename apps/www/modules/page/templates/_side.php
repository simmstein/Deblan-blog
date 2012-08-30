	</div>
</div>
<div class="span4" id="sidebar">
	<div id="irc-links">
		<?php foreach(
			array(
				'title' => 'https://ssl.neutralnetwork.org/', 
				'general' => 'https://ssl.neutralnetwork.org/irc/?channels=%23general', 
				'linux' => 'https://ssl.neutralnetwork.org/irc/?channels=%23linux', 
				'hebergement' => 'https://ssl.neutralnetwork.org/irc/?channels=%23HarmonyHosting', 
				'bottom' => 'https://ssl.neutralnetwork.org/'
			) as $img => $link):
			echo sprintf(
				'<a href="%s"><img src="/images/irc/%s.png" alt="Rejoins la communauté sur IRC" title="Rejoins la communauté sur IRC" /></a><br />',
				$link, $img
			);
		endforeach; ?>
	</div>
	

	<div id="side-categories" class="side-block">
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

	<div class="no-padding side-block">
		<h4><?php echo __('Vidéo à la une'); ?></h4>

		<video poster="http://upload.deblan.fr/u/2012-08/502e2e46.png" data-setup="{}" width="218" height="174" controls="controls"class="video-js vjs-default-skin">
			<source src="http://dedi.geneweb.fr/~simon/videos/balance_minitel.ogv" type="video/ogg" />
			<a href="https://dedi.geneweb.fr/~simon/videos/balance_minitel.ogv">Téléchager la vidéo.</a>
		</video>

		<?php /*
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
		*/ ?>
	</div>

	<div class="side-block">
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
	</div>
	
	<div id="side-links-bloc" class="side-block">
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

	<script charset="utf-8" src="http://widgets.twimg.com/j/2/widget.js"></script>
	<script>
	new TWTR.Widget({
		version: 2,
		type: 'profile',
		rpp: 4,
		interval: 30000,
		width: 218,
		height: 300,
		theme: {
			shell: {
				background: '#eeeeee',
				color: '#999999'
			},
			tweets: {
				background: '#ffffff',
				color: '#4d4d4d',
				links: '#76a0c9'
			}
		},
		features: {
			scrollbar: false,
			loop: false,
			live: false,
			behavior: 'all'
		}
	}).render().setUser('SimonVieille').start();
	</script>	
</div>
