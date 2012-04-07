<div id="header">
	<h1>
		<?php echo link_to( 
			__('Retour au site'),
			$website_url
		); ?>
	</h1>	


	<?php if($sf_user->isAuthenticated()): ?>
		<div id="logout">
			<?php echo link_to('<button>'.__('Logout').'</button>', '@sf_guard_signout'); ?>
		</div>
	<?php endif; ?>
</div>
