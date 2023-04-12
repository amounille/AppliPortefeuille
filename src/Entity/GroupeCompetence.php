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
     * @ORM\ManyToMany(targetEntity=Portefeuille::class, inversedBy="groupeCompetences")
     */
    private $Portefeuilles;

    /**
     * @ORM\OneToMany(targetEntity=Competence::class, mappedBy="Groupe_competences")
     */
    private $competences;

    public function __construct()
    {
        $this->Portefeuilles = new ArrayCollection();
        $this->competences = new ArrayCollection();
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
     * @return Collection<int, Portefeuille>
     */
    public function getPortefeuilles(): Collection
    {
        return $this->Portefeuilles;
    }

    public function addPortefeuille(Portefeuille $portefeuille): self
    {
        if (!$this->Portefeuilles->contains($portefeuille)) {
            $this->Portefeuilles[] = $portefeuille;
        }

        return $this;
    }

    public function removePortefeuille(Portefeuille $portefeuille): self
    {
        $this->Portefeuilles->removeElement($portefeuille);

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
}
