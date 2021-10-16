<?php

namespace App\Entity;

use App\Repository\DomaineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DomaineRepository::class)
 */
class Domaine
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $idProprietaire;

    /**
     * )
     * @ORM\Column(type="string", length=45)
     */
    private $image;

    /**
     * @ORM\Column(type="time")
     */
    private $arrive;

    /**
     * @ORM\Column(type="time")
     */
    private $depart;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $pays;

    /**
     * @ORM\ManyToMany(targetEntity=Equipement::class)
     * @Groups("location:info")
     */
    private $equipement;

    /**
     * @ORM\ManyToOne(targetEntity=Region::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $region;



    public function __construct()
    {
        $this->equipement = new ArrayCollection();
        $this->pays = "France" ;
        $this->calendrierDomaines = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIdProprietaire(): ?User
    {
        return $this->idProprietaire;
    }

    public function setIdProprietaire(?User $idProprietaire): self
    {
        $this->idProprietaire = $idProprietaire;

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

    public function getArrive(): ?\DateTimeInterface
    {
        return $this->arrive;
    }

    public function setArrive(\DateTimeInterface $arrive): self
    {
        $this->arrive = $arrive;

        return $this;
    }

    public function getDepart(): ?\DateTimeInterface
    {
        return $this->depart;
    }

    public function setDepart(\DateTimeInterface $depart): self
    {
        $this->depart = $depart;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * @return Collection|Equipement[]
     */
    public function getEquipement(): Collection
    {
        return $this->equipement;
    }

    public function addEquipement(Equipement $equipement): self
    {
        if (!$this->equipement->contains($equipement)) {
            $this->equipement[] = $equipement;
        }

        return $this;
    }

    public function removeEquipement(Equipement $equipement): self
    {
        $this->equipement->removeElement($equipement);

        return $this;
    }

    public function getRegion(): ?Region
    {
        return $this->region;
    }

    public function setRegion(?Region $region): self
    {
        $this->region = $region;

        return $this;
    }
        /**
     * @return Collection|DispoDomaine[]
     */
    public function getDispoDomaine(): Collection
    {
        return $this->calendrierDomaines;
    }

    public function addDispoDomaine(DispoDomaine $dispo): self
    {
        if (!$this->calendrierDomaines->contains($dispo)) {
            $this->calendrierDomaines[] = $dispo;
            $dispo->setIdDomaine($this);
        }

        return $this;
    }

    public function removeDispoDomaine(DispoDomaine $dispo): self
    {
        if ($this->calendrierDomaines->removeElement($dispo)) {
            // set the owning side to null (unless already changed)
            if ($dispo->getIdDomaine() === $this) {
                $dispo->setIdDomaine(null);
            }
        }

        return $this;
    }
}
