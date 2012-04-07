<?php if(empty($user)): ?>

<?php else: ?>

<ul class="tabs" data-tabs="tabs">
	<li class="active"><a id="profile_a" href="#profile"><?php echo __('Profil'); ?></a></li>
	<li><a href="#description" id="bio_a"><?php echo __('Bio'); ?></a></li>
</ul>

<div class="pill-content tab-content">
	<div id="profile" class="tab-pane active">
		<h3><?php echo __('Généralités'); ?></h3>

		<div class="span5">
			<h4><?php echo html($user->getProfile()->getFirstname()); ?> <?php echo html($user->getProfile()->getLastname()); ?></h4>
			<p>
				<?php
					echo image_tag(
						'/'.$user->getProfile()->getAvatar(),
						array(
							'alt' => $user->getProfile()->getFirstname().' '.$user->getProfile()->getLastname(),
							'title' => $user->getProfile()->getFirstname().' '.$user->getProfile()->getLastname()
						)
					)
				?>
			</p>
		</div>


		<h3><?php echo __('Sur la toile…'); ?></h3>

		<ul class="profile_web">
			<?php foreach(array('Blog', 'Website', 'Twitter', 'Facebook', 'Linkedin') as $k => $link): $url = $user->getProfile()->{'get'.$link}(); ?>
				<?php if(!empty($url)): ?>
					<li class="profile_<?php echo strtolower($link); ?>">
						<strong><?php echo __($link); ?></strong> 
						<a href="<?php echo html($url) ?>"><?php echo truncate_text(html($url), 50); ?></a>
					</li>
				<?php endif; ?>
			<?php endforeach; ?>
		</ul>

	</div>

	<div id="description" class="tab-pane">
		<?php if($user->getProfile()->getDescription()): ?>
			<?php echo $user->getProfile()->getDescription(); ?>
		<?php else: ?>
			<p><?php echo __('Aucune bio pour le moment :)'); ?></p>
		<?php endif; ?>
	</div>
</div>


<?php endif; ?>
