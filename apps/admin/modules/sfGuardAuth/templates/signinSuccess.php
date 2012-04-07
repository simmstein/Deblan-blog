<div id="login">
	<h2>Espace réservé</h2>
	<form action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
		<table>
			<?php echo $form ?>
		</table>

		<div id="login_submit"><input type="submit" value="sign in" /></div>
	</form>
</div>
