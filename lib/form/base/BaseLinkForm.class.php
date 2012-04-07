<?php

/**
 * Link form base class.
 *
 * @method Link getObject() Returns the current form's model object
 *
 * @package    deblantv
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseLinkForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'name'        => new sfWidgetFormInputText(),
      'url'         => new sfWidgetFormInputText(),
      'description' => new sfWidgetFormInputText(),
      'rank'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'name'        => new sfValidatorString(array('max_length' => 255)),
      'url'         => new sfValidatorString(array('max_length' => 255)),
      'description' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'rank'        => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('link[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Link';
  }


}
