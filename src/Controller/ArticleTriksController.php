<?php

namespace App\Controller;

use App\Entity\ArticleTriks;
use App\Form\ArticleTriksType;
use App\Form\CommentType;
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
use App\Entity\Utilisateur;;
use App\Service\FileUploader;
use App\Service\AddImgVid;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/article/triks")
 */
class ArticleTriksController extends AbstractController
{

    public function __construct()
    {
    }

    /**
     * @Route("article/new", name="article_triks_new", methods={"GET","POST"})
     * 
     * @IsGranted("ROLE_USER")
     */
    public function new(Request $request, FileUploader $fileUploader, AddImgVid $addImgVid): Response
    {
        $articleTrik = new ArticleTriks();
        $imageTriks = new ImageTriks();
        $repositoryImage = $this->getDoctrine()->getRepository(ImageTriks::class);
        $repositoryVideo = $this->getDoctrine()->getRepository(VideoTriks::class);

        $form = $this->createForm(ArticleTriksType::class, $articleTrik);
        $form->handleRequest($request);

        /** @var \App\Entity\Utilisateur $user */
        $user = $this->getUser();

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
            $articleTrik->setUtilisateur($user);
            $articleTrik->setGroupe($groupeTriks);

            $articleTrik->setSlug($articleTrik->getNomArtTriks());

            // var_dump($imagesTriks);


            /*var_dump($user->getId());

            $varUser = $articleTrik->getUtilisateur();
            var_dump($varUser->getId()); */
            if(!empty($imagesTriksForm) && $imagesTriksForm != NULL){
                /** @var ArticleTriks $articleTrik, @var Array $imagesTriksForm, @var FileUploader $fileUploader, @var String $route */
                $articleTrik = $addImgVid->addImages($articleTrik, $imagesTriksForm, $fileUploader, 'new');    
            } else {
                $imageTriks->setLienImgTriks('NoPicture.jpg');
                $articleTrik->addImageTrik($imageTriks);
            }

                
            // var_dump($videosTriks);
            foreach($videosTriks as $videoTriks){
                /** @var ArticleTriks $articleTrik, @var Array $videosTriks */
                $articleTrik = $addImgVid->addVideos($articleTrik, $videosTriks);
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
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{slug}/show/", name="article_triks_show", methods={"GET", "POST"})
     */
    public function show(Request $request, ArticleTriks $articleTrik): Response
    {
        $paginator_per_page = 2 + $request->query->getInt('paginator_per_page', 0);
        $repositoryComment = $this->getDoctrine()->getRepository(Commentaire::class);
        $commentsUser = array();
        $i = 1;

        // Collect comments by article
        // $comments = $repositoryComment->getCommentsByArticle($articleTrik);
        $comments = $repositoryComment->getPaginComment($paginator_per_page, $articleTrik);

        /** @var \App\Entity\Utilisateur $user */
        $user = $this->getUser();
          
        if($user != NULL && !empty($user)){
            $newComment = new Commentaire();

            $form = $this->createForm(CommentType::class, $newComment);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                // $repositoryComment->addComment($newComment, $user[0]->getId(), $articleTrik->getId());
                $newComment->setArticle($articleTrik);
                $newComment->setUtilisateur($user);

                $date = new \DateTime("now");
                $newComment->setDateCommentaire($date);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($newComment);
                $entityManager->flush();

                return $this->redirectToRoute('article_triks_show', [ 'id' => $articleTrik->getId() ]);
            }
            return $this->render('article_triks/show.html.twig', [
                'article_trik' => $articleTrik,
                'comments_triks' => $comments,
                'user' => $user,
                'form' => $form->createView(),
                "next" => min(count($comments), $paginator_per_page),
            ]);
        }

        return $this->render('article_triks/show.html.twig', [
            'article_trik' => $articleTrik,
            'comments_triks' => $comments,
            "next" => min(count($comments), $paginator_per_page),
        ]);
    }

    /**
     * @Route("/{slug}/edit/", name="article_triks_edit", methods={"GET","POST"})
     * 
     * @IsGranted("ROLE_USER")
     */
    public function edit(Request $request, ArticleTriks $articleTrik, FileUploader $fileUploader, AddImgVid $addImgVid): Response
    {
            $form = $this->createForm(ArticleTriksType::class, $articleTrik);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $imagesTriks = $form->get('LienImgTriks')->getData();
                $videosTriks = $form->get('videoTriks')->getData();
                $groupeTriks = $form->get('Groupe')->getData();

                $articleImages = $articleTrik->getImageTriks();
                if($articleImages[0] == NULL && empty($imagesTriks)){
                    $imageTriksArticleEmpty = new ImageTriks();
                    $imageTriksArticleEmpty->setLienImgTriks('NoPicture.jpg');
                    $articleTrik->addImageTrik($imageTriksArticleEmpty);
                }
                foreach($articleImages as $articleImage){
                    if(!empty($request->files->get('image_'.$articleImage->getId())) ){
                        // var_dump('Je suis dans le if avec l"id'.$articleImage->getId());
                        $nom = $articleImage->getLienImgTriks();
                        unlink($this->getParameter('images_directory').'/'.$nom);

                        $imageFile = $request->files->get('image_'.$articleImage->getId());
                        /** @var UploadedFile $imageFile */
                        $imageFileName = $fileUploader->upload($imageFile);

                        $articleImage->setLienImgTriks($imageFileName);
                        $articleTrik->addImageTrik($articleImage);
                    }
                }

                $articleVideos = $articleTrik->getVideoTriks();
                foreach($articleVideos as $articleVideo){
                    if(!empty($request->request->get('video_'.$articleVideo->getId())) ){

                        $videoName = $request->request->get('video_'.$articleVideo->getId());

                        $articleVideo->setLienVidTriks($videoName);
                        $articleTrik->addVideoTrik($articleVideo);
                    }
                }

                /* $imageEditTriks = $request->getParameter('article_triks_image_update');
                var_dump($imageEditTriks); */

                // var_dump($imagesTriks);
                // var_dump($videosTriks);
                // var_dump($groupeTriks->getId());

                if(!empty($imagesTriks)){
                    /** @var ArticleTriks $articleTrik, @var Array $imagesTriksForm, @var FileUploader $fileUploader, @var String $route */
                    $articleTrik = $addImgVid->addImages($articleTrik, $imagesTriks, $fileUploader, 'edit');
                }

                if(!empty($videosTriks)){
                    /** @var ArticleTriks $articleTrik, @var Array $videosTriks */
                    $articleTrik = $addImgVid->addVideos($articleTrik, $videosTriks);
                }

                
                // $repositoryArticle = $this->getDoctrine()->getRepository(ArticleTriks::class);
                // $result = $repositoryArticle->editArticle($articleTrik, $groupeTriks->getId());
                $articleTrik->setSlug($articleTrik->getNomArtTriks());

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($articleTrik);
                $entityManager->flush();
                

                return $this->redirectToRoute('home');
            }

            return $this->render('article_triks/edit.html.twig', [
                'article_trik' => $articleTrik,
                'form' => $form->createView(),
            ]);
    }

