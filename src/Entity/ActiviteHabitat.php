<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * ActiviteHabitat
 *
 * @ORM\Table(name="activite_habitat", indexes={@ORM\Index(name="IDX_7191756DD0165F20", columns={"type_activite_id"})})
 * @ORM\Entity
 */
class ActiviteHabitat
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @Assert\Unique
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var float
     * @ORM\Column(name="distance", type="float", precision=10, scale=0, nullable=false)
     */
    private $distance;

    /**
     * @var \Activite
     *
     * @ORM\ManyToOne(targetEntity="Activite")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="type_activite_id", referencedColumnName="id")
     * })
     */
    private $typeActivite;

    /**
     * @ORM\ManyToOne(targetEntity=Habitat::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $idHabitat;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->habitat = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDistance(): ?float
    {
        return $this->distance;
    }

    public function setDistance(float $distance): self
    {
        $this->distance = $distance;

        return $this;
    }


    public function getTypeActivite(): ?Activite
    {
        return $this->typeActivite;
    }

    public function setTypeActivite(?Activite $typeActivite): self
    {
        $this->typeActivite = $typeActivite;

        return $this;
    }

    public function getIdHabitat(): ?Habitat
    {
        return $this->idHabitat;
    }

    public function setIdHabitat(?Habitat $idHabitat): self
    {
        $this->idHabitat = $idHabitat;

        return $this;
    }


}
