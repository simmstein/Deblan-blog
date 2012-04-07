<?php

/**
 * PostHasCategory form base class.
 *
 * @method PostHasCategory getObject() Returns the current form's model object
 *
 * @package    deblantv
 * @subpackage form
 * @author     Your name here
 */
abstract class BasePostHasCategoryForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'post_id'     => new sfWidgetFormInputHidden(),
      'category_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'post_id'     => new sfValidatorPropelChoice(array('model' => 'Post', 'column' => 'id', 'required' => false)),
      'category_id' => new sfValidatorPropelChoice(array('model' => 'Category', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('post_has_category[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PostHasCategory';
  }


}
