<?php

namespace App\Repository;

use App\Entity\Utilisateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Commentaire;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @method Utilisateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Utilisateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Utilisateur[]    findAll()
 * @method Utilisateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UtilisateurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Utilisateur::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(UserInterface $user, string $newEncodedPassword): void
    {
        if (!$user instanceof Utilisateur) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newEncodedPassword);
        $this->_em->persist($user);
        $this->_em->flush();
    }

    public function getUserByEmail(String $emailUser){
        return $this->findBy([
            'MailUtilisateur' => $emailUser
        ]);
    }

    public function setPasswordUser(Int $idUser, String $passwordUser){
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'Update Utilisateur set password = "'.$passwordUser.'" where id='.$idUser.';';

        $stmt = $conn->prepare($sql);
        return $stmt->execute();
    }

    public function editMailUser(Int $idUser){
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'Update Utilisateur set verif_mail_utilisateur = 1 where id='.$idUser.';';

        $stmt = $conn->prepare($sql);
        return $stmt->execute();
    }

    public function testSignUp(String $testType, String $valueUser){
        if($testType == 'mail'){
            $verifTest = $this->getUserByEmail($valueUser);
        } else {
            $verifTest = $this->findBy([
                'username' => $valueUser
            ]);
        }

        if($verifTest){
            return true;
        } else {
            return false;
        }
    }

    // /**
    //  * @return Utilisateur[] Returns an array of Utilisateur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Utilisateur
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
