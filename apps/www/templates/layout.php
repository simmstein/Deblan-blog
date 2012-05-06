<?php //ob_start(); ?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
		<link rel="stylesheet" href="http://lokeshdhakar.com/projects/lightbox2/css/lightbox.css" />
		<?php include_javascripts(); ?>
		<script type="text/javascript" src="http://lokeshdhakar.com/projects/lightbox2/js/lightbox.js"></script>
    <?php //include_compressed_stylesheets() ?>
  </head>
  <body>
		<?php include_component('page', 'top'); ?>
    <?php echo $sf_content ?>
		<?php include_component('page', 'side'); ?>
		<?php include_partial('page/footer'); ?>
		<script type="text/javascript">window.home = "<?php echo url_for('@homepage'); ?>";</script>
		<link href="http://vjs.zencdn.net/c/video-js.css" rel="stylesheet">
		<script src="http://vjs.zencdn.net/c/video.js"></script>		
    <?php //include_compressed_javascripts() ?>
  </body>
</html>
<?php 
/*
$html = ob_get_contents();
ob_end_clean();

$lines = explode("\n", $html);

foreach($lines as $k => $l) {
	$l = trim($l);

	if(empty($l)) {
		unset($lines[$k]);
	}
	else {
		$lines[$k] = $l;
	}
}

echo implode("\n", $lines);
*/

