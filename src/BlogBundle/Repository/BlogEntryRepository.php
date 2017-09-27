<?php

namespace BlogBundle\Repository;

/**
 * BlogEntryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BlogEntryRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAllPublished()
    {
        return $this->createQueryBuilder('b')
            ->leftJoin('b.categories', 'categories')
            ->where('b.isActive = (:ia)')
            ->setParameter('ia',true)
            ->getQuery()
            ->getResult();
    }

    public function findActiveBySlug($slug)
    {
        return $this->createQueryBuilder('b')
            ->where('b.slug = :slug')
            ->setParameter('slug', $slug)
            ->andWhere('b.isActive = :ia')
            ->setParameter('ia',true)
            ->getQuery()
            ->getOneOrNullResult();
    }
}