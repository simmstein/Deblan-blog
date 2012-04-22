<?php echo '<?'; ?>xml version="1.0" encoding="UTF-8" ?>
<rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/">
	<channel>
		<title><?php echo __('Blog Deblan'); ?></title>
		<link>http://www.deblan.tv/</link>
		<description><?php echo __('Blog Deblan'); ?></description>
		<language>fr</language>
		<?php if(!empty($posts)): ?>
			<?php foreach($posts as $post): ?>
				<item>
					<title><![CDATA[<?php echo $post->getTitle(); ?>]]></title>
					<link>http://<?php echo $_SERVER['SERVER_NAME'], url_for('@post?id='.$post->getId().'&slugy_path='.$post->getSlugyPath()); ?></link>
					<description><![CDATA[<?php echo html_entity_decode((parse_texte(str_replace(array('&lt;', '&gt;'), array('<', '>'),$post->getContent()))), ENT_NOQUOTES, 'ISO-8859-1'); ?>	]]></description>
					<guid isPermaLink="false"><?php echo $post->getId(); ?></guid>
					<pubDate><?php echo date_format(new DateTime($post->getPublishedAt()), 'r'); ?></pubDate>
				</item>
			<?php endforeach; ?>
		<?php endif; ?>
	</channel>
</rss>

<?php
/**
 *
 * Tracking
 *
 */

require_once('/var/www/service-web/www/owa.deblan.org/public_html/owa_php.php');
		
$owa = new owa_php();
// Set the site id you want to track
$owa->setSiteId('fd0aaff20fe48fdf58f716063fecf7b4');
// Uncomment the next line to set your page title
$owa->setPageTitle(sfContext::getInstance()->getResponse()->getTitle());
// Set other page properties
$owa->setProperty('rss', 'yes');
$owa->setProperty('admin', 'no');
$owa->trackPageView();
