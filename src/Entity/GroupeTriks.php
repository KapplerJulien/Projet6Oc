<?php

namespace App\Entity;

use App\Repository\GroupeTriksRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GroupeTriksRepository::class)
 */
class GroupeTriks
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
    private $NomGrpTriks;

    /**
     * @ORM\OneToMany(targetEntity=ArticleTriks::class, mappedBy="Groupe", orphanRemoval=true)
     */
    private $articleTriks;

    public function __construct()
    {
        $this->articleTriks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomGrpTriks(): ?string
    {
        return $this->NomGrpTriks;
    }

    public function setNomGrpTriks(string $NomGrpTriks): self
    {
        $this->NomGrpTriks = $NomGrpTriks;

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
            $articleTrik->setGroupe($this);
        }

        return $this;
    }

    public function removeArticleTrik(ArticleTriks $articleTrik): self
    {
        if ($this->articleTriks->removeElement($articleTrik)) {
            // set the owning side to null (unless already changed)
            if ($articleTrik->getGroupe() === $this) {
                $articleTrik->setGroupe(null);
            }
        }

        return $this;
    }
}
