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
    private $pseudo;

    /**
     * @ORM\Column(type="text")
     */
    private $mdp;

    /**
     * @ORM\Column(type="text")
     */
    private $role;

    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="utilisateur")
     */
    private $poster;

    /**
     * @ORM\OneToMany(targetEntity=Article::class, mappedBy="auteur")
     */
    private $ecrire;

    public function __construct()
    {
        $this->poster = new ArrayCollection();
        $this->ecrire = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): self
    {
        $this->mdp = $mdp;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return Collection|Commentaire[]
     */
    public function getPoster(): Collection
    {
        return $this->poster;
    }

    public function addPoster(Commentaire $poster): self
    {
        if (!$this->poster->contains($poster)) {
            $this->poster[] = $poster;
            $poster->setUtilisateur($this);
        }

        return $this;
    }

    public function removePoster(Commentaire $poster): self
    {
        if ($this->poster->removeElement($poster)) {
            // set the owning side to null (unless already changed)
            if ($poster->getUtilisateur() === $this) {
                $poster->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Article[]
     */
    public function getEcrire(): Collection
    {
        return $this->ecrire;
    }

    public function addEcrire(Article $ecrire): self
    {
        if (!$this->ecrire->contains($ecrire)) {
            $this->ecrire[] = $ecrire;
            $ecrire->setAuteur($this);
        }

        return $this;
    }

    public function removeEcrire(Article $ecrire): self
    {
        if ($this->ecrire->removeElement($ecrire)) {
            // set the owning side to null (unless already changed)
            if ($ecrire->getAuteur() === $this) {
                $ecrire->setAuteur(null);
            }
        }

        return $this;
    }
}
