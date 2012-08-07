<?php

require_once dirname(__FILE__).'/../lib/linkGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/linkGeneratorHelper.class.php';

/**
 * link actions.
 *
 * @package    deblantv
 * @subpackage link
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class linkActions extends autoLinkActions
{
	public function preExecute() {
		parent::preExecute();

		if(!$this->getUser()->getGuardUser()->hasPermission('Rediger')) {
			$this->redirect('@homepage');
			die;
		}
	}

	public function executeIndex(sfWebRequest $request) {
		$this->pager = $this->configuration->getPager('Link');
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
			$object = LinkPeer::retrieveByPK($id);

			if($object) {
				$object->setRank($rank);
				$object->save();
			}
		}
	}
}
