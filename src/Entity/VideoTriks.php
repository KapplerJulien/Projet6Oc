<?php

namespace App\Entity;

use App\Repository\VideoTriksRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VideoTriksRepository::class)
 */
class VideoTriks
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
    private $LienVidTriks;

    /**
     * @ORM\ManyToOne(targetEntity=ArticleTriks::class, inversedBy="videoTriks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Article;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLienVidTriks(): ?string
    {
        return $this->LienVidTriks;
    }

    public function setLienVidTriks(string $LienVidTriks): self
    {
        $this->LienVidTriks = $LienVidTriks;

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
