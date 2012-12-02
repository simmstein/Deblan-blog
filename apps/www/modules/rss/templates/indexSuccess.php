<?php use_helper('Post'); ?>
<?php echo '<?'; ?>xml version="1.0" encoding="UTF-8" ?>
<rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/">
	<channel>
		<title><?php echo __('Deblan - Blog'); ?></title>
		<link>http://www.deblan.tv/</link>
		<description><?php echo __('Deblan - Blog'); ?></description>
		<language>fr</language>
		<?php if(!empty($posts)): ?>
			<?php foreach($posts as $post): ?>
				<item>
					<title><![CDATA[<?php echo $post->getTitle(); ?>]]></title>
					<link>http://<?php echo $_SERVER['SERVER_NAME'], url_for('@post?id='.$post->getId().'&slugy_path='.$post->getSlugyPath()); ?></link>
					<description><![CDATA[<?php 
					echo parse_texte(utf8_decode(html_entity_decode($post->getContent()))); 
					?>]]></description>
					<guid isPermaLink="false"><?php echo $post->getId(); ?></guid>
					<pubDate><?php echo date_format(new DateTime($post->getPublishedAt()), 'r'); ?></pubDate>
					<?php $pl = false; foreach($post->getCategories() as $category): ?>
						<category><![CDATA[<?php echo $category->getName(); ?>]]></category>
						<?php if(in_array($category->getId(), array(11, 6)) && !$pl): $pl = true; ?>
							<category><![CDATA[planet-libre]]></category>
						<?php endif; ?>
					<?php endforeach; ?>
				</item>
			<?php endforeach; ?>
		<?php endif; ?>
	</channel>
</rss>
