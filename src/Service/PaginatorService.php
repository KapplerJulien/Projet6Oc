<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Config\Definition\Exception\Exception;
use App\Entity\ArticleTriks;
use App\Repository\CommentaireRepository;

class PaginatorService 
{
    public function paginComment(int $paginNumber, ArticleTriks $articleTrik, CommentaireRepository $repositoryComment){  
            return $repositoryComment->getPaginComment($paginNumber, $articleTrik);

    }
}