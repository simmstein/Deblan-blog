<?php

/**
 * Skeleton subclass for representing a row from the 'comment' table.
 *
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Thu Jan 12 16:08:14 2012
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class Comment extends BaseComment
{
    private $children = array();

    public function __toString()
    {
        return $this->getId();
    }

    public function addChild(Comment $comment)
    {
        $this->children[] = $comment;
    }

    public function getChildren()
    {
        return $this->children;
    }

    public function hasChildren()
    {
        return !empty($this->children);
    }

    public function hasParent()
    {
        return $this->getParentCommentId() > 0;
    }

    public function getGravatar()
    {
        return (empty($_SERVER['HTTPS']) ? 'http://www.' : 'https://secure.').'gravatar.com/avatar/'.md5($this->getEmail()).'.jpg?s=150';
    }

    public function save(PropelPDO $con = null)
    {
        if (!empty($this->website)) {
            $this->website = trim($this->website);
            if (!preg_match('`^https?://`', $this->website)) {
                $this->website = 'http://'.$this->website;
            }
        }

        parent::save($con);
    }

    public function delete(PropelPDO $con = null)
    {
        $con = Propel::getConnection();
        $stmt = $con->prepare('update '.CommentPeer::TABLE_NAME.' set '.CommentPeer::PARENT_COMMENT_ID.'=NULL where '.CommentPeer::PARENT_COMMENT_ID.'='.$this->getId());
        $stmt->execute();

        parent::delete($conn);
    }
} // Comment
