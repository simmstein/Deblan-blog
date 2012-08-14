<?php

/**
 * rss actions.
 *
 * @package    deblantv
 * @subpackage rss
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */

require_once dirname(__FILE__).'/../../../../../lib/helper/PostHelper.php';

class rssActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
        $this->posts = PostPeer::getLastPosts(5);
  }

    public function executeCategory(sfWebRequest $request)
    {
        $category = CategoryPeer::retrieveByPK($request->getParameter('id'));

        if ($category) {
            $this->posts = $category->getLastPosts(5);
        }

        $this->setTemplate('index');
    }

    public function executePost(sfWebRequest $request)
    {
        $post = PostPeer::retrieveByPK($request->getParameter('id'));

        if ($post) {
            $this->posts = array($post);
        }

        $this->setTemplate('index');
    }
}
