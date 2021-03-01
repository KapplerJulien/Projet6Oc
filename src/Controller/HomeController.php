<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\ArticleTriks;
use App\Entity\ImageTriks;
use Doctrine\ORM\EntityManagerInterface;


class HomeController extends AbstractController 
{
    public function __construct()
    {
    }

    /**
     * @Route("/home", name="home")
     */
    public function home(Request $request): Response
    {
        // Var
        $paginator_per_page = 5 + $request->query->getInt('paginator_per_page', 0);
        $i = 1;
        $repositoryArticles = $this->getDoctrine()->getRepository(ArticleTriks::class);

        // Collect articles from the Database 
        $paginArticles = $repositoryArticles->getPaginArticle($paginator_per_page);

        return $this->render('home/home.html.twig', [
            "articles" => $paginArticles,
            "next" => min(count($paginArticles), $paginator_per_page),
        ]);
    }
}