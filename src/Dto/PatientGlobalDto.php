<?php

namespace App\Dto;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\Type;

class PatientGlobalDto
{
    #[Assert\NotBlank]
    #[Assert\Email]
    #[Groups(['patient:write', 'patient:read'])]
    public string $email;

    #[Assert\NotBlank]
    #[Groups(['patient:write'])]
    public string $password;

    #[Assert\NotBlank]
    #[Groups(['patient:write', 'patient:read'])]
    public string $nom;

    #[Assert\NotBlank]
    #[Groups(['patient:write', 'patient:read'])]
    public string $prenom;

    #[Assert\NotBlank]
    #[Groups(['patient:write', 'patient:read'])]
    public string $civilite;


    #[Groups(['patient:write', 'patient:read'])]
    public  $annee_naissance;

    #[Assert\NotBlank]
    #[Groups(['patient:write', 'patient:read'])]
    public string $pays;

    #[Assert\NotBlank]
    #[Groups(['patient:write', 'patient:read'])]
    public string $profession;

    #[Assert\NotBlank]
    #[Groups(['patient:write', 'patient:read'])]
    public string $tel;

    #[Assert\NotBlank]
    #[Groups(['patient:write', 'patient:read'])]
    public string $poids;
    
    #[Assert\NotBlank]
    #[Groups(['patient:write', 'patient:read'])]
    public string $taille;

    #[Assert\NotNull]
    #[Groups(['patient:write', 'patient:read'])]
    public bool $tabac;

    #[Assert\NotNull]
    #[Groups(['patient:write', 'patient:read'])]
    public bool $alcool;

    #[Groups(['patient:write'])]
    #[Assert\File(mimeTypes: ['image/jpeg', 'image/png'], mimeTypesMessage: 'Veuillez envoyer une image valide (JPEG ou PNG).', notFoundMessage: 'Aucun fichier trouvé.')]
    public ?File $photoFile = null;
    

    #[Assert\NotBlank]
    #[Groups(['patient:write'])]
    public string $note;

    #[Groups(['patient:write', 'patient:read'])]
    public $date_souhaite;



    #[Assert\NotBlank]
    #[Groups(['patient:write', 'patient:read'])]
    public string $intervention_1_name;

   
    #[Groups(['patient:write', 'patient:read'])]
    public string $intervention_2_name;
}