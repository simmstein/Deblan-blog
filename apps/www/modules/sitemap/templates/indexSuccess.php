<?php echo '<?'; ?>xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
        xmlns:video="http://www.sitemaps.org/schemas/sitemap-video/1.1">
  
<?php foreach($pages as $page): ?>
	<url>
		<?php foreach($page as $k => $v): ?>
			<<?=$k?>><?=html_entity_decode($v)?></<?=$k?>>
		<?php endforeach; ?>
	</url>
<?php endforeach; ?>
</urlset>
