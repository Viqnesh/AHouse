<?php

namespace App\Entity;

use App\Repository\OccupantRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OccupantRepository::class)
 */
class Occupant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=Location::class, inversedBy="occupants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idLocation;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getIdLocation(): ?Location
    {
        return $this->idLocation;
    }

    public function setIdLocation(?Location $idLocation): self
    {
        $this->idLocation = $idLocation;

        return $this;
    }

}
