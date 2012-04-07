<?php

/**
 * clearcache actions.
 *
 * @package    clubmedgym
 * @subpackage clearcache
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class clearcacheActions extends sfActions
{

	public function preExecute() {
		parent::preExecute();

		if(!$this->getUser()->getGuardUser()->hasPermission('Administrer')) {
			$this->redirect('@homepage');
			die;
		}
	}


 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    //$this->forward('default', 'module');
  }

	public function executeClearcache(sfWebRequest $request) {
		$this->return = nl2br(shell_exec('cd ../; ./symfony cc | tee'));
	}
}
