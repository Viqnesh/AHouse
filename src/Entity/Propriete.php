<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Propriete
 *
 * @ORM\Table(name="propriete", indexes={@ORM\Index(name="IDX_73A85B935BA3388B", columns={"id_type_habitat_id"})})
 * @ORM\Entity
 */
class Propriete
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @Assert\Unique
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     * 
     * @ORM\Column(name="nom", type="string", length=40, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=30, nullable=false)
     */
    private $type;

    /**
     * @var bool
     *
     * @ORM\Column(name="obligatoire", type="boolean", nullable=false)
     */
    private $obligatoire;

    /**
     * @var \TypeHabitat
     *
     * @ORM\ManyToOne(targetEntity="TypeHabitat")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_type_habitat_id", referencedColumnName="id")
     * })
     */
    private $idTypeHabitat;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;




    public function __construct()
    {
        $this->image = "images/proprietes/2.png";


    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
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

    public function getObligatoire(): ?bool
    {
        return $this->obligatoire;
    }

    public function setObligatoire(bool $obligatoire): self
    {
        $this->obligatoire = $obligatoire;

        return $this;
    }


    public function getIdTypeHabitat(): ?TypeHabitat
    {
        return $this->idTypeHabitat;
    }

    public function setIdTypeHabitat(?TypeHabitat $idTypeHabitat): self
    {
        $this->idTypeHabitat = $idTypeHabitat;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }


}
