<?php

/**
 * Comment form base class.
 *
 * @method Comment getObject() Returns the current form's model object
 *
 * @package    deblantv
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseCommentForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'post_id'           => new sfWidgetFormPropelChoice(array('model' => 'Post', 'add_empty' => false)),
      'parent_comment_id' => new sfWidgetFormPropelChoice(array('model' => 'Comment', 'add_empty' => true)),
      'author'            => new sfWidgetFormInputText(),
      'website'           => new sfWidgetFormInputText(),
      'email'             => new sfWidgetFormInputText(),
      'content'           => new sfWidgetFormTextarea(),
      'avatar'            => new sfWidgetFormInputText(),
      'ip'                => new sfWidgetFormInputText(),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'post_id'           => new sfValidatorPropelChoice(array('model' => 'Post', 'column' => 'id')),
      'parent_comment_id' => new sfValidatorPropelChoice(array('model' => 'Comment', 'column' => 'id', 'required' => false)),
      'author'            => new sfValidatorString(array('max_length' => 255)),
      'website'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'email'             => new sfValidatorString(array('max_length' => 255)),
      'content'           => new sfValidatorString(),
      'avatar'            => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'ip'                => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_at'        => new sfValidatorDateTime(array('required' => false)),
      'updated_at'        => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('comment[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Comment';
  }


}
