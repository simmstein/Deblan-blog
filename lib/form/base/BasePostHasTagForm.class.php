<?php

/**
 * PostHasTag form base class.
 *
 * @method PostHasTag getObject() Returns the current form's model object
 *
 * @package    deblantv
 * @subpackage form
 * @author     Your name here
 */
abstract class BasePostHasTagForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'post_id' => new sfWidgetFormInputHidden(),
      'tag_id'  => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'post_id' => new sfValidatorPropelChoice(array('model' => 'Post', 'column' => 'id', 'required' => false)),
      'tag_id'  => new sfValidatorPropelChoice(array('model' => 'Tag', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('post_has_tag[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PostHasTag';
  }


}