    /**
     * @Route("/delete/image/{id}", name="article_triks_delete_image", methods={"DELETE"})
     * 
     * @IsGranted("ROLE_USER")
     */
    public function deleteImage(ImageTriks $image, Request $request){
        $data = json_decode($request->getContent(), true);

        // On vérifie si le token est valide
        if($this->isCsrfTokenValid('delete'.$image->getId(), $data['_token'])){
            // On récupère le nom de l'image et en dessous on supprime le fichier
            $name = $image->getLienImgTriks();
            unlink($this->getParameter('images_directory').'/'.$name);

            // On supprime l'entrée de la base
            $em = $this->getDoctrine()->getManager();
            $em->remove($image);
            $em->flush();

            // On répond en json
            return new JsonResponse(['success' => 1]);
        } else {
            return new JsonResponse(['error' => 'Token Invalide'], 400);
        }
    }

    /**
     * @Route("/delete/video/{id}", name="article_triks_delete_video", methods={"DELETE"})
     * 
     * @IsGranted("ROLE_USER")
     */
    public function deleteVideo(VideoTriks $video, Request $request){
        $data = json_decode($request->getContent(), true);

        // On vérifie si le token est valide
        if($this->isCsrfTokenValid('delete'.$video->getId(), $data['_token'])){
            // On supprime l'entrée de la base
            $em = $this->getDoctrine()->getManager();
            $em->remove($video);
            $em->flush();

            // On répond en json
            return new JsonResponse(['success' => 1]);
        } else {
            return new JsonResponse(['error' => 'Token Invalide'], 400);
        }
    }

    /**
     * @Route("/{slug}", name="article_triks_delete", methods={"DELETE"})
     * 
     * @IsGranted("ROLE_USER")
     */
    public function delete(Request $request, ArticleTriks $articleTrik): Response
    {
        if ($this->isCsrfTokenValid('delete'.$articleTrik->getId(), $request->request->get('_token'))) {
            // delete img and video
            $repositoryImage = $this->getDoctrine()->getRepository(ImageTriks::class);
            $repositoryVideo = $this->getDoctrine()->getRepository(VideoTriks::class);
            $repositoryComment = $this->getDoctrine()->getRepository(Commentaire::class);

            $entityManager = $this->getDoctrine()->getManager();

            $images = $articleTrik->getImageTriks();
            // $images = $repositoryImage->removeImageByArticle($articleTrik);
            foreach($images as $image){
                if($image->getLienImgTriks() != 'NoPicture.jpg'){
                    $nom = $image->getLienImgTriks();
                    unlink($this->getParameter('images_directory').'/'.$nom);
                }
            }

            $comments = $articleTrik->getCommentaires();
            foreach($comments as $comment){
                $entityManager->remove($comment);
                $entityManager->flush();
            }

            $entityManager->remove($articleTrik);
            $entityManager->flush();
        }

        return $this->redirectToRoute('home');
    }
}
