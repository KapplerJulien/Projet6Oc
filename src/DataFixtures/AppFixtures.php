<?php

namespace App\DataFixtures;

use App\Entity\Utilisateur;
use App\Entity\GroupeTriks;
use App\Entity\ArticleTriks;
use App\Entity\Commentaire;
use App\Entity\ImageTriks;
use App\Entity\VideoTriks;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Validator\Constraints\Date;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        for($i = 0; $i < 10; $i++){

            // User part
            $user = new Utilisateur();
            $user->setPhotoUtilisateur('NoPicture.png');
            $mailUser = 'test'.(string)$i.'@gmail.com';
            $user->setMailUtilisateur($mailUser);
            $user->setVerifMailUtilisateur(mt_rand(0,1));
            $pseudo = 'test'.(string)$i;
            $user->setPseudoUtilisateur($pseudo);
            $password = 'password'.(string)$i;
            $user->setMdpUtilisateur($password);
            $manager->persist($user);

            // Triksgroup part
            $group = new GroupeTriks();
            $nameGroup = 'testGroup'.(string)$i;
            $group->setNomGrpTriks($nameGroup);
            $manager->persist($group);

            // Article part
            $article = new ArticleTriks();
            $nameArticle = 'testArticle'.(string)$i;
            $article->setNomArtTriks($nameArticle);
            $article->setContenuArtTriks('contenuArticle'.(string)$i);
            $date = new \DateTime("now");
            $article->setDateCreationArtTriks($date);
            $article->setDateDerniereModificationArtTriks($date);
            $article->setUtilisateur($user);
            $article->setGroupe($group);
            $manager->persist($article);

            // Comments part
            $comment = new Commentaire();
            $comment->setContenuCommentaire('ContenuCommentaire'.(string)$i);
            $comment->setDateCommentaire($date);
            $comment->setUtilisateur($user);
            $comment->setArticle($article);
            $manager->persist($comment);

            // Image part
            $image = new ImageTriks();
            $image->setLienImgTriks('img'.(string)$i);
            $image->setArticle($article);
            $manager->persist($image);

            // Video part
            $video = new VideoTriks();
            $video->setLienVidTriks('video'.(string)$i);
            $video->setArticle($article);
            $manager->persist($video);
        }

        $manager->flush();
    }
}
