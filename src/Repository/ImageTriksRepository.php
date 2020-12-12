<?php

namespace App\Repository;

use App\Entity\ImageTriks;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\ArticleTriks;

/**
 * @method ImageTriks|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImageTriks|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImageTriks[]    findAll()
 * @method ImageTriks[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImageTriksRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImageTriks::class);
    }

    // /**
    //  * @return ImageTriks[] Returns an array of ImageTriks objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ImageTriks
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getMinId(ArticleTriks $article) {
        $query = $this->createQueryBuilder('i');
        $query->select('MIN(i.id) AS min_id');
        $query->where('i.Article = :article')->setParameter('article', $article);
        return $query->getQuery()->getResult();
    }

    public function getImgById(Array $idImg){
        return $this->findBy(
            ['id' => $idImg["min_id"]]
        );
    }
}
