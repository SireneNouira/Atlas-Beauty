<?php

namespace App\Dto;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

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
    public string $annee_naissance;

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

    #[Assert\NotBlank(groups: ['photo:create'])]
    #[Groups(['patient:write'])]
    #[Assert\File(mimeTypes: ['image/jpeg', 'image/png'])]
    public ?File $photoFile = null;

    #[Assert\NotBlank]
    #[Groups(['patient:write'])]
    public string $note;

    #[Assert\NotBlank]
    #[Groups(['patient:write', 'patient:read'])]
    public string $date_souhaite;



    #[Assert\NotBlank]
    #[Groups(['patient:write', 'patient:read'])]
    public string $intervention_1_name;

   
    #[Groups(['patient:write', 'patient:read'])]
    public string $intervention_2_name;
}