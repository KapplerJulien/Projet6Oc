<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\ArticleTriks;
use App\Entity\ImageTriks;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class HomeController extends AbstractController 
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("/home", name="home")
     */
    public function home(Request $request): Response
    {
        // Var
        $paginator_per_page = 5 + $request->query->getInt('paginator_per_page', 0);
        $imagesArt = array();
        $i = 1;
        $repositoryArticles = $this->getDoctrine()->getRepository(ArticleTriks::class);
        $repositoryImage = $this->getDoctrine()->getRepository(ImageTriks::class);

        // Collect articles from the Database 
        $paginArticles = $repositoryArticles->getPaginArticle($paginator_per_page);

        // Collect image from the Database
        foreach($paginArticles as $article){
            // var_dump($article->getId());
            $imageArt[$i] = $repositoryImage->getImgByArticle($article);
            // var_dump($imageArt[$i][0]);
            $i ++;
        }

        $user = $this->session->get('user');

        return $this->render('home/home.html.twig', [
            "articles" => $paginArticles,
            "next" => min(count($paginArticles), $paginator_per_page),
            "user" => $user,
            "imageArt" => $imageArt,
        ]);
    }
}