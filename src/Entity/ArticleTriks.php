<?php

namespace App\Entity;

use App\Repository\ArticleTriksRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleTriksRepository::class)
 */
class ArticleTriks
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
    private $NomArtTriks;

    /**
     * @ORM\Column(type="string", length=5000)
     */
    private $ContenuArtTriks;

    /**
     * @ORM\Column(type="date")
     */
    private $DateCreationArtTriks;

    /**
     * @ORM\Column(type="date")
     */
    private $DateDerniereModificationArtTriks;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="articleTriks", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Utilisateur;

    /**
     * @ORM\ManyToOne(targetEntity=GroupeTriks::class, inversedBy="articleTriks", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Groupe;

    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="Article")
     */
    private $commentaires;

    /**
     * @ORM\OneToMany(targetEntity=ImageTriks::class, mappedBy="Article", orphanRemoval=true, cascade={"persist"})
     */
    private $imageTriks;

    /**
     * @ORM\OneToMany(targetEntity=VideoTriks::class, mappedBy="Article", orphanRemoval=true, cascade={"persist"})
     */
    private $videoTriks;

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
        $this->imageTriks = new ArrayCollection();
        $this->videoTriks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomArtTriks(): ?string
    {
        return $this->NomArtTriks;
    }

    public function setNomArtTriks(string $NomArtTriks): self
    {
        $this->NomArtTriks = $NomArtTriks;

        return $this;
    }

    public function getContenuArtTriks(): ?string
    {
        return $this->ContenuArtTriks;
    }

    public function setContenuArtTriks(string $ContenuArtTriks): self
    {
        $this->ContenuArtTriks = $ContenuArtTriks;

        return $this;
    }

    public function getDateCreationArtTriks(): ?\DateTimeInterface
    {
        return $this->DateCreationArtTriks;
    }

    public function setDateCreationArtTriks(\DateTimeInterface $DateCreationArtTriks): self
    {
        $this->DateCreationArtTriks = $DateCreationArtTriks;

        return $this;
    }

    public function getDateDerniereModificationArtTriks(): ?\DateTimeInterface
    {
        return $this->DateDerniereModificationArtTriks;
    }

    public function setDateDerniereModificationArtTriks(\DateTimeInterface $DateDerniereModificationArtTriks): self
    {
        $this->DateDerniereModificationArtTriks = $DateDerniereModificationArtTriks;

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

    public function getGroupe(): ?GroupeTriks
    {
        return $this->Groupe;
    }

    public function setGroupe(?GroupeTriks $Groupe): self
    {
        $this->Groupe = $Groupe;

        return $this;
    }

    /**
     * @return Collection|Commentaire[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setArticle($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getArticle() === $this) {
                $commentaire->setArticle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ImageTriks[]
     */
    public function getImageTriks(): Collection
    {
        return $this->imageTriks;
    }

    public function addImageTrik(ImageTriks $imageTrik): self
    {
        if (!$this->imageTriks->contains($imageTrik)) {
            $this->imageTriks[] = $imageTrik;
            $imageTrik->setArticle($this);
        }

        return $this;
    }

    public function removeImageTrik(ImageTriks $imageTrik): self
    {
        if ($this->imageTriks->removeElement($imageTrik)) {
            // set the owning side to null (unless already changed)
            if ($imageTrik->getArticle() === $this) {
                $imageTrik->setArticle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|VideoTriks[]
     */
    public function getVideoTriks(): Collection
    {
        return $this->videoTriks;
    }

    public function addVideoTrik(VideoTriks $videoTrik): self
    {
        if (!$this->videoTriks->contains($videoTrik)) {
            $this->videoTriks[] = $videoTrik;
            $videoTrik->setArticle($this);
        }

        return $this;
    }

    public function removeVideoTrik(VideoTriks $videoTrik): self
    {
        if ($this->videoTriks->removeElement($videoTrik)) {
            // set the owning side to null (unless already changed)
            if ($videoTrik->getArticle() === $this) {
                $videoTrik->setArticle(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->NomArtTriks;
    }
}
