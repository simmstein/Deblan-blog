<?php

require_once dirname(__FILE__).'/../lib/categoryGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/categoryGeneratorHelper.class.php';

/**
 * category actions.
 *
 * @package    deblantv
 * @subpackage category
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class categoryActions extends autoCategoryActions
{
	public function preExecute() {
		parent::preExecute();

		if(!$this->getUser()->getGuardUser()->hasPermission('Rediger')) {
			$this->redirect('@homepage');
			die;
		}
	}


	public function executeIndex(sfWebRequest $request) {
		$this->pager = $this->configuration->getPager('Category');
		$this->pager->setCriteria($this->buildCriteria());
		$this->pager->setPage($this->getPage());
		$this->pager->setPeerMethod('getAllByRank');
		$this->pager->setPeerCountMethod($this->configuration->getPeerCountMethod());
		$this->pager->init();
		$this->sort = null;
	}

	public function executeSort(sfWebRequest $request) {
		$id = $request->getParameter('id');
		$rank = intval($request->getParameter('rank'));

		if($id) {
			$object = CategoryPeer::retrieveByPK($id);

			if($object) {
				$object->setRank($rank);
				$object->save();
			}
		}
	}
}
