<?php
namespace Jo\Blog\Domain\Model;

/*
 * This file is part of the Jo.Blog package.
 */

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Flow\Entity
 */
class Comment
{


    /**
     * @Flow\Validate(type="NotEmpty")
     * @ORM\ManyToOne(inversedBy="comments")
     * @var BlogEntry
     */
    protected $blogEntry;

    /**
     * @var \DateTime
     */
    protected $date;

    /**
     * @var string
     */
    protected $author;

    /**
     * @var string
     */
    protected $content;


    /**
     * Constructs this comment
     */
    public function __construct() {
            $this->date = new \DateTime();
    }

    /**
     * @return BlogEntry
     */
    public function getBlogEntry() {
            return $this->blogEntry;
    }

    /**
     * @param BlogEntry $blogEntry
     * @return void
     */
    public function setBlogEntry(BlogEntry $blogEntry) {
            $this->blogEntry = $blogEntry;
            $this->blogEntry->addComment($this);
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     * @return void
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param string $author
     * @return void
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return void
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

}
