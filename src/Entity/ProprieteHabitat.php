<?php

namespace App\Entity;

use App\Repository\ProprieteHabitatRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProprieteHabitatRepository::class)
 */
class ProprieteHabitat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Propriete::class)
     * @ORM\JoinColumn(nullable=false,onDelete="CASCADE")
     */
    private $idPropriete;

    /**
     * @ORM\ManyToOne(targetEntity=Habitat::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $IdHabitatPropriete;

    /**
     * @ORM\Column(type="string", length=120, nullable=true)
     */
    private $valeurPropriete;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdPropriete(): ?Propriete
    {
        return $this->idPropriete;
    }

    public function setIdPropriete(?Propriete $idPropriete): self
    {
        $this->idPropriete = $idPropriete;

        return $this;
    }

    public function getIdHabitatPropriete(): ?Habitat
    {
        return $this->IdHabitatPropriete;
    }

    public function setIdHabitatPropriete(?Habitat $IdHabitatPropriete): self
    {
        $this->IdHabitatPropriete = $IdHabitatPropriete;

        return $this;
    }

    public function getValeurPropriete(): ?string
    {
        return $this->valeurPropriete;
    }

    public function setValeurPropriete(?string $valeurPropriete): self
    {
        $this->valeurPropriete = $valeurPropriete;

        return $this;
    }
}
