<?php if(!empty($sent)): ?>
	<div class="alert-message success">
		<a href="<?php echo url_for('@homepage'); ?>" class="close">×</a>
		<p><strong><?php echo __('Enregistré !'); ?></strong> <?php echo __("Votre compte a bien été modifié :)"); ?></p>
	</div>
<?php endif; ?>


<form enctype="multipart/form-data" action="<?php echo url_for('@account'); ?>" method="post">
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
			<p>
				<input type="submit" class="btn primary" value="<?php echo __('Enregistrer'); ?>" />
				<input type="reset" class="btn" value="<?php echo __('Annuler'); ?>" />
			</p>
		</div>
	</div>
</form>
