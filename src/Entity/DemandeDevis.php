<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\DemandeDevisRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: DemandeDevisRepository::class)]
#[ApiResource(normalizationContext: ['groups' => ['demande_devis:read']],
denormalizationContext: ['groups' => ['demande_devis:write']])]
class DemandeDevis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'demandeDevis')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Patient $patient = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['demande_devis:write'])]
    private ?string $note = null;

    #[ORM\Column(type: "date", nullable: true)]
    #[Groups(['demande_devis:write'])]
    private ?\DateTimeInterface $date_souhaite = null;

    #[ORM\Column(length: 255)]
    private ?string $status = 'envoyé';

    #[ORM\OneToOne(mappedBy: 'demande_devis', cascade: ['persist', 'remove'])]
    private ?Devis $devis = null;

    #[ORM\ManyToOne(inversedBy: 'demandeDevis')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['demande_devis:write'])]
    private ?Intervention $intervention_1 = null;

    #[ORM\ManyToOne(inversedBy: 'demandeDevis')]
    #[Groups(['demande_devis:write'])]
    private ?Intervention $intervention_2 = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_creation = null;
    
    public function __construct()
    {
        $this->date_creation = new \DateTime();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }
    public function setDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): static
    {
        $this->patient = $patient;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): static
    {
        $this->note = $note;

        return $this;
    }

    public function getDateSouhaite(): ?\DateTimeInterface
    {
        return $this->date_souhaite;
    }

    public function setDateSouhaite(\DateTimeInterface $date_souhaite): static
    {
        $this->date_souhaite = $date_souhaite;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getDevis(): ?Devis
    {
        return $this->devis;
    }

    public function setDevis(?Devis $devis): static
    {
        // unset the owning side of the relation if necessary
        if ($devis === null && $this->devis !== null) {
            $this->devis->setDemandeDevis(null);
        }

        // set the owning side of the relation if necessary
        if ($devis !== null && $devis->getDemandeDevis() !== $this) {
            $devis->setDemandeDevis($this);
        }

        $this->devis = $devis;

        return $this;
    }

    public function getIntervention1(): ?Intervention
    {
        return $this->intervention_1;
    }

    public function setIntervention1(?Intervention $intervention_1): static
    {
        $this->intervention_1 = $intervention_1;

        return $this;
    }

    public function getIntervention2(): ?Intervention
    {
        return $this->intervention_2;
    }

    public function setIntervention2(?Intervention $intervention_2): static
    {
        $this->intervention_2 = $intervention_2;

        return $this;
    }


}
