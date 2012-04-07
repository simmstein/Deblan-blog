<?php

/**
 * Post form.
 *
 * @package    deblantv
 * @subpackage form
 * @author     Your name here
 */
class PostForm extends BasePostForm
{
  public function configure()
  {
		unset($this['created_at'], $this['updated_at']);

		$this->setWidget(
			'post_has_category_list',
			new sfWidgetFormPropelChoice(array(
				'multiple' => true, 
				'model' => 'Category',
				'expanded' => true
			))
		);

		$this->setWidget(
			'published_at',
			new sfWidgetFormDateJQueryUI(array(
				'show_button_panel' => true
			))
		);

		$this->setWidget(
			'content', 
			new sfWidgetFormMarkitupTextarea()
		);
  }
}
