<?php

namespace App\DataTransformer;



use App\Dto\PatientGlobalDto;
use App\Entity\Patient;
use App\Entity\Photo;
use App\Entity\DemandeDevis;
use App\Entity\Intervention;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class PatientGlobalDtoToEntityTransformer
{

    public function __construct(
        private SerializerInterface $serializer,
        private EntityManagerInterface $entityManager,
    ) {}

    public function transform(PatientGlobalDto $dto, Patient $patient,  array $context = []): Patient
    {
        // Si un patient existe déjà (pour une mise à jour), on le récupère
        $context = [];
        if ($patient) {
            $context[AbstractNormalizer::OBJECT_TO_POPULATE] = $patient;
        }

        // Désérialise le DTO en entité Patient
        $patient = $this->serializer->deserialize(
            $this->serializer->serialize($dto, 'json'),
            Patient::class,
            'json',
            $context
        );

        if ($dto->photoFile) {
            $photo = new Photo();
            $photo->setPhotoFile($dto->photoFile); // VichUploaderBundle gère le reste
            $photo->setPatient($patient);
    
            // Associer la photo au patient
            $patient->addPhoto($photo);
        }


        // Crée la demande de devis associée
        $demandeDevis = new DemandeDevis();
        $demandeDevis->setPatient($patient);
        $demandeDevis->setNote($dto->note);
        $demandeDevis->setDateSouhaite(new \DateTime($dto->date_souhaite));
        $demandeDevis->setStatus('envoyé');
        $demandeDevis->setDateCreation(new \DateTime());

        // 🔹 Rechercher les interventions dans la base de données
        if ($dto->intervention_1_name) {
            $intervention1 = $this->entityManager
                ->getRepository(Intervention::class)
                ->findOneBy(['name' => $dto->intervention_1_name]);

            if ($intervention1) {
                $demandeDevis->setIntervention1($intervention1);
            }
        }

        if ($dto->intervention_2_name) {
            $intervention2 = $this->entityManager
                ->getRepository(Intervention::class)
                ->findOneBy(['name' => $dto->intervention_2_name]);

            if ($intervention2) {
                $demandeDevis->setIntervention2($intervention2);
            }
        }

        // Associe les entités
        $patient->addDemandeDevis($demandeDevis);

        return $patient;
    }
}
