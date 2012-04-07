		</div>
  </div>

	<footer>
		<p><?php echo __("Auteur : Simon Vieille - Hébergement personnel - Textes libres sauf indication(s) contraire(s)"); ?></p>
		<p><a id="auth_open" data-controls-modal="modal-auth" data-backdrop="true" data-keyboard="true" href="<?php echo url_for('@auth'); ?>"><?php echo __('Connexion'); ?></a></p>
	</footer>
</div>

<div id="loading" class="alert-message warning"><?php echo __('Chargement en cours'); ?></div>

<?php $form = new sfGuardFormSignin(); ?>
<div id="modal-auth" class="modal hide fade">
	<form enctype="multipart/form-data" action="https://<?php echo $_SERVER['SERVER_NAME'], url_for('@auth') ?>" method="post">
		<div class="modal-header">
			<a href="#" class="close">&times;</a>
			<h3><?php echo __('Connexion'); ?></h3>
		</div>
		<div class="modal-body">
			<div><?php echo $form->renderHiddenFields() ?></div>
			<div class="form">
				<table>
					<?php foreach($form as $key => $input): ?>
						<?php if(!$input->isHidden()): ?>
							<tr>
								<th width="170"><?php echo __($input->renderLabel()); ?></th>
								<td>
									<?php echo $input->render(); ?>
								</td>
							</tr>
						<?php endif; ?>
					<?php endforeach; ?>					
				</table>
			</div>
		</div>
		<div class="modal-footer">
			<input type="submit" class="btn primary" value="<?php echo __('Connexion'); ?>" />
			<a href="#auth_close" id="auth_close" class="btn secondary"><?php echo __('Annuler'); ?></a>
		</div>
	</form>
</div>

<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-28495879-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
