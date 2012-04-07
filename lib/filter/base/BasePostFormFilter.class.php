<?php

/**
 * Post filter form base class.
 *
 * @package    deblantv
 * @subpackage filter
 * @author     Your name here
 */
abstract class BasePostFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'content'                => new sfWidgetFormFilterInput(),
      'tags'                   => new sfWidgetFormFilterInput(),
      'picture'                => new sfWidgetFormFilterInput(),
      'created_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'published_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'user_id'                => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'is_active'              => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'post_has_tag_list'      => new sfWidgetFormPropelChoice(array('model' => 'Tag', 'add_empty' => true)),
      'post_has_category_list' => new sfWidgetFormPropelChoice(array('model' => 'Category', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'title'                  => new sfValidatorPass(array('required' => false)),
      'content'                => new sfValidatorPass(array('required' => false)),
      'tags'                   => new sfValidatorPass(array('required' => false)),
      'picture'                => new sfValidatorPass(array('required' => false)),
      'created_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'published_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'user_id'                => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'is_active'              => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'post_has_tag_list'      => new sfValidatorPropelChoice(array('model' => 'Tag', 'required' => false)),
      'post_has_category_list' => new sfValidatorPropelChoice(array('model' => 'Category', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('post_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function addPostHasTagListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(PostHasTagPeer::POST_ID, PostPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(PostHasTagPeer::TAG_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(PostHasTagPeer::TAG_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function addPostHasCategoryListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(PostHasCategoryPeer::POST_ID, PostPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(PostHasCategoryPeer::CATEGORY_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(PostHasCategoryPeer::CATEGORY_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'Post';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'title'                  => 'Text',
      'content'                => 'Text',
      'tags'                   => 'Text',
      'picture'                => 'Text',
      'created_at'             => 'Date',
      'updated_at'             => 'Date',
      'published_at'           => 'Date',
      'user_id'                => 'ForeignKey',
      'is_active'              => 'Boolean',
      'post_has_tag_list'      => 'ManyKey',
      'post_has_category_list' => 'ManyKey',
    );
  }
}
