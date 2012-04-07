<?php $domain = 'http://'. $_SERVER['SERVER_NAME'].'/'; ?>
<html>
<head>
<style>
body {
	padding:15px;
	background:url("<?php echo $domain; ?>images/body.gif");
}

#content {
	width:790px;
	margin:auto;
	border:1px solid #ccc;
	padding:15px;
	font-family:Calibri, Verdana;
	font-size:12px;
	background:#fff;
}
</style>
</head>
<body>

<div id="content">
	<h1><?php echo __('Nouveau message !'); ?></h1>

	<h2><?php echo __('Sujet : '); ?> <?php echo $subject; ?></h2>

	<table width="100%">
		<?php foreach($datas as $k => $v):
			if(in_array($k, array('_csrf_token'))) continue;
		?>
			<tr>
				<td width="100"><?php echo __(ucfirst($k)); ?></td>
				<td><?php echo $v; ?></td>
			</tr>
		<?php endforeach; ?>
	</table>

	<p><?php echo __("Bonne journée :)"); ?></p>
</div>

</body>
</html>
