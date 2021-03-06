<?php

/**
 * Skeleton subclass for representing a row from the 'post' table.
 *
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Thu Jan 12 16:08:13 2012
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class Post extends BasePost
{
    public function __toString()
    {
        return $this->getTitle();
    }

    public function getSlugyPath()
    {
        return Tools::slugify($this->getTitle());
    }

    public function getCategories()
    {
        $criteria = new Criteria();
        $criteria->addJoin(CategoryPeer::ID, PostHasCategoryPeer::CATEGORY_ID);
        $criteria->addAnd(PostHasCategoryPeer::POST_ID, $this->getId());

        return CategoryPeer::doSelect($criteria);
    }

    public function getTagsAsArray()
    {
        $tags = preg_replace('`,\s+`', ',', $this->getTags());

        return explode(',', $tags);
    }

    public function getCountComments()
    {
        $criteria = new Criteria();
        $criteria->addAnd(CommentPeer::POST_ID, $this->getId());

        return CommentPeer::doCount($criteria);
    }

    public function save(PropelPDO $con = null)
    {
        if (!$this->getUserId()) {
            $this->setUserId(sfContext::getInstance()->getUser()->getGuardUser()->getId());
        }

        parent::save();
    }

    public function getComments($criteria = null, PropelPDO $con = null)
    {
        $criteria = new Criteria();
        $criteria->addAscendingOrderByColumn(CommentPeer::CREATED_AT);

        return parent::getComments($criteria);
    }

    public function getSortedComments($criteria = null, PropelPDO $con = null)
    {
        $comments = $this->getComments();

        $datas = array();

        foreach ($comments as $comment) {
            if (!isset($datas[$comment->getId()])) {
                $datas[$comment->getId()] = $comment;
            }

            if ($comment->hasParent()) {
                $parent = $datas[$comment->getParentCommentId()];
                $parent->addChild($comment);
            }
        }

        return $datas;
    }

    public function getHasMore()
    {
        return preg_match('`<couper>`', $this->getContent());
    }

    public function getIsOld()
    {
        $now  = new DateTime('now');
        $end  = new DateTime($this->getPublishedAt());
        $diff = $end->diff($now);

        return $diff->m >= 3;
    }
} // Post
