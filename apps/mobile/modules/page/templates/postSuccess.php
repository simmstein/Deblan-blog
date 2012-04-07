<?php use_helper('Post'); ?>

<?php if(!empty($sent)): ?>
	<div class="alert-message success">
		<a href="<?php echo url_for('@homepage'); ?>" class="close">×</a>
		<p><strong><?php echo __('Envoyé !'); ?></strong> <?php echo __("Votre commentaire a bien été pris en compte :)"); ?></p>
	</div>
<?php endif; ?>

<?php include_component('page', 'showPost', array('post' => $post)); ?>

<div id="comments"></div>

<?php foreach($post->getSortedComments() as $comment): ?>
	<?php include_component('page', 'showComment', array('level' => 1, 'comment' => $comment)); ?>
<?php endforeach; ?>

<hr class="clear" />

<h3>Ajouter un commentaire</h3>

<form enctype="multipart/form-data" action="<?php echo $_SERVER['REQUEST_URI']; ?>#comment_form" id="comment_form" method="post">
	<div><?php echo $form->renderHiddenFields() ?></div>
	<div class="form">
		<table>
			<?php foreach($form as $key => $input): ?>
				<?php if(!$input->isHidden() && $key != 'remember'): ?>
					<tr>
						<th><?php echo __($input->renderLabel()); ?></th>
						<td>
							<?php echo $input->renderError(); ?>


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
				<td>
						<p>
							<input type="submit" class="btn primary" value="<?php echo __('Envoyer'); ?>" />
							<input type="reset" class="btn" value="<?php echo __('Annuler'); ?>" />
						</p>
				</td>
			</tr>
			<tr>
				<td></td>
				<td><p><?php echo __("Les insultes, le racisme et tout ce qui est interdit par la loi française sera supprimé."); ?></p></td>
			</tr>
		</table>
	</div>
</form>

