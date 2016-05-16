<?php
namespace Jo\Blog\Domain\Repository;

/*
 * This file is part of the Jo.Blog package.
 */

use Jo\Blog\Domain\Model\BlogEntry;
use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Persistence\Repository;

/**
 * @Flow\Scope("singleton")
 */
class BlogEntryRepository extends Repository
{
        /**
         * Finds the active blog.
         *
         * For now, only one Blog is supported anyway so we just assume that only one
         * Blog object resides in the Blog Repository.
         *
         * @return BlogEntry The active blog or FALSE if none exists
         */
        public function findActive() {
                $query = $this->createQuery();
                return $query->execute()->getFirst();
        }

}
