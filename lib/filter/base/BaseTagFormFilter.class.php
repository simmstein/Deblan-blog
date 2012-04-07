<?php

/**
 * Tag filter form base class.
 *
 * @package    deblantv
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseTagFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'post_has_tag_list' => new sfWidgetFormPropelChoice(array('model' => 'Post', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'name'              => new sfValidatorPass(array('required' => false)),
      'post_has_tag_list' => new sfValidatorPropelChoice(array('model' => 'Post', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tag_filters[%s]');

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

    $criteria->addJoin(PostHasTagPeer::TAG_ID, TagPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(PostHasTagPeer::POST_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(PostHasTagPeer::POST_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'Tag';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'name'              => 'Text',
      'post_has_tag_list' => 'ManyKey',
    );
  }
}
