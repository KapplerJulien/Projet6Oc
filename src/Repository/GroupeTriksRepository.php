<?php

namespace App\Repository;

use App\Entity\GroupeTriks;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GroupeTriks|null find($id, $lockMode = null, $lockVersion = null)
 * @method GroupeTriks|null findOneBy(array $criteria, array $orderBy = null)
 * @method GroupeTriks[]    findAll()
 * @method GroupeTriks[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupeTriksRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GroupeTriks::class);
    }

    // /**
    //  * @return GroupeTriks[] Returns an array of GroupeTriks objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GroupeTriks
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
