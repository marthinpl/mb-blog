<?php

namespace BlogBundle\Repository;

/**
 * CommentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CommentRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAllByBlogEntry($entryId)
    {
        return $this
            ->createQueryBuilder('c')
            ->where('c.blogEntry = :eid')
            ->setParameter('eid', $entryId)
            ->getQuery()
            ->getResult();
    }
}
