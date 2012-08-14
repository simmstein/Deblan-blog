<?php

/**
 * sitemap actions.
 *
 * @package    deblantv
 * @subpackage sitemap
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sitemapActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
	$http = 'http://'.$_SERVER['SERVER_NAME'];

    $this->pages = array(
		array(
			'loc' => $http.$this->getContext()->getController()->genUrl('@homepage'),
			'changefreq' => 'daily'
		),
		array(
			'loc' => $http.$this->getContext()->getController()->genUrl('@contact'),
			'changefreq' => 'monthly'
		),
		array(
			'loc' => $http.$this->getContext()->getController()->genUrl('@minecraft'),
			'changefreq' => 'monthly'
		)
	);

	$c = new Criteria();
	$c->addAnd(PostPeer::IS_ACTIVE, true);

	$posts = PostPeer::doSelect($c);

	foreach($posts as $k => $post) {
		$img = !preg_match('`^http`', $post->getPicture()) ? $http.'/'.$post->getPicture() : $post->getPicture();

		$this->pages[] = array(
			'loc' => $http.$this->getContext()->getController()->genUrl('@post?id='.$post->getId().'&slugy_path='.$post->getSlugyPath()),
			'changefreq' => 'monthly',
			'image:image' => '<image:loc><![CDATA['.$img.']]></image:loc>'
		);
	}

	$c = new Criteria();
	$c->addAnd(CategoryPeer::IS_ACTIVE, true);

	$categories = PostPeer::doSelect($c);

	foreach($categories as $k => $category) {
		$this->pages[] = array(
			'loc' => $http.$this->getContext()->getController()->genUrl('@category?id='.$category->getId().'&slugy_path='.$post->getSlugyPath()),
			'changefreq' => 'weekly'
		);
	}
  }
}
