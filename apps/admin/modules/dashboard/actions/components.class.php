<?php
	
class dashboardComponents extends sfComponents {
	public function executeHeader(sfWebRequest $request) {
		$this->website_url = 'http://'.$_SERVER['SERVER_NAME'].'/';	
	}

	public function executeMenu(sfWebRequest $request) {
		$this->menus = array();

		if(sfContext::getInstance()->getUser()->isAuthenticated()) {
			try {
				$this->menus = sfYaml::load(dirname(__FILE__).'/../config/menu.yml');
			}
			catch(Exception $e) {
				echo 'Foo';
			}
		}
	}
}
