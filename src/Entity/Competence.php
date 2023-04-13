<?php

namespace App\Entity;

use App\Repository\CompetenceRepository;
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
    private $groupeCompetences;

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
        return $this->groupeCompetences;
    }

    public function setGroupeCompetences(?GroupeCompetence $groupeCompetences): self
    {
        $this->groupeCompetences = $groupeCompetences;

        return $this;
    }
}
