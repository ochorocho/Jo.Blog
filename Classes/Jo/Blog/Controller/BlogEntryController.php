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

     $imageTest = "data:image/jpeg;base64,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";

    $exp = explode(',', $imageTest);
    $base64 = array_pop($exp);
    $data = base64_decode($base64);
    
    // echo '<img src="' . $imageTest . '"/>';

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
        \TYPO3\Flow\var_dump($blogEntry);
        $this->blogEntryRepository->update($blogEntry);

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
