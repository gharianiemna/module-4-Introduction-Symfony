<?php

namespace App\Entity;

use App\Repository\JoueurRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JoueurRepository::class)
 */
class Joueur
{    /**
    * @ORM\Id
    * @ORM\GeneratedValue
    * @ORM\Column(type="integer")
    */
   private $id;
    private $Nom;
    private $Age;
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }
    public function getAge(): ?int
    {
        return $this->Age;
    }

    public function setAge(string $Age): self
    {
        $this->Age = $Age;

        return $this;
    }

}