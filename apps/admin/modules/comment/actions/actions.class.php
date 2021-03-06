<?php

require_once dirname(__FILE__).'/../lib/commentGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/commentGeneratorHelper.class.php';

/**
 * comment actions.
 *
 * @package    deblantv
 * @subpackage comment
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class commentActions extends autoCommentActions
{
	public function preExecute() {
		parent::preExecute();

		if(!$this->getUser()->getGuardUser()->hasPermission('Rediger')) {
			$this->redirect('@homepage');
			die;
		}
	}
}
