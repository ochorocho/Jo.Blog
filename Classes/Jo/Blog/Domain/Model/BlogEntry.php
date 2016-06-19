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
class BlogEntry
{

    /**
     * @var \DateTime
     */
    protected $datecreated;

    /**
     * @var string
     */
    protected $name;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $text;

    /**
     * @ORM\OneToOne(cascade={"persist"})
     * @var \TYPO3\Media\Domain\Model\Image
     */
    protected $imageCover;


    /**
     * @ORM\OneToOne(cascade={"persist"})
     * @var \TYPO3\Media\Domain\Model\Image
     */
    protected $image1;

    /**
     * @ORM\OneToOne(cascade={"persist"})
     * @var \TYPO3\Media\Domain\Model\Image
     */
    protected $image2;

    /**
     * @ORM\OneToOne(cascade={"persist"})
     * @var \TYPO3\Media\Domain\Model\Image
     */
    protected $image3;

    /**
     * The comments contained in this blogEntry
     *
     * @ORM\OneToMany(mappedBy="blogEntry", orphanRemoval=true)
     * @ORM\OrderBy({"date" = "DESC"})
     * @var Collection<Comment>
     */
    protected $comments;

    /**
     * Constructs this comment
     */
    public function __construct() {
        $this->datecreated = new \DateTime();
    }

        
    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return void
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return \TYPO3\Media\Domain\Model\Image
     */
    public function getImageCover()
    {
        return $this->imageCover;
    }

    /**
     * @param \TYPO3\Media\Domain\Model\Image $imageCover
     */
    public function setImageCover($imageCover)
    {
        
        $this->imageCover = $imageCover;
    }

    /**
     * @return \TYPO3\Media\Domain\Model\Image
     */
    public function getImage1()
    {
        return $this->image1;
    }

    /**
     * @param \TYPO3\Media\Domain\Model\Image $image1
     */
    public function setImage1($image1)
    {
        $this->image1 = $image1;
    }

    /**
     * @return \TYPO3\Media\Domain\Model\Image
     */
    public function getImage2()
    {
        return $this->image2;
    }

    /**
     * @param \TYPO3\Media\Domain\Model\Image $image2
     */
    public function setImage2($image2)
    {
        $this->image2 = $image2;
    }

    /**
     * @return \TYPO3\Media\Domain\Model\Image
     */
    public function getImage3()
    {
        return $this->image3;
    }

    /**
     * @param \TYPO3\Media\Domain\Model\Image $image3
     */
    public function setImage3($image3)
    {
                
        $this->image3 = $image3;
    }

    /**
     * @return \DateTime
     */
    public function getDatecreated()
    {
        return $this->datecreated;
    }

    /**
     * @param \DateTime $datecreated
     * @return void
     */
    public function setDatecreated($datecreated)
    {
        $this->datecreated = $datecreated;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments() {
        return $this->comments;
    }

    /**
     * Adds a comment to this blogEntry
     *
     * @param Comment $comment
     * @return void
     */
    public function addComment(Comment $comment) {
        $this->comments->add($comment);
    }

    /**
     * Removes a comment from this blogEntry
     *
     * @param Comment $comment
     * @return void
     */
    public function removeComment(Comment $comment) {
        $this->comments->removeElement($comment);
    }


}
