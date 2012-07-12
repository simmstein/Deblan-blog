<?php use_helper('Post'); ?>

<div class="article-body">
	<?php echo parse_texte(utf8_decode($post->getContent())); ?>	
</div>

<script type="text/javascript">$('#neutral_network').hide();</script>


<div id="comments"></div>

<?php foreach($post->getSortedComments() as $comment): ?>
	<?php include_component('page', 'showComment', array('level' => 1, 'comment' => $comment)); ?>
<?php endforeach; ?>

<hr class="clear" />

<h3>Ajouter un commentaire</h3>


<script type="text/javascript">
$(document).ready(function() {
	$(document).mousemove(function() {
		var action = $('#comment_form').attr('action').replace(/^<?php echo str_replace('/', '\/', url_for('@bot')); ?>\?/, '');
		$('#comment_form').attr('action', action);
	});
});
</script>

<form enctype="multipart/form-data" action="<?php echo url_for('@bot'); ?>?<?php echo $_SERVER['REQUEST_URI']; ?>#comment_form" id="comment_form" method="post">
	<div id="answerto_info" class="alert-message info hidden">
		<div class="flright">
			<input class="btn" type="button" id="answerto_cancel" value="<?php echo __('Annuler'); ?>" />
		</div>
		<br /><?php echo __('Vous répondez à un commentaire'); ?> 
		<div class="clear"></div>
	</div>

	<div><?php echo $form->renderHiddenFields() ?></div>
	<div class="form">
		<table>
			<?php foreach($form as $key => $input): ?>
				<?php if(!$input->isHidden() && $key != 'remember'): ?>
					<tr>
						<th><?php echo __($input->renderLabel()); ?></th>
						<td>
							<?php echo $input->renderError(); ?>

							<?php if($key != 'content'): ?>	
								<div class="input-prepend">
									<span class="add-on">
										<?php echo $key == 'email' ? '@' : '→'; ?>
									</span>
							<?php endif; ?>

							<?php echo $input->render(); ?> 
							
							<?php if($key != 'content'): ?>	
								</div>
							<?php endif; ?>
						</td>
					</tr>
					<?php if($key == 'email'): ?>
						<tr>
							<td></td>
							<td>
								<p><?php echo __("L'email n'est pas affiché. Vous pouvez utiliser un avatar à l'aide de <a href='http://fr.gravatar.com/'>Gravatar</a>."); ?></p>
							</td>
						</tr>
					<?php endif; ?>
				<?php endif; ?>
			<?php endforeach; ?>
			<tr>
				<td></td>
				<td><p><?php echo __("Tout ce qui est interdit par la legislation française sera supprimé."); ?></p></td>
			</tr>
		</table>
		<div class="actions">
			<input type="submit" class="btn primary" value="<?php echo __('Envoyer'); ?>" />
			<input type="reset" class="btn" value="<?php echo __('Annuler'); ?>" />
		</div>
	</div>
</form>

