<?php

/**
 * Bot form base class.
 *
 * @method Bot getObject() Returns the current form's model object
 *
 * @package    deblantv
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseBotForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'ip'         => new sfWidgetFormInputText(),
      'url'        => new sfWidgetFormInputText(),
      'trace'      => new sfWidgetFormTextarea(),
      'created_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'ip'         => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'url'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'trace'      => new sfValidatorString(array('required' => false)),
      'created_at' => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('bot[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Bot';
  }


}
