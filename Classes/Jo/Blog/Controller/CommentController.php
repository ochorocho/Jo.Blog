<?php
namespace Jo\Blog\Controller;

/*
 * This file is part of the Jo.Blog package.
 */


use Jo\Blog\Domain\Repository\BlogEntryRepository;
use Jo\Blog\Domain\Repository\CommentRepository;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

use TYPO3\Flow\Error\Debugger;
use TYPO3\Flow\Mvc\Controller\ActionController;
use TYPO3\Media\TypeConverter\AssetInterfaceConverter;

use Jo\Blog\Domain\Model\BlogEntry;
use Jo\Blog\Domain\Model\Comment;

class CommentController extends ActionController
{

    /**
     * @Flow\Inject
     * @var \Jo\Blog\Domain\Repository\BlogEntryRepository
     */
    protected $blogEntryRepository;

    /**
     * @Flow\Inject
     * @var \Jo\Blog\Domain\Repository\CommentRepository
     */
    protected $commentRepository;

    /**
     * Creates a new comment
     *
     * @param Comment $newComment
     * @return void
     */
    public function createAction(Comment $newComment) {
        $this->commentRepository->add($newComment);
        $this->addFlashMessage('Created a new comment.');
        $this->redirect('show','BlogEntry',NULL,array('blogEntry' => $newComment->getBlogEntry()));
    }

}
