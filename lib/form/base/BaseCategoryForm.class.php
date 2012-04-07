<?php

/**
 * Category form base class.
 *
 * @method Category getObject() Returns the current form's model object
 *
 * @package    deblantv
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseCategoryForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputHidden(),
      'name'                   => new sfWidgetFormInputText(),
      'rank'                   => new sfWidgetFormInputText(),
      'is_active'              => new sfWidgetFormInputCheckbox(),
      'post_has_category_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Post')),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'name'                   => new sfValidatorString(array('max_length' => 255)),
      'rank'                   => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'is_active'              => new sfValidatorBoolean(array('required' => false)),
      'post_has_category_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Post', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('category[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Category';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['post_has_category_list']))
    {
      $values = array();
      foreach ($this->object->getPostHasCategorys() as $obj)
      {
        $values[] = $obj->getPostId();
      }

      $this->setDefault('post_has_category_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->savePostHasCategoryList($con);
  }

  public function savePostHasCategoryList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['post_has_category_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(PostHasCategoryPeer::CATEGORY_ID, $this->object->getPrimaryKey());
    PostHasCategoryPeer::doDelete($c, $con);

    $values = $this->getValue('post_has_category_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new PostHasCategory();
        $obj->setCategoryId($this->object->getPrimaryKey());
        $obj->setPostId($value);
        $obj->save();
      }
    }
  }

}
