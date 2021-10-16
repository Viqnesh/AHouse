<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\RangeValidator;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Serializer\Annotation\Groups;

use Doctrine\ORM\Mapping as ORM;

/**
 * Location
 * @ORM\Table(name="location", indexes={@ORM\Index(name="IDX_5E9E89CB79F37AE5", columns={"id_user_locataire"}), @ORM\Index(name="IDX_5E9E89CBA74ADF1", columns={"id_habitat_id_location"})})
 * @ORM\Entity
 */
class Location
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     * @Groups("location:info")
     * @Groups("appitat:info")
     * @ORM\Column(name="date_reservation", type="datetime", nullable=false)
     */
    private $dateReservation;

    /**
     * @Assert\GreaterThan("+5 hours")
     * @Groups("location:info")
     * @Groups("appitat:info")
     * @var \DateTime
     * @ORM\Column(name="dateDebut", type="datetime", nullable=false)
     */
    private $datedebut;

    /**
    * @Assert\GreaterThan("today")
     * @Groups("location:info")
     * @var \DateTime
     * @ORM\Column(name="dateFin", type="datetime", nullable=false)
     */
    private $datefin;

    /**
     * @var string
     * @ORM\Column(name="statut", type="string", length=25, nullable=false)
     */
    private $statut;

    /**
     * @var \User
     * @ORM\ManyToOne(targetEntity="User")
     * @Groups("location:info")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user_locataire", referencedColumnName="id")
     * })
     */
    private $idUserLocataire;

    /**
     * @var \Habitat
     * @ORM\ManyToOne(targetEntity="Habitat")
     * @Groups("location:info")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="id_habitat_id_location", referencedColumnName="id")
     * })
     */
    private $idHabitatIdLocation;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $appreciation;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbPersonnes;

    /**
     * @ORM\OneToMany(targetEntity=Occupant::class, mappedBy="idLocation", orphanRemoval=true)
     */
    private $occupants;

    /**
    * Constructor
    */
    public function __construct()
    {
        $this->dateReservation = new \DateTime('now');
        $this->statut = "En Attente";
        $this->occupants = new ArrayCollection();

    }
     

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateReservation(): ?\DateTimeInterface
    {
        return $this->dateReservation;
    }

    public function setDateReservation(\DateTimeInterface $dateReservation): self
    {
        $this->dateReservation = $dateReservation;

        return $this;
    }

    public function getDatedebut(): ?\DateTimeInterface
    {
        return $this->datedebut;
    }

    public function setDatedebut($datedebut): self
    {
        $this->datedebut = $datedebut;

        return $this;
    }

    public function getDatefin(): ?\DateTimeInterface
    {
        return $this->datefin;
    }

    public function setDatefin($datefin): self
    {
        $this->datefin = $datefin;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getIdUserLocataire(): ?User
    {
        return $this->idUserLocataire;
    }

    public function setIdUserLocataire(?User $idUserLocataire): self
    {
        $this->idUserLocataire = $idUserLocataire;

        return $this;
    }

    public function getIdHabitatIdLocation(): ?Habitat
    {
        return $this->idHabitatIdLocation;
    }

    public function setIdHabitatIdLocation(?Habitat $idHabitatIdLocation): self
    {
        $this->idHabitatIdLocation = $idHabitatIdLocation;

        return $this;
    }

    public function getAppreciation(): ?bool
    {
        return $this->appreciation;
    }

    public function setAppreciation(?bool $appreciation): self
    {
        $this->appreciation = $appreciation;

        return $this;
    }

    public function getNbPersonnes(): ?int
    {
        return $this->nbPersonnes;
    }

    public function setNbPersonnes(int $nbPersonnes): self
    {
        $this->nbPersonnes = $nbPersonnes;

        return $this;
    }

    /**
     * @return Collection|Occupant[]
     */
    public function getOccupants(): Collection
    {
        return $this->occupants;
    }

    public function addOccupant(Occupant $occupant): self
    {
        if (!$this->occupants->contains($occupant)) {
            $this->occupants[] = $occupant;
            $occupant->setIdLocation($this);
        }

        return $this;
    }

    public function removeOccupant(Occupant $occupant): self
    {
        if ($this->occupants->removeElement($occupant)) {
            // set the owning side to null (unless already changed)
            if ($occupant->getIdLocation() === $this) {
                $occupant->setIdLocation(null);
            }
        }

        return $this;
    }




}
