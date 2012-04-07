<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
		<link href="http://code.jquery.com/mobile/latest/jquery.mobile.min.css" rel="stylesheet" type="text/css" />
		<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
		<script src="http://code.jquery.com/mobile/latest/jquery.mobile.min.js"></script>		
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
		<div data-role="page">
			<div data-role="header">
				<?php //include_component('page', 'top'); ?>
			</div>
			<div data-role="content">
			 <?php echo $sf_content ?>
			</div>
		</div>
  </body>
</html>
