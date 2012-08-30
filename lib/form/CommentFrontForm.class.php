<?php

/**
 * Comment form.
 *
 * @package    deblantv
 * @subpackage form
 * @author     Your name here
 */
class CommentFrontForm extends BaseCommentForm
{
  public function configure()
  {
		unset($this['id'], $this['created_at'], $this['updated_at'], $this['ip'], $this['avatar'], $this['post_id']);

		$this->setWidget('author', new sfWidgetFormInput());
		$this->setWidget('email', new sfWidgetFormInput());
		$this->setWidget('website', new sfWidgetFormInput());
		$this->setWidget('parent_comment_id', new sfWidgetFormInputHidden());
		$this->setWidget('content', new sfWidgetFormTextarea());
		$this->setWidget('remember', new sfWidgetFormSelectCheckbox(array(
			'choices' => array(1),
		)));

		$this->setValidator(
			'author', 
			new sfValidatorString(array(
				'required' => true
			))
		);

		$this->setValidator(
			'content', 
			new sfValidatorString(array(
				'required' => true
			))
		);

		$this->setValidator(
			'email',
			new sfValidatorEmail(array(
				'required' => true
			))
		);

		$this->setValidator(
			'remember', 
			new sfValidatorChoice(array(
				'choices' => array(0),
				'required' => false
			))
		);
  }
}
