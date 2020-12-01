<?php

namespace App\Entity;

use App\Repository\ImageTriksRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImageTriksRepository::class)
 */
class ImageTriks
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $LienImgTriks;

    /**
     * @ORM\ManyToOne(targetEntity=ArticleTriks::class, inversedBy="imageTriks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Article;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLienImgTriks(): ?string
    {
        return $this->LienImgTriks;
    }

    public function setLienImgTriks(string $LienImgTriks): self
    {
        $this->LienImgTriks = $LienImgTriks;

        return $this;
    }

    public function getArticle(): ?ArticleTriks
    {
        return $this->Article;
    }

    public function setArticle(?ArticleTriks $Article): self
    {
        $this->Article = $Article;

        return $this;
    }
}
