<?php

/**
 * Post form base class.
 *
 * @method Post getObject() Returns the current form's model object
 *
 * @package    deblantv
 * @subpackage form
 * @author     Your name here
 */
abstract class BasePostForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputHidden(),
      'title'                  => new sfWidgetFormInputText(),
      'content'                => new sfWidgetFormTextarea(),
      'tags'                   => new sfWidgetFormInputText(),
      'picture'                => new sfWidgetFormInputText(),
      'created_at'             => new sfWidgetFormDateTime(),
      'updated_at'             => new sfWidgetFormDateTime(),
      'published_at'           => new sfWidgetFormDateTime(),
      'user_id'                => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'is_active'              => new sfWidgetFormInputCheckbox(),
      'post_has_tag_list'      => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Tag')),
      'post_has_category_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Category')),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'title'                  => new sfValidatorString(array('max_length' => 255)),
      'content'                => new sfValidatorString(array('required' => false)),
      'tags'                   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'picture'                => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_at'             => new sfValidatorDateTime(array('required' => false)),
      'updated_at'             => new sfValidatorDateTime(array('required' => false)),
      'published_at'           => new sfValidatorDateTime(array('required' => false)),
      'user_id'                => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id', 'required' => false)),
      'is_active'              => new sfValidatorBoolean(array('required' => false)),
      'post_has_tag_list'      => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Tag', 'required' => false)),
      'post_has_category_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Category', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('post[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Post';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['post_has_tag_list']))
    {
      $values = array();
      foreach ($this->object->getPostHasTags() as $obj)
      {
        $values[] = $obj->getTagId();
      }

      $this->setDefault('post_has_tag_list', $values);
    }

    if (isset($this->widgetSchema['post_has_category_list']))
    {
      $values = array();
      foreach ($this->object->getPostHasCategorys() as $obj)
      {
        $values[] = $obj->getCategoryId();
      }

      $this->setDefault('post_has_category_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->savePostHasTagList($con);
    $this->savePostHasCategoryList($con);
  }

  public function savePostHasTagList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['post_has_tag_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(PostHasTagPeer::POST_ID, $this->object->getPrimaryKey());
    PostHasTagPeer::doDelete($c, $con);

    $values = $this->getValue('post_has_tag_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new PostHasTag();
        $obj->setPostId($this->object->getPrimaryKey());
        $obj->setTagId($value);
        $obj->save();
      }
    }
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
    $c->add(PostHasCategoryPeer::POST_ID, $this->object->getPrimaryKey());
    PostHasCategoryPeer::doDelete($c, $con);

    $values = $this->getValue('post_has_category_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new PostHasCategory();
        $obj->setPostId($this->object->getPrimaryKey());
        $obj->setCategoryId($value);
        $obj->save();
      }
    }
  }

}
