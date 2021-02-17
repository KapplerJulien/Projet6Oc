<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UtilisateurRepository::class)
 */
class Utilisateur implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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
