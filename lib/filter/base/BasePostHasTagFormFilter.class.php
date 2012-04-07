<?php

/**
 * PostHasTag filter form base class.
 *
 * @package    deblantv
 * @subpackage filter
 * @author     Your name here
 */
abstract class BasePostHasTagFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
    ));

    $this->setValidators(array(
    ));

    $this->widgetSchema->setNameFormat('post_has_tag_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PostHasTag';
  }

  public function getFields()
  {
    return array(
      'post_id' => 'ForeignKey',
      'tag_id'  => 'ForeignKey',
    );
  }
}
