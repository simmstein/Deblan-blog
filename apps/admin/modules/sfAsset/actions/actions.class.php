<?php

require_once sfConfig::get('sf_plugins_dir'). '/sfAssetsLibraryPlugin/modules/sfAsset/lib/BasesfAssetActions.class.php';

class sfAssetActions extends BasesfAssetActions
{
	public function preExecute() {
		parent::preExecute();

		if(!$this->getUser()->getGuardUser()->hasPermission('Rediger')) {
			$this->redirect('@homepage');
			die;
		}
	}
}
