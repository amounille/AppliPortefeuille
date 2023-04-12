<?php

namespace App\Entity;

use App\Repository\PortefeuilleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PortefeuilleRepository::class)
 */
class Portefeuille
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=GroupeCompetence::class, mappedBy="Portefeuilles")
     */
    private $groupeCompetences;

    /**
     * @ORM\OneToOne(targetEntity=Eleve::class, mappedBy="portefeuille", cascade={"persist", "remove"})
     */
    private $eleve;

    public function __construct()
    {
        $this->groupeCompetences = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, GroupeCompetence>
     */
    public function getGroupeCompetences(): Collection
    {
        return $this->groupeCompetences;
    }

    public function addGroupeCompetence(GroupeCompetence $groupeCompetence): self
    {
        if (!$this->groupeCompetences->contains($groupeCompetence)) {
            $this->groupeCompetences[] = $groupeCompetence;
            $groupeCompetence->addPortefeuille($this);
        }

        return $this;
    }

    public function removeGroupeCompetence(GroupeCompetence $groupeCompetence): self
    {
        if ($this->groupeCompetences->removeElement($groupeCompetence)) {
            $groupeCompetence->removePortefeuille($this);
        }

        return $this;
    }

    public function getEleve(): ?Eleve
    {
        return $this->eleve;
    }

    public function setEleve(?Eleve $eleve): self
    {
        // unset the owning side of the relation if necessary
        if ($eleve === null && $this->eleve !== null) {
            $this->eleve->setPortefeuille(null);
        }

        // set the owning side of the relation if necessary
        if ($eleve !== null && $eleve->getPortefeuille() !== $this) {
            $eleve->setPortefeuille($this);
        }

        $this->eleve = $eleve;

        return $this;
    }
}
