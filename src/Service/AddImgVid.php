<?php
// src/Service/FileUploader.php
namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use App\Service\FileUploader;
use App\Entity\ArticleTriks;
use App\Entity\ImageTriks;
use App\Entity\VideoTriks;


class AddImgVid
{
    public function __construct()
    {
    }

    public function addImages(ArticleTriks $articleTrik, Array $imagesTriksForm, FileUploader $fileUploader, String $route){
        $imageTriks = new ImageTriks();
        // On boucle sur les images 
        foreach($imagesTriksForm as $imageTriksForm){
            /** @var UploadedFile $imageTriksForm */
            $imageFileName = $fileUploader->upload($imageTriksForm);

            if($route == 'edit'){
                $articleImages = $articleTrik->getImageTriks();
                if($articleImages[0]->getLienImgTriks() == 'NoPicture.jpg'){
                    $articleImages[0]->setLienImgTriks($imageFileName);
                    $articleTrik->addImageTrik( $articleImages[0]);
                } else {
                    $imageTriks->setLienImgTriks($imageFileName);
                    $articleTrik->addImageTrik($imageTriks);
                }
            } else {
                    $imageTriks->setLienImgTriks($imageFileName);
                    $articleTrik->addImageTrik($imageTriks);
            }
        }
        return $articleTrik;
    }

    public function addVideos(ArticleTriks $articleTrik, Array $videosTriks){
        foreach($videosTriks as $videoTriks){
            // On stock l'image dans la BDD (son nom)
            // var_dump($videoTriks);
            // $repositoryVideo->addVideo($videoTriks, $articleTrik->getId() );
            $videoTriksArticle = new VideoTriks();
            $videoTriksArticle->setLienVidTriks($videoTriks);
            $articleTrik->addVideoTrik($videoTriksArticle);
        }
        return $articleTrik;
    }
}