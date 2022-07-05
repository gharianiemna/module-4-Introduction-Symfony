<?php

namespace App\Entity;

use App\Repository\EquipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EquipeRepository::class)
 */
class Equipe
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */

    private $id;
    private $Nomequipe ;
    private $Ville;
    private $Sport;
    public $joueur;
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomequipe(): ?string
    {
        return $this->Nomequipe;
    }

    public function setNomequipe(string $Nomequipe): self
    {
        $this->Nomequipe = $Nomequipe;

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
    public function getSport(): ?string
    {
        return $this->Sport;
    }

    public function setSport(string $Sport): self
    {
        $this->Sport = $Sport;

        return $this;
    }

    public function getJoueur()
    {
        return $this->joueur;
    }

    public function setJoueur($joueur): self
    {
        $this->joueur = $joueur;

        return $this;
    }

}