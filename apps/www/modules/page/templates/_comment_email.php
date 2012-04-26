<?php $domain = 'http://'. $_SERVER['SERVER_NAME']; ?>
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
	<h1><?php echo __('Nouveau commentaire !'); ?></h1>

	<table width="100%">
		<p><?php echo __("Un nouveau commentaire vient d'être posté."); ?></p>
		<p><?php echo __("Article concerné : "); ?><strong><a href="<?php echo $domain,  url_for('@post?id='.$post->getId().'&slugy_path='.$post->getSlugyPath()); ?>"><?php echo $post->getTitle(); ?></a></strong>.</p>

		<p>De <strong><?php echo $comment->getAuthor(); ?></strong> :</p>

		<blockquote><?php echo nl2br($comment->getContent()); ?></blockquote>

	</table>

	<p><?php echo __("Bonne journée :)"); ?></p>
</div>

</body>
</html>
