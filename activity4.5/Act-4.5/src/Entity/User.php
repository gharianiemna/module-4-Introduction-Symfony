<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
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
    private $Nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Prenom;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Age;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Adress;

   
    /**
     * @ORM\Column(type="integer")
     */
    private $CodPostal;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Ville;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $PermisConduire;

    /**
     * @ORM\OneToOne(targetEntity=Montant::class, mappedBy="User", cascade={"persist", "remove"})
     */
    private $montant;


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

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->Age;
    }

    public function setAge(?int $Age): self
    {
        $this->Age = $Age;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->Adress;
    }

    public function setAdress(string $Adress): self
    {
        $this->Adress = $Adress;

        return $this;
    }

    public function getCodPostal(): ?int
    {
        return $this->CodPostal;
    }

    public function setCodPostal(int $CodPostal): self
    {
        $this->CodPostal = $CodPostal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->Ville;
    }

    public function setVille(string $Ville): self
    {
        $this->Ville = $Ville;

        return $this;
    }

    public function getPermisConduire(): ?string
    {
        return $this->PermisConduire;
    }

    public function setPermisConduire(?string $PermisConduire): self
    {
        $this->PermisConduire = $PermisConduire;

        return $this;
    }

    public function getMontant(): ?Montant
    {
        return $this->montant;
    }

    public function setMontant(Montant $montant): self
    {
        // set the owning side of the relation if necessary
        if ($montant->getUser() !== $this) {
            $montant->setUser($this);
        }

        $this->montant = $montant;

        return $this;
    }

}
