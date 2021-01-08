<?php

namespace App\Controller;

use App\Entity\ArticleTriks;
use App\Form\ArticleTriksType;
use App\Repository\ArticleTriksRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\Tools\Pagination\Paginator;
use App\Entity\ImageTriks;
use App\Entity\VideoTriks;
use App\Entity\Commentaire;
use App\Entity\GroupeTriks;
use App\Entity\Utilisateur;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * @Route("/article/triks")
 */
class ArticleTriksController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("article/new", name="article_triks_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $articleTrik = new ArticleTriks();
        $repositoryGroup = $this->getDoctrine()->getRepository(GroupeTriks::class);
        $repositoryImage = $this->getDoctrine()->getRepository(ImageTriks::class);
        $repositoryVideo = $this->getDoctrine()->getRepository(VideoTriks::class);
        $form = $this->createForm(ArticleTriksType::class, $articleTrik);
        $form->handleRequest($request);
        $user = $this->session->get('user');

        if ($form->isSubmitted() && $form->isValid()) {
            // On récupère les images transmises
            $imagesTriks = $form->get('imageTriks')->getData();
            $videosTriks = $form->get('videoTriks')->getData();
            $groupeTriks = $form->get('Groupe')->getData();
            $repositoryUser = $this->getDoctrine()->getRepository(Utilisateur::class);

            $repositoryArticle = $this->getDoctrine()->getRepository(ArticleTriks::class);
            $result = $repositoryArticle->addArticle($articleTrik, $user[0]->getId(), $groupeTriks->getId());
        
            $maxIdArticle = $repositoryArticle->getMaxId();
            // var_dump($maxIdArticle[0]['max_id']);

            // On boucle sur les images 
            foreach($imagesTriks as $imageTriks){
                // On génère un nouveau nom de fichier
                $fichier = md5(uniqid()) . '.' . $imageTriks->guessExtension();

                // On copie le fichier dans le dossier uploads
                $imageTriks->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );

                // On stock l'image dans la BDD (son nom)
                $repositoryImage->addImage($fichier,$maxIdArticle[0]['max_id'] );
            }

            foreach($videosTriks as $videoTriks){
                // On stock l'image dans la BDD (son nom)
                $repositoryVideo->addVideo($videoTriks,$maxIdArticle[0]['max_id'] );
            }

            // var_dump($user->getId());

            return $this->redirectToRoute('home');
        }

        $groupDB = $repositoryGroup->getAllGroup();

        return $this->render('article_triks/new.html.twig', [
            'article_trik' => $articleTrik,
            'form' => $form->createView(),
            'user' => $user,
            'groups' => $groupDB,
        ]);
    }
}
