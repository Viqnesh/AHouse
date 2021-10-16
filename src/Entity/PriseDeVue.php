<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * PriseDeVue
 *
 * @ORM\Table(name="prise_de_vue", indexes={@ORM\Index(name="IDX_3EAEED81B5E42F98", columns={"id_activite_habitat_id"}), @ORM\Index(name="IDX_3EAEED81A74ADF1", columns={"id_habitat_id_prisedevue"})})
 * @ORM\Entity
 */
class PriseDeVue
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @Assert\Unique
     * @Groups("location:info")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=150, nullable=false)
     * @Assert\Image(
     * minWidth = 1300,
     * maxWidth = 1900,
     * minHeight = 900,
     * maxHeight = 1400,
     * allowLandscape = false,
     * allowPortrait = false
     * )
     * @Groups("location:info")
     */
    private $url;

    /**
     * @var \Habitat
     *
     * @ORM\ManyToOne(targetEntity="Habitat")
     * @Groups("location:info")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_habitat_id_prisedevue", referencedColumnName="id")
     * })
     */
    private $idHabitatIdPrisedevue;

    /**
     * @var \ActiviteHabitat
     *
     * @ORM\ManyToOne(targetEntity="ActiviteHabitat")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_activite_habitat_id", referencedColumnName="id")
     * })
     */
    private $idActiviteHabitat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getIdHabitatIdPrisedevue(): ?Habitat
    {
        return $this->idHabitatIdPrisedevue;
    }

    public function setIdHabitatIdPrisedevue(?Habitat $idHabitatIdPrisedevue): self
    {
        $this->idHabitatIdPrisedevue = $idHabitatIdPrisedevue;

        return $this;
    }

    public function getIdActiviteHabitat(): ?ActiviteHabitat
    {
        return $this->idActiviteHabitat;
    }

    public function setIdActiviteHabitat(?ActiviteHabitat $idActiviteHabitat): self
    {
        $this->idActiviteHabitat = $idActiviteHabitat;

        return $this;
    }


}
