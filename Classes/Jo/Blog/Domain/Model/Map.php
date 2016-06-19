<?php
namespace Jo\Blog\Domain\Model;

/*
 * This file is part of the Jo.Blog package.
 */

use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Flow\Entity
 */
class Map
{

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $file;


    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param string $file
     * @return void
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

}
