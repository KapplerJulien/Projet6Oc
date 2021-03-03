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
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder){
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $roles[] = 'ROLE_USER';

        for($i = 0; $i < 8; $i++){

            // User part
            $user = new Utilisateur();
            $pseudo = 'test'.(string)$i;
            $user->setUsername($pseudo);
            $plainPassword = 'password'.(string)$i;
            $encoded = $this->encoder->encodePassword($user, $plainPassword);
            $user->setPassword($encoded);
            $user->setRoles($roles);
            $user->setPhotoUtilisateur('NoPicture.jpg');
            $mailUser = 'test'.(string)$i.'@gmail.com';
            $user->setMailUtilisateur($mailUser);
            $user->setVerifMailUtilisateur(mt_rand(0,1));
            $manager->persist($user);

            // Triksgroup part
            $group = new GroupeTriks();
            $nameGroupArray = array('Grabs', 'Ride', 'Rotations', 'Flips', 'Slides', 'Rotations desaxées', 'Old school', 'One foot triks', );
            $group->setNomGrpTriks($nameGroupArray[$i]);
            $manager->persist($group);
        
            
            // Article part
            $article = new ArticleTriks();
            $articleArray = array(
                'articleName' => array('Le mute','Ride regular', 'Le 720', 'Le front flips', 'Le slide', 'Le misty', 'Old school', 'Le one foot triks',),
                'articleContent' => array(
                    'Un grab consiste à attraper la planche avec la main pendant le saut. Le verbe anglais to grab signifie « attraper. ». Le mute est le saisie de la carre frontside de la planche entre les deux pieds avec la main avant.',
                    'Tout d\'abord, il faut savoir qu\'il y a deux positions sur sa planche: regular ou goofy. Un rider regular aura son pied gauche devant. Un rider regular qui descend en position goofy, dira qu\'il descend « switch ».',
                    'Pour entrer sur une barre de slide, le rideur peut se mettre perpendiculaire à l\'axe de la barre et fera donc un quart de tour en l\'air, modulo 360 degrés — il est possible de faire n tours complets plus un quart de tour. On a donc la dénomination suivante pour ce type de rotations : 450 pour un tour un quart.',
                    'les front flips, rotations en avant. Il est possible de faire plusieurs flips à la suite, et d\'ajouter un grab à la rotation. Les flips agrémentés d\'une vrille existent aussi (Mac Twist, Hakon Flip, ...), mais de manière beaucoup plus rare, et se confondent souvent avec certaines rotations horizontales désaxées. ',
                    'Un slide consiste à glisser sur une barre de slide. Le slide se fait soit avec la planche dans l\'axe de la barre, soit perpendiculaire, soit plus ou moins désaxé. ',
                    'Une rotation désaxée est une rotation initialement horizontale mais lancée avec un mouvement des épaules particulier qui désaxe la rotation. Il existe différents types de rotations désaxées (corkscrew ou cork, rodeo, misty, etc.) en fonction de la manière dont est lancé le buste. Certaines de ces rotations, bien qu\'initialement horizontales, font passer la tête en bas.',
                    'Le terme old school désigne un style de freestyle caractérisée par en ensemble de figure et une manière de réaliser des figures passée de mode, qui fait penser au freestyle des années 1980 - début 1990 (par opposition à new school) :
                    figures désuètes : Japan air, rocket air, ...',
                    'Figures réalisée avec un pied décroché de la fixation, afin de tendre la jambe correspondante pour mettre en évidence le fait que le pied n\'est pas fixé. Ce type de figure est extrêmement dangereuse pour les ligaments du genou en cas de mauvaise réception.',
                ),
            );
            $article->setNomArtTriks($articleArray['articleName'][$i]);
            $article->setContenuArtTriks($articleArray['articleContent'][$i]);
            $date = new \DateTime("now");
            $article->setDateCreationArtTriks($date);
            $article->setDateDerniereModificationArtTriks($date);
            $article->setUtilisateur($user);
            $article->setGroupe($group);
            $article->setSlug($articleArray['articleName'][$i]);
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
            $imageArray = array('gre4gae4g56eg5rg5eg5rgreg85g8r4eg8.jpg','47ef7ezfezfze7fez4faf4ze8fez5ds5f.jpg', 'r4g8rg4re8g48rg4e8r4g8eg4erg4.jpg', 'gg4r7g4eg87g4r8eg4g8erg4erg8.jpg', '59e5fz9f5ez9fez9f5ez9f5ez9f5ezez9f.jpg', 'NoPicture.jpg', 'NoPicture.jpg', '484gregr4egregregegergegeg.png');
            $image->setLienImgTriks($imageArray[$i]);
            $image->setArticle($article);
            $manager->persist($image);

            // Video part
            $video = new VideoTriks();
            $videoArray = array(
                'https://www.youtube.com/embed/CflYbNXZU3Q',
                'https://www.youtube.com/embed/d-VSIhTmYAI',
                'https://www.youtube.com/embed/S2tAZPF7PCk',
                'https://www.youtube.com/embed/gMfmjr-kuOg',
                'https://www.youtube.com/embed/WOgw5uBSLp0',
                'https://www.youtube.com/embed/hPuVJkw1MmI',
                'https://www.youtube.com/embed/mTFMakbP0xw',
                'https://www.youtube.com/embed/4IVdWdvsrVA',
            );
            $video->setLienVidTriks($videoArray[$i]);
            $video->setArticle($article);
            $manager->persist($video);
        }

        $manager->flush();
    }
}
