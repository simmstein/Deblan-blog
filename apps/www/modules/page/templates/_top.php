<div class="topbar">
	<div class="fill">
		<div class="container">
			<a class="brand" href="<?php echo url_for('@homepage'); ?>"><img src="http://blog.deblan.fr/favicon.ico" alt="" title="" /></a>
			<ul class="nav">
				<li class="<?php echo ($_SERVER['REQUEST_URI'] == url_for('@homepage'))?'active':''; ?>"><a class="hash toplink" href="<?php echo url_for('@homepage'); ?>"><?php echo __('Accueil'); ?></a></li>
				<li><a rel="popover-below" data-original-title="<?php echo __('Serveur IRC'); ?>" data-content="<?php echo html(__("Rejoignez le serveur IRC de la communauté Deblan")); ?>" href="http://irc.deblan.fr/"><?php echo __('Discussion'); ?></a></li>
				<li class="<?php echo ($_SERVER['REQUEST_URI'] == url_for('@contact'))?'active':''; ?>"><a href="<?php echo url_for('@contact'); ?>" class="hash toplink"><?php echo __('Contact'); ?></a></li>

				<?php if($sf_user->isAuthenticated()): ?>
					<li class="dropdown" data-dropdown="dropdown" >
						<a href="#" class="dropdown-toggle"><?php echo __('Mon compte'); ?></a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo url_for('@profile?username='.$sf_user->getUsername()); ?>"><?php echo __('Voir mon profil'); ?></a></li>
							<li><a href="<?php echo url_for('@account'); ?>"><?php echo __('Mes informations'); ?></a></li>
							<?php if($sf_user->hasPermission(array('Administrer', 'Rédaction'))): ?>
								<li class="divider"></li>
								<li><a href="/admin.php"><?php echo __('Administration'); ?></a></li>
							<?php endif; ?>
							<li class="divider"></li>
							<li><a href="<?php echo url_for('@auth?logout=1'); ?>"><?php echo __('Déconnexion'); ?></a></li>
						</ul>
					</li>
				<?php endif; ?>
			</ul>
			<form action="<?php echo url_for('@search'); ?>" class="pull-right">
				<input class="input-small" type="text" <?php echo !empty($query) ? 'value="'.html($query).'"' : ''; ?> name="query" placeholder="<?php echo __('Mot clé'); ?>">
				<button class="btn" type="submit"><?php echo __('Chercher'); ?></button>
			</form>
		</div>
	</div>
</div>
<div class="container">
	<div class="content" id="top">
		<div class="page-header">
			<h1><?php echo sfContext::getInstance()->getResponse()->getTitle(); ?></h1>

			<div id="identity">
				<div id="picture" class="flleft clearfix">
					<div id="webcam">
						<a href="#" rel="popover-below" data-original-title="Webcam en live" data-content="<?php echo htmlentities('<img src="http://webcam.deblan.org/ressources/webcam.jpg?'.time().'" alt="" title="" width="250" />'); ?>" ><img src="/images/webcam.png" alt="Webcam en live" title="Webcam en live" /></a>
					</div>
					<img src="/images/picture.jpg" alt="Simon Vieille" title="Simon Vieille" />
				</div>
				<div id="information">
					<h2>Simon Vieille</h2>
					<p>Montbéliard, France</p>
					<div id="bio">
						<p><?php echo __('Développeur logiciel et administrateur système à <em>web&amp;design</em>. auditeur au CNAM (Belfort)'); ?></p>
					</div>
					<div id="follow">
						<ul>
							<li>
								<a 
									href="<?php echo url_for('@rss'); ?>"
									data-original-title="RSS" class="apopover" rel="popover-below" 
									data-content="<?php echo html(__("Alimentez votre actualité en me suivant via le flux RSS du blog")); ?>" 									
								>
									<img src="/images/top/feed.png" alt="RSS" title="RSS" />
									<span>Flux RSS</span>
								</a>
							</li>
							<li>
								<a 
									href="https://twitter.com/SimonVieille"
									data-original-title="Twitter" class="apopover" rel="popover-below" 
									data-content="<?php echo html(__("Suivez-moi sur le service de microblogging Twitter, @SimonVieille")); ?>" 
								><img src="/images/top/twitter.png" alt="Twitter" title="Twitter" /> <span>@SimonVieille</span></a>
							</li>

							<li>
								<a 
									href="https://www.facebook.com/simon.vieille"
									data-original-title="Facebook" class="apopover" rel="popover-below" 
									data-content="<?php echo html(__("Rejoignez mon réseau FaceBook")); ?>"
								>
									<img src="/images/top/facebook.png" alt="Facebook" title="Facebook" /> <span><?php echo __('Profil'); ?> Facebook</span></a>
								</li>
							<li>
								<a 
									href="http://www.linkedin.com/profile/view?id=68981845&amp;trk=tab_pro"
									data-original-title="Linkedin" class="apopover" rel="popover-below"
									data-content="<?php echo html(__("Rejoignez mon réseau Linkedin")); ?>"
								>
								<img src="/images/top/linkedin.png" alt="Linkedin" title="Linkedin" /> <span><?php echo __('Profil'); ?> Linkedin</span></a>
							</li>
							<li>
								<a href="http://flattr.com/thing/640789/Deblan" target="_blank">
									<img src="http://api.flattr.com/button/flattr-badge-large.png" alt="Flattr this" title="Flattr this" border="0" />
								</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>

		<?php /*<div id="bg-link-container"></div>
		<script type="text/javascript">
			$('#bg-link-container').append('<a href="http://www.temoignages.re/manifestations-etudiantes-au-quebec-adoption-de-la-loi-78-indigne-d-une-democratie,56355.html"></a>');
		</script>*/ ?>

		<div class="row">
			<div class="span12" id="content">
				<div>
					<div class="alert-message warning">
						<img src="https://ssl.neutralnetwork.org/favicon.ico" alt="Neutral Nework" title="Neutral Nework" />
						Découvrez le réseau IRC <strong>libre</strong> et <strong>sécurisé</strong> de Deblan et Grenadine : <a href="https://ssl.neutralnetwork.org/"> <strong>Neutral Nework</strong></a>
					</div>
