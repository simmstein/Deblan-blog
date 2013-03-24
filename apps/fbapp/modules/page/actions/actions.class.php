<?php

class pageActions extends sfActions
{
	const title_prefix = 'Blog - ';

	public function preExecute() {
		sfConfig::set('sf_escaping_strategy', false);  
		sfContext::getInstance()->getConfiguration()->loadHelpers('Text', 'I18n', 'Post');
		sfContext::getInstance()->getResponse()->addMeta('image_src', 'http://'.$_SERVER['SERVER_NAME'].'/images/image_src.jpg');
	}

  public function executeIndex(sfWebRequest $request)
  {
		$pager = new sfPropelPager('Post', 15);
		$pager->setPage($request->getParameter('page', 1));

		$criteria = new Criteria();
		$criteria->addDescendingOrderByColumn(PostPeer::PUBLISHED_AT);
		$criteria->addAnd(PostPeer::IS_ACTIVE, true);
		$criteria->addJoin(PostHasCategoryPeer::POST_ID, PostPeer::ID);
		$criteria->addJoin(CategoryPeer::ID, PostHasCategoryPeer::CATEGORY_ID);	
		$criteria->addAnd(CategoryPeer::IS_ACTIVE, true);
		$criteria->setDistinct();

		$pager->setCriteria($criteria);	

		$pager->init();

		if(!$pager->getResults()) {
			$this->forward404();
		}

		sfContext::getInstance()->getResponse()->addMeta('title', self::title_prefix.'Accueil');

		$this->current_page = $request->getParameter('page', 1);
		$this->next_page = $pager->getNextPage();
		$this->pager = $pager;
  }
}
