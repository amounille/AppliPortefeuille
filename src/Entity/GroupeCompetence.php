<?php

namespace App\Entity;

use App\Repository\GroupeCompetenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GroupeCompetenceRepository::class)
 */
class GroupeCompetence
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
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Competence::class, mappedBy="groupeCompetences")
     */
    private $competences;

    /**
     * @ORM\ManyToMany(targetEntity=Portefeuille::class, inversedBy="groupeCompetences")
     */
    private $portefeuilles;

    public function __construct()
    {
        $this->competences = new ArrayCollection();
        $this->portefeuilles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, Competence>
     */
    public function getCompetences(): Collection
    {
        return $this->competences;
    }

    public function addCompetence(Competence $competence): self
    {
        if (!$this->competences->contains($competence)) {
            $this->competences[] = $competence;
            $competence->setGroupeCompetences($this);
        }

        return $this;
    }

    public function removeCompetence(Competence $competence): self
    {
        if ($this->competences->removeElement($competence)) {
            // set the owning side to null (unless already changed)
            if ($competence->getGroupeCompetences() === $this) {
                $competence->setGroupeCompetences(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Portefeuille>
     */
    public function getPortefeuilles(): Collection
    {
        return $this->portefeuilles;
    }

    public function addPortefeuille(Portefeuille $portefeuille): self
    {
        if (!$this->portefeuilles->contains($portefeuille)) {
            $this->portefeuilles[] = $portefeuille;
        }

        return $this;
    }

    public function removePortefeuille(Portefeuille $portefeuille): self
    {
        $this->portefeuilles->removeElement($portefeuille);

        return $this;
    }
}
