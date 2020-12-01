<?php

namespace App\Repository;

use App\Entity\VideoTriks;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VideoTriks|null find($id, $lockMode = null, $lockVersion = null)
 * @method VideoTriks|null findOneBy(array $criteria, array $orderBy = null)
 * @method VideoTriks[]    findAll()
 * @method VideoTriks[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VideoTriksRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VideoTriks::class);
    }

    // /**
    //  * @return VideoTriks[] Returns an array of VideoTriks objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VideoTriks
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
