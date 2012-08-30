<?php

/**
 * Comment form.
 *
 * @package    deblantv
 * @subpackage form
 * @author     Your name here
 */
class CommentForm extends BaseCommentForm
{
  public function configure()
  {
	unset($this['id'], $this['created_at'], $this['updated_at'], $this['ip'], $this['avatar']);
  }
}
