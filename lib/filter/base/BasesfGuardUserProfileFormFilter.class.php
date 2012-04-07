<?php

/**
 * sfGuardUserProfile filter form base class.
 *
 * @package    deblantv
 * @subpackage filter
 * @author     Your name here
 */
abstract class BasesfGuardUserProfileFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'firstname'   => new sfWidgetFormFilterInput(),
      'lastname'    => new sfWidgetFormFilterInput(),
      'email'       => new sfWidgetFormFilterInput(),
      'avatar'      => new sfWidgetFormFilterInput(),
      'twitter'     => new sfWidgetFormFilterInput(),
      'facebook'    => new sfWidgetFormFilterInput(),
      'linkedin'    => new sfWidgetFormFilterInput(),
      'blog'        => new sfWidgetFormFilterInput(),
      'website'     => new sfWidgetFormFilterInput(),
      'description' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'firstname'   => new sfValidatorPass(array('required' => false)),
      'lastname'    => new sfValidatorPass(array('required' => false)),
      'email'       => new sfValidatorPass(array('required' => false)),
      'avatar'      => new sfValidatorPass(array('required' => false)),
      'twitter'     => new sfValidatorPass(array('required' => false)),
      'facebook'    => new sfValidatorPass(array('required' => false)),
      'linkedin'    => new sfValidatorPass(array('required' => false)),
      'blog'        => new sfValidatorPass(array('required' => false)),
      'website'     => new sfValidatorPass(array('required' => false)),
      'description' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_guard_user_profile_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfGuardUserProfile';
  }

  public function getFields()
  {
    return array(
      'user_id'     => 'ForeignKey',
      'firstname'   => 'Text',
      'lastname'    => 'Text',
      'email'       => 'Text',
      'avatar'      => 'Text',
      'twitter'     => 'Text',
      'facebook'    => 'Text',
      'linkedin'    => 'Text',
      'blog'        => 'Text',
      'website'     => 'Text',
      'description' => 'Text',
    );
  }
}
