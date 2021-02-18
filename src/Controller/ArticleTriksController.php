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
use App\Service\FileUploader;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

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
     * 
     * @IsGranted("ROLE_USER")
     */
    public function new(Request $request, FileUploader $fileUploader): Response
    {
        $articleTrik = new ArticleTriks();
        $imageTriks = new ImageTriks();
        $repositoryImage = $this->getDoctrine()->getRepository(ImageTriks::class);
        $repositoryVideo = $this->getDoctrine()->getRepository(VideoTriks::class);

        $form = $this->createForm(ArticleTriksType::class, $articleTrik);
        $form->handleRequest($request);

        $userIdSession = $this->session->get('userId');

        if ($form->isSubmitted() && $form->isValid()) {
            // On récupère les images transmises
            $imagesTriksForm = $form->get('LienImgTriks')->getData();
            $videosTriks = $form->get('videoTriks')->getData();
            $groupeTriks = $form->get('Groupe')->getData();
            $repositoryUser = $this->getDoctrine()->getRepository(Utilisateur::class);

            $repositoryArticle = $this->getDoctrine()->getRepository(ArticleTriks::class);
            // $result = $repositoryArticle->addArticle($articleTrik, $user[0]->getId(), $groupeTriks->getId());

            // var_dump($articleTrik->getImageTriks());
        
            // $maxIdArticle = $repositoryArticle->getMaxId();
            // var_dump($maxIdArticle[0]['max_id']);

            // var_dump($imagesTriks);
                
            // $articleTrik->setUtilisateur($user);
            // $user = $repositoryUser->getUserById($userIdSession);
            /** @var \App\Entity\Utilisateur $user */
            $user = $this->getUser();
            $articleTrik->setUtilisateur($user);
            $articleTrik->setGroupe($groupeTriks);

            // var_dump($imagesTriks);


            /*var_dump($user->getId());

            $varUser = $articleTrik->getUtilisateur();
            var_dump($varUser->getId()); */
                
            if(!empty($imagesTriksForm) && $imagesTriksForm != NULL){
                // On boucle sur les images 

                foreach($imagesTriksForm as $imageTriksForm){
                    /** @var UploadedFile $imageTriksForm */
                    $imageFileName = $fileUploader->upload($imageTriksForm);
    
                    // On stock l'image dans la BDD (son nom)
                    // $repositoryuImage->addImage($fichier,$maxIdArticle[0]['max_id'] );
    
                    // var_dump($imageTriks);
    
                    $imageTriks->setLienImgTriks($imageFileName);
                    $articleTrik->addImageTrik($imageTriks);
                } 
    
            } else {
                $imageTriks->setLienImgTriks('NoPicture.jpg');
                $articleTrik->addImageTrik($imageTriks);
            }

                
            // var_dump($videosTriks);
            foreach($videosTriks as $videoTriks){
                // On stock l'image dans la BDD (son nom)
                // $repositoryVideo->addVideo($videoTriks,$maxIdArticle[0]['max_id'] );
                $videoTriksArticle = new VideoTriks();
                $videoTriksArticle->setLienVidTriks($videoTriks);
                $articleTrik->addVideoTrik($videoTriksArticle);
            } 

            $date = new \DateTime("now");
            $articleTrik->setDateCreationArtTriks($date);
            $articleTrik->setDateDerniereModificationArtTriks($date);

            // var_dump($user->getId());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($articleTrik);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('article_triks/new.html.twig', [
            'article_trik' => $articleTrik,
            'form' => $form->createView(),
            'user' => $userIdSession,
        ]);
    }

    /**
     * @Route("article/{id}", name="article_triks_show", methods={"GET", "POST"}, requirements={"id":"\d+"})
     */
    public function show(ArticleTriks $articleTrik, Request $request): Response
    {
        // Var
        $repositoryVideos = $this->getDoctrine()->getRepository(VideoTriks::class);
        $repositoryImage = $this->getDoctrine()->getRepository(ImageTriks::class);
        $repositoryComment = $this->getDoctrine()->getRepository(Commentaire::class);
        $repositoryGroup = $this->getDoctrine()->getRepository(GroupeTriks::class);
        $repositoryUser = $this->getDoctrine()->getRepository(Utilisateur::class);

        $paginator_per_page = 2 + $request->query->getInt('paginator_per_page', 0);

        $commentsUser = array();
        $i = 1;

        // Collect images by article
        $images = $articleTrik->getImageTriks();

        // Collect videos by article
        $videos = $articleTrik->getVideoTriks();

        // Collect group by article
        $group = $articleTrik->getGroupe();

        // Collect comments by article
        // $comments = $repositoryComment->getCommentsByArticle($articleTrik);
        $comments = $repositoryComment->getPaginComment($paginator_per_page, $articleTrik);

        return $this->render('article_triks/show.html.twig', [
            'article_trik' => $articleTrik,
            'videos_triks' => $videos,
            'images_triks' => $images,
            'group_triks' => $group,
            'comments_triks' => $comments,
            "next" => min(count($comments), $paginator_per_page),
        ]);
    }
}
