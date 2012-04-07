<?php

/**
 * Category filter form base class.
 *
 * @package    deblantv
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseCategoryFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'rank'                   => new sfWidgetFormFilterInput(),
      'is_active'              => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'post_has_category_list' => new sfWidgetFormPropelChoice(array('model' => 'Post', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'name'                   => new sfValidatorPass(array('required' => false)),
      'rank'                   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'is_active'              => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'post_has_category_list' => new sfValidatorPropelChoice(array('model' => 'Post', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('category_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
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

    $criteria->addJoin(PostHasCategoryPeer::CATEGORY_ID, CategoryPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(PostHasCategoryPeer::POST_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(PostHasCategoryPeer::POST_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'Category';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'name'                   => 'Text',
      'rank'                   => 'Number',
      'is_active'              => 'Boolean',
      'post_has_category_list' => 'ManyKey',
    );
  }
}
