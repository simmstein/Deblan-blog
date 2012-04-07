<?php

/**
 * Comment filter form base class.
 *
 * @package    deblantv
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseCommentFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'post_id'           => new sfWidgetFormPropelChoice(array('model' => 'Post', 'add_empty' => true)),
      'parent_comment_id' => new sfWidgetFormPropelChoice(array('model' => 'Comment', 'add_empty' => true)),
      'author'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'website'           => new sfWidgetFormFilterInput(),
      'email'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'content'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'avatar'            => new sfWidgetFormFilterInput(),
      'ip'                => new sfWidgetFormFilterInput(),
      'created_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'post_id'           => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Post', 'column' => 'id')),
      'parent_comment_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Comment', 'column' => 'id')),
      'author'            => new sfValidatorPass(array('required' => false)),
      'website'           => new sfValidatorPass(array('required' => false)),
      'email'             => new sfValidatorPass(array('required' => false)),
      'content'           => new sfValidatorPass(array('required' => false)),
      'avatar'            => new sfValidatorPass(array('required' => false)),
      'ip'                => new sfValidatorPass(array('required' => false)),
      'created_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('comment_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Comment';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'post_id'           => 'ForeignKey',
      'parent_comment_id' => 'ForeignKey',
      'author'            => 'Text',
      'website'           => 'Text',
      'email'             => 'Text',
      'content'           => 'Text',
      'avatar'            => 'Text',
      'ip'                => 'Text',
      'created_at'        => 'Date',
      'updated_at'        => 'Date',
    );
  }
}
