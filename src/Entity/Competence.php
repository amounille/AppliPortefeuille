<?php

namespace App\Entity;

use App\Repository\CompetenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompetenceRepository::class)
 */
class Competence
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
     * @ORM\ManyToOne(targetEntity=GroupeCompetence::class, inversedBy="competences")
     */
    private $Groupe_competences;

    /**
     * @ORM\ManyToMany(targetEntity=Situation::class, mappedBy="competences")
     */
    private $situations;

    public function __construct()
    {
        $this->situations = new ArrayCollection();
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

    public function getGroupeCompetences(): ?GroupeCompetence
    {
        return $this->Groupe_competences;
    }

    public function setGroupeCompetences(?GroupeCompetence $Groupe_competences): self
    {
        $this->Groupe_competences = $Groupe_competences;

        return $this;
    }

    /**
     * @return Collection<int, Situation>
     */
    public function getSituations(): Collection
    {
        return $this->situations;
    }

    public function addSituation(Situation $situation): self
    {
        if (!$this->situations->contains($situation)) {
            $this->situations[] = $situation;
            $situation->addCompetence($this);
        }

        return $this;
    }

    public function removeSituation(Situation $situation): self
    {
        if ($this->situations->removeElement($situation)) {
            $situation->removeCompetence($this);
        }

        return $this;
    }
}
