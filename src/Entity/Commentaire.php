<?php

namespace App\Entity;

use App\Repository\CommentaireRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentaireRepository::class)
 */
class Commentaire
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
    private $ContenuCommentaire;

    /**
     * @ORM\Column(type="date")
     */
    private $DateCommentaire;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="commentaires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Utilisateur;

    /**
     * @ORM\ManyToOne(targetEntity=ArticleTriks::class, inversedBy="commentaires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Article;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenuCommentaire(): ?string
    {
        return $this->ContenuCommentaire;
    }

    public function setContenuCommentaire(string $ContenuCommentaire): self
    {
        $this->ContenuCommentaire = $ContenuCommentaire;

        return $this;
    }

    public function getDateCommentaire(): ?\DateTimeInterface
    {
        return $this->DateCommentaire;
    }

    public function setDateCommentaire(\DateTimeInterface $DateCommentaire): self
    {
        $this->DateCommentaire = $DateCommentaire;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->Utilisateur;
    }

    public function setUtilisateur(?Utilisateur $Utilisateur): self
    {
        $this->Utilisateur = $Utilisateur;

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
