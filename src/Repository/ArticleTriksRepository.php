<?php

namespace App\Repository;

use App\Entity\ArticleTriks;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

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

    public function getPaginArticle(int $paginator_per_page) {
        $query = $this->createQueryBuilder('a')
            ->setMaxResults($paginator_per_page)
            ->getQuery()
        ;
        return new Paginator($query);
    }

    public function addArticle(ArticleTriks $article, int $userId, int $groupId){
        $conn = $this->getEntityManager()->getConnection();
        $date = date("Y-m-d");
        $sql = 'INSERT INTO article_triks (nom_art_triks, contenu_art_triks, date_creation_art_triks, date_derniere_modification_art_triks, utilisateur_id, groupe_id) 
        VALUES ("'.$article->getNomArtTriks().'", "'.$article->getContenuArtTriks().'", "'.$date.'", "'.$date.'",'.$userId.','.$groupId.')';

        $stmt = $conn->prepare($sql);
        return $stmt->execute();
    }

    public function getMaxId(){
        $query = $this->createQueryBuilder('a');
        $query->select('MAX(a.id) AS max_id');
        return $query->getQuery()->getResult();
    }

}
