<?php if(!empty($sent)): ?>
<div class="alert-message success">
	<a href="<?php echo url_for('@homepage'); ?>" class="close">×</a>
	<p><strong><?php echo __('Envoyé !'); ?></strong> <?php echo __("Votre message a été envoyé et j'espère y répondre le plus rapidement possible :)"); ?></p>
</div>
<?php else: ?>
<p>
	<?php echo __("Vous pouvez me contacter directement par courriel à ces deux adresses :"); ?><br />
	<ul>
		<li><img alt="" src="http://www.deblan.fr/index.php?module=mail&amp;type=public&amp;user=simon&amp;domain=deblan.fr"></li>
		<li><img alt="" src="http://www.deblan.fr/index.php?module=mail&amp;type=public&amp;user=simon.vieille&amp;domain=free.fr"></li>
	</ul>
</p>

<p><?php echo __("Je suis régulièrement connecté sur mon serveur IRC. Pour plus d'informations, consultez <a href='http://irc.deblan.fr/'>irc.deblan.fr</a>."); ?></p>

<div class="alert-message warning">
	<?php echo __("Les messages de publicité ou d'échanges de liens pour le référencement seront systématiquement ignorés !"); ?>
</div>

<script type="text/javascript">
$(document).ready(function() {
	$(document).mousemove(function() {
		var action = $('#contact_form').attr('action').replace(/^<?php echo str_replace('/', '\/', url_for('@bot')); ?>\?/, '');
		$('#contact_form').attr('action', action);
	});
});
</script>

<form enctype="multipart/form-data" action="<?php echo url_for('@bot'); ?>?<?php echo url_for('@contact') ?>" id="contact_form" method="post">
	<div><?php echo $form->renderHiddenFields() ?></div>
	<div class="form">
		<table>
			<?php foreach($form as $key => $input): ?>
				<?php if(!$input->isHidden()): ?>
					<tr>
						<th><?php echo __($input->renderLabel()); ?></th>
						<td>
							<?php echo $input->renderError(); ?>
							<?php echo $input->render(); ?>
						</td>
					</tr>
				<?php endif; ?>
			<?php endforeach; ?>
		</table>
		<div class="actions">
			<input type="submit" class="btn primary" value="<?php echo __('Envoyer'); ?>" />
			<input type="reset" class="btn" value="<?php echo __('Annuler'); ?>" />
		</div>
	</div>
</form>
<?php endif; ?>
