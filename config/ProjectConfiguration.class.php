<?php

require_once dirname(__FILE__).'/../lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->enablePlugins('sfPropelPlugin');
    $this->enablePlugins('sfGuardPlugin');
    $this->enablePlugins('sfJQueryUIPlugin');
    $this->enablePlugins('sfFormExtraPlugin');
    $this->enablePlugins('sfFeed2Plugin');
    $this->enablePlugins('sfImageTransformPlugin');
    $this->enablePlugins('sfThumbnailPlugin');
		$this->enablePlugins('sfAssetsLibraryPlugin');
  }
}
