<?php

/**
 * PostHasCategory filter form base class.
 *
 * @package    deblantv
 * @subpackage filter
 * @author     Your name here
 */
abstract class BasePostHasCategoryFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
    ));

    $this->setValidators(array(
    ));

    $this->widgetSchema->setNameFormat('post_has_category_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PostHasCategory';
  }

  public function getFields()
  {
    return array(
      'post_id'     => 'ForeignKey',
      'category_id' => 'ForeignKey',
    );
  }
}
