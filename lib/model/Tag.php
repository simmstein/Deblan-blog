<?php

/**
 * Skeleton subclass for representing a row from the 'tag' table.
 *
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Thu Jan 12 20:15:07 2012
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class Tag extends BaseTag
{
    public function __toString()
    {
        return $this->getName();
    }
} // Tag
