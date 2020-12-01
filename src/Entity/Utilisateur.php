<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UtilisateurRepository::class)
 */
class Utilisateur
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
    private $PhotoUtilisateur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $MailUtilisateur;

    /**
     * @ORM\Column(type="boolean")
     */
    private $VerifMailUtilisateur;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $PseudoUtilisateur;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $MdpUtilisateur;

    /**
     * @ORM\OneToMany(targetEntity=ArticleTriks::class, mappedBy="Utilisateur", orphanRemoval=true)
     */
    private $articleTriks;

    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="Utilisateur", orphanRemoval=true)
     */
    private $commentaires;

    public function __construct()
    {
        $this->articleTriks = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhotoUtilisateur(): ?string
    {
        return $this->PhotoUtilisateur;
    }

    public function setPhotoUtilisateur(string $PhotoUtilisateur): self
    {
        $this->PhotoUtilisateur = $PhotoUtilisateur;

        return $this;
    }

    public function getMailUtilisateur(): ?string
    {
        return $this->MailUtilisateur;
    }

    public function setMailUtilisateur(string $MailUtilisateur): self
    {
        $this->MailUtilisateur = $MailUtilisateur;

        return $this;
    }

    public function getVerifMailUtilisateur(): ?bool
    {
        return $this->VerifMailUtilisateur;
    }

    public function setVerifMailUtilisateur(bool $VerifMailUtilisateur): self
    {
        $this->VerifMailUtilisateur = $VerifMailUtilisateur;

        return $this;
    }

    public function getPseudoUtilisateur(): ?string
    {
        return $this->PseudoUtilisateur;
    }

    public function setPseudoUtilisateur(string $PseudoUtilisateur): self
    {
        $this->PseudoUtilisateur = $PseudoUtilisateur;

        return $this;
    }

    public function getMdpUtilisateur(): ?string
    {
        return $this->MdpUtilisateur;
    }

    public function setMdpUtilisateur(string $MdpUtilisateur): self
    {
        $this->MdpUtilisateur = $MdpUtilisateur;

        return $this;
    }

    /**
     * @return Collection|ArticleTriks[]
     */
    public function getArticleTriks(): Collection
    {
        return $this->articleTriks;
    }

    public function addArticleTrik(ArticleTriks $articleTrik): self
    {
        if (!$this->articleTriks->contains($articleTrik)) {
            $this->articleTriks[] = $articleTrik;
            $articleTrik->setUtilisateur($this);
        }

        return $this;
    }

    public function removeArticleTrik(ArticleTriks $articleTrik): self
    {
        if ($this->articleTriks->removeElement($articleTrik)) {
            // set the owning side to null (unless already changed)
            if ($articleTrik->getUtilisateur() === $this) {
                $articleTrik->setUtilisateur(null);
            }
        }

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
            $commentaire->setUtilisateur($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getUtilisateur() === $this) {
                $commentaire->setUtilisateur(null);
            }
        }

        return $this;
    }
}
