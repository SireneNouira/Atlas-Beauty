<?php

namespace App\Entity;

use App\Repository\InterventionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InterventionRepository::class)]
class Intervention
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, DemandeDevis>
     */
    #[ORM\OneToMany(targetEntity: DemandeDevis::class, mappedBy: 'intervention_1')]
    private Collection $demandeDevis;

    public function __construct()
    {
        $this->demandeDevis = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, DemandeDevis>
     */
    public function getDemandeDevis(): Collection
    {
        return $this->demandeDevis;
    }

    public function addDemandeDevi(DemandeDevis $demandeDevi): static
    {
        if (!$this->demandeDevis->contains($demandeDevi)) {
            $this->demandeDevis->add($demandeDevi);
            $demandeDevi->setIntervention1($this);
        }

        return $this;
    }

    public function removeDemandeDevi(DemandeDevis $demandeDevi): static
    {
        if ($this->demandeDevis->removeElement($demandeDevi)) {
            // set the owning side to null (unless already changed)
            if ($demandeDevi->getIntervention1() === $this) {
                $demandeDevi->setIntervention1(null);
            }
        }

        return $this;
    }


}
