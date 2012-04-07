<?php

class sfWidgetFormMarkitupTextarea extends sfWidgetForm
{

  protected function configure($options = array(), $attributes = array())
  {
    $this->setAttribute('rows', 4);
    $this->setAttribute('cols', 30);
		$this->addOption('set', '/js/dashboard/set.js');
  }

  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
		$class = ' markitup';

		if(!isset($attributes['class'])) {
			$attributes['class'] = '';
		}

		$attributes['class'].= $class;

		sfContext::getInstance()->getResponse()->addJavascript($this->getOption('set'));

    return $this->renderContentTag('textarea', self::escapeOnce($value), array_merge(array('name' => $name), $attributes));
  }
}
