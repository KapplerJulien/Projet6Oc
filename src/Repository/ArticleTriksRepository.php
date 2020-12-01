<?php

namespace App\Repository;

use App\Entity\ArticleTriks;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ArticleTriks|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticleTriks|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticleTriks[]    findAll()
 * @method ArticleTriks[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleTriksRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArticleTriks::class);
    }

    // /**
    //  * @return ArticleTriks[] Returns an array of ArticleTriks objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ArticleTriks
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
