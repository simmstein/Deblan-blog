<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<?php include_http_metas() ?>
	<?php include_metas() ?>
	<?php include_title() ?>
	<link rel="shortcut icon" href="/favicon.ico" />
	<?php include_stylesheets() ?>
	<script type="text/javascript">window.home = "<?php echo url_for('@homepage'); ?>";</script>
	<link rel="image_src" href="<?php echo html($post->getPicture()); ?>" />
	<?php include_javascripts() ?>
	<script type="text/javascript">
		window.onload = function() {
			document.location.href = '<?php echo url_for('@post?id='.$post->getId().'&slugy_path='.$post->getSlugyPath()); ?>';
		}
	</script>
	<style type="text/css">
	body { margin:10px; padding: 10px; border:1px solid #ccc; font-family:Verdana; }
	h1, p { margin:0; padding:5px; }
	</style>
</head>
<body>
	<h1><?php echo html($post->getTitle()); ?></h1>
	<?php echo parse_texte(utf8_decode($post->getContent())); ?>
</body>
</html>
