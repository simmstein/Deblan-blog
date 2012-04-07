<?php

/**
 * Link filter form base class.
 *
 * @package    deblantv
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseLinkFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'url'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description' => new sfWidgetFormFilterInput(),
      'rank'        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'name'        => new sfValidatorPass(array('required' => false)),
      'url'         => new sfValidatorPass(array('required' => false)),
      'description' => new sfValidatorPass(array('required' => false)),
      'rank'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('link_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Link';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'name'        => 'Text',
      'url'         => 'Text',
      'description' => 'Text',
      'rank'        => 'Number',
    );
  }
}
