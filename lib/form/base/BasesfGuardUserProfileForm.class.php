<?php

/**
 * sfGuardUserProfile form base class.
 *
 * @method sfGuardUserProfile getObject() Returns the current form's model object
 *
 * @package    deblantv
 * @subpackage form
 * @author     Your name here
 */
abstract class BasesfGuardUserProfileForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'     => new sfWidgetFormInputHidden(),
      'firstname'   => new sfWidgetFormInputText(),
      'lastname'    => new sfWidgetFormInputText(),
      'email'       => new sfWidgetFormInputText(),
      'avatar'      => new sfWidgetFormInputText(),
      'twitter'     => new sfWidgetFormInputText(),
      'facebook'    => new sfWidgetFormInputText(),
      'linkedin'    => new sfWidgetFormInputText(),
      'blog'        => new sfWidgetFormInputText(),
      'website'     => new sfWidgetFormInputText(),
      'description' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'user_id'     => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id', 'required' => false)),
      'firstname'   => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'lastname'    => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'email'       => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'avatar'      => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'twitter'     => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'facebook'    => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'linkedin'    => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'blog'        => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'website'     => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'description' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_guard_user_profile[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfGuardUserProfile';
  }


}
