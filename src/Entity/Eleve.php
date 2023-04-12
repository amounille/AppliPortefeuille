<?php

namespace App\Entity;

use App\Repository\EleveRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EleveRepository::class)
 */
class Eleve extends User
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
    private $option;

    /**
     * @ORM\ManyToOne(targetEntity=Promo::class, inversedBy="eleves")
     */
    private $promo;

    /**
     * @ORM\OneToOne(targetEntity=Portefeuille::class, inversedBy="eleve", cascade={"persist", "remove"})
     */
    private $portefeuille;

    /**
     * @ORM\OneToMany(targetEntity=Situation::class, mappedBy="eleve")
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

    public function getOption(): ?string
    {
        return $this->option;
    }

    public function setOption(string $option): self
    {
        $this->option = $option;

        return $this;
    }

    public function getPromo(): ?Promo
    {
        return $this->promo;
    }

    public function setPromo(?Promo $promo): self
    {
        $this->promo = $promo;

        return $this;
    }

    public function getPortefeuille(): ?Portefeuille
    {
        return $this->portefeuille;
    }

    public function setPortefeuille(?Portefeuille $portefeuille): self
    {
        $this->portefeuille = $portefeuille;

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
            $situation->setEleve($this);
        }

        return $this;
    }

    public function removeSituation(Situation $situation): self
    {
        if ($this->situations->removeElement($situation)) {
            // set the owning side to null (unless already changed)
            if ($situation->getEleve() === $this) {
                $situation->setEleve(null);
            }
        }

        return $this;
    }
}
