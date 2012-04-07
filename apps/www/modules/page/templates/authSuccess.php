<?php if(!empty($failed)): ?>
<div class="alert-message error">
	<p><strong><?php echo __('Oops !'); ?></strong> <?php echo __("Le nom d'utilisateur ou le mot de passe est invalide…"); ?></p>
</div>
<?php endif; ?>

<form enctype="multipart/form-data" action="<?php echo url_for('@auth') ?>" method="post">
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
			<tr>
				<td></td>
				<td>
						<p>
							<input type="submit" class="btn primary" value="<?php echo __('Connexion'); ?>" />
							<input type="reset" class="btn" value="<?php echo __('Annuler'); ?>" />
						</p>
				</td>
			</tr>
		</table>
	</div>
</form>
