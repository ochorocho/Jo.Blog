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
use TYPO3\Flow\Property\PropertyMappingConfiguration;
use TYPO3\Flow\Property\TypeConverter\PersistentObjectConverter;
use TYPO3\Media\TypeConverter\AssetInterfaceConverter;

use Jo\Blog\Domain\Model\BlogEntry;

class BlogEntryController extends ActionController
{

    /**
     * @Flow\Inject
     * @var \TYPO3\Flow\Resource\ResourceManager
     */
    protected $resourceManager;

    /**
     * @Flow\Inject
     * @var \TYPO3\Media\Domain\Repository\AssetRepository
     */
    protected $assetRepository;

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
     * @ORM\ManyToMany
     * @var \Doctrine\Common\Collections\Collection<\Jo\Blog\Domain\Model\Comment>
     */
    protected $comments;


    /**
     * @return void
     */
    public function indexAction()
    {

        $this->blogEntryRepository->setDefaultOrderings(array('datecreated' => \TYPO3\Flow\Persistence\QueryInterface::ORDER_DESCENDING));
        $this->view->assign('blogEntries', $this->blogEntryRepository->findAll());
    }

    /**
     * @param \Jo\Blog\Domain\Model\BlogEntry $blogEntry
     * @return void
     */
    public function showAction(BlogEntry $blogEntry)
    {
        $this->view->assign('blogEntry', $blogEntry);

    }

    /**
     * @return void
     */
    public function newAction()
    {
    }

   /**
     * @param \Jo\Blog\Domain\Model\BlogEntry $newBlogEntry
     * @return void
     */
    public function createAction(BlogEntry $newBlogEntry)
    {

        $dateNow = date("Y-m-d H:i:s");
        $newBlogEntry->setDatecreated($dateNow);

        $this->blogEntryRepository->add($newBlogEntry);
        $this->addFlashMessage('Created a new blog entry.');
        $this->redirect('index');
    }

    /**
     * @param \Jo\Blog\Domain\Model\BlogEntry $blogEntry
     * @return void
     */
    public function editAction(BlogEntry $blogEntry)
    {
        $this->view->assign('blogEntry', $blogEntry);
    }

    /**
     * @param \Jo\Blog\Domain\Model\BlogEntry $blogEntry
     * @return void
     */
    public function updateAction(BlogEntry $blogEntry)
    {
        $this->blogEntryRepository->update($blogEntry);

//        $post = new Comment();
//        $post->setBlog($blogEntry);
//        $post->setTitle('John Doe');
//        $post->setAuthor('John Doe');
//        $post->setSubject('Example Post');
//        $post->setContent('NUI! dolor sit amet, consectetur adipisicing elit.' . chr(10) . 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.');
//        $this->commentRepository->add($post);


        $this->addFlashMessage('Updated the blog entry.');
        $this->redirect('index');
    }




    /**
     * @param \Jo\Blog\Domain\Model\BlogEntry $blogEntry
     * @return void
     */
    public function deleteAction(BlogEntry $blogEntry)
    {
        $this->blogEntryRepository->remove($blogEntry);
        $this->addFlashMessage('Deleted a blog entry.');
        $this->redirect('index');
    }


}
