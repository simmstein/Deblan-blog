<div id="sf_admin_container">
	<h1><?php echo __('Vider le cache'); ?></h1>

	<fieldset>
		<p><?php echo __('Vous vous apprêtez à vider le cache complet du site. Cette action peut prendre quelques secondes et impliquent quelques ralentissements dans les prochains affichages des pages web.'); ?></p>
		
		<p>
			<button id="clearcache_button"><?php echo __('Vider le cache'); ?></button>
			<div id="return"></div>
		</p>

		<script type="text/javascript">
			(function($) {
				$(window).ready(function() {
					$('#clearcache_button').click(function() {
						$(this).attr('disabled', 'disabled');
						$(this).html($(this).html()+' / <?php echo __('Veuillez patienter'); ?>');
						$('#return').load('/admin.php/clearcache/clearcache', function() {
							$('#clearcache_button').attr('disabled', '');
							$('#clearcache_button').html('<?php echo __('Vider le cache'); ?>');
						});
					});
				});
			})(jQuery);
		</script>
	</fieldset>
</div>
