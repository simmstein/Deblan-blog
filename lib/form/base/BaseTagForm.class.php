<?php

/**
 * Tag form base class.
 *
 * @method Tag getObject() Returns the current form's model object
 *
 * @package    deblantv
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseTagForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'name'              => new sfWidgetFormInputText(),
      'post_has_tag_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Post')),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'name'              => new sfValidatorString(array('max_length' => 255)),
      'post_has_tag_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Post', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tag[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tag';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['post_has_tag_list']))
    {
      $values = array();
      foreach ($this->object->getPostHasTags() as $obj)
      {
        $values[] = $obj->getPostId();
      }

      $this->setDefault('post_has_tag_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->savePostHasTagList($con);
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
    $c->add(PostHasTagPeer::TAG_ID, $this->object->getPrimaryKey());
    PostHasTagPeer::doDelete($c, $con);

    $values = $this->getValue('post_has_tag_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new PostHasTag();
        $obj->setTagId($this->object->getPrimaryKey());
        $obj->setPostId($value);
        $obj->save();
      }
    }
  }

}
