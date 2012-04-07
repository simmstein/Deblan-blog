<?php

/**
 * Bot filter form base class.
 *
 * @package    deblantv
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseBotFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ip'         => new sfWidgetFormFilterInput(),
      'url'        => new sfWidgetFormFilterInput(),
      'trace'      => new sfWidgetFormFilterInput(),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'ip'         => new sfValidatorPass(array('required' => false)),
      'url'        => new sfValidatorPass(array('required' => false)),
      'trace'      => new sfValidatorPass(array('required' => false)),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('bot_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Bot';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'ip'         => 'Text',
      'url'        => 'Text',
      'trace'      => 'Text',
      'created_at' => 'Date',
    );
  }
}
