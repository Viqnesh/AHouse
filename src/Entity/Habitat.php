<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * Habitat
 *
 * @ORM\Table(name="habitat", indexes={@ORM\Index(name="IDX_3B37B2E85BA3388B", columns={"id_type_habitat_id"})})
 * @ORM\Entity
 */
class Habitat
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @Groups("location:info")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     * @Groups("location:info")
     * @ORM\Column(name="nom", type="string", length=30, nullable=false)
     */
    private $nom;

    /**
     * @var string
     * @Groups("location:info")
     * @ORM\Column(name="nb_couchages", type="string", length=25, nullable=false)
     */
    private $nbCouchages;

    /**
     * @var int
     * @Groups("location:info")
     * @ORM\Column(name="capacite", type="integer", nullable=false)
     */
    private $capacite;

    /**
     * @var float
     * @Groups("location:info")
     * @ORM\Column(name="prix", type="float", precision=10, scale=0, nullable=false)
     */
    private $prix;

    /**
     * @var string
     * @Groups("location:info")
     * @ORM\Column(name="pays", type="string", length=30, nullable=false)
     */
    private $pays;

    /**
     * @var string
     * @ORM\Column(name="ville", type="string", length=40, nullable=false)
     * @Groups("location:info")
     */
    private $ville;

    /**
     * @var string
     * @ORM\Column(name="description", type="text", length=0, nullable=false)
     * @Groups("location:info")
     */
    private $description;

    /**
     * @var \DateTime
     * @ORM\Column(name="date_publication", type="date", nullable=false)
     * @Groups("location:info")
     */
    private $datePublication;

    /**
     * @var string
     * @Groups("location:info")
     * @ORM\Column(name="url", type="text", length=65535, nullable=false)
     */
    private $url;

    /**
     * @var \TypeHabitat
     *
     * @ORM\ManyToOne(targetEntity="TypeHabitat")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="id_type_habitat_id", referencedColumnName="id")
     * })
     * @Groups("location:info")
     */
    private $idTypeHabitat;


    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="ActiviteHabitat", mappedBy="habitat")
     */
    private $activiteHabitat;

    /**
     * @ORM\ManyToMany(targetEntity=Notification::class, mappedBy="idHabitat")
     */
    private $notification;

    /**
     * @ORM\ManyToOne(targetEntity=Domaine::class)
     * @ORM\JoinColumn(nullable=false)
     * @Groups("location:info")
     */
    private $idDomaine;

    /**
     * @ORM\ManyToMany(targetEntity=Propriete::class)
     */
    private $propriete;

    /**
     * @ORM\ManyToOne(targetEntity=Region::class)
     * @Groups("location:info")
     */
    private $region;



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->activiteHabitat = new \Doctrine\Common\Collections\ArrayCollection();
        $this->notification = new ArrayCollection();
        $this->datePublication = new \DateTime('now');
        $this->url = "images/defaultHabitat.svg";
        $this->propriete = new ArrayCollection();

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

    public function getNbCouchages(): ?string
    {
        return $this->nbCouchages;
    }

    public function setNbCouchages(string $nbCouchages): self
    {
        $this->nbCouchages = $nbCouchages;

        return $this;
    }

    public function getCapacite(): ?int
    {
        return $this->capacite;
    }

    public function setCapacite(int $capacite): self
    {
        $this->capacite = $capacite;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

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

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

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

    public function getDatePublication(): ?\DateTimeInterface
    {
        return $this->datePublication;
    }

    public function setDatePublication(\DateTimeInterface $datePublication): self
    {
        $this->datePublication = $datePublication;

        return $this;
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

    public function getIdTypeHabitat(): ?TypeHabitat
    {
        return $this->idTypeHabitat;
    }

    public function setIdTypeHabitat(?TypeHabitat $idTypeHabitat): self
    {
        $this->idTypeHabitat = $idTypeHabitat;

        return $this;
    }


    /**
     * @return Collection|ActiviteHabitat[]
     */
    public function getActiviteHabitat(): Collection
    {
        return $this->activiteHabitat;
    }

    public function addActiviteHabitat(ActiviteHabitat $activiteHabitat): self
    {
        if (!$this->activiteHabitat->contains($activiteHabitat)) {
            $this->activiteHabitat[] = $activiteHabitat;
            $activiteHabitat->addHabitat($this);
        }

        return $this;
    }

    public function removeActiviteHabitat(ActiviteHabitat $activiteHabitat): self
    {
        if ($this->activiteHabitat->removeElement($activiteHabitat)) {
            $activiteHabitat->removeHabitat($this);
        }

        return $this;
    }

    /**
     * @return Collection|Notification[]
     */
    public function getNotification(): Collection
    {
        return $this->notification;
    }

    public function addNotification(Notification $notification): self
    {
        if (!$this->notification->contains($notification)) {
            $this->notification[] = $notification;
            $notification->addIdHabitat($this);
        }

        return $this;
    }

    public function removeNotification(Notification $notification): self
    {
        if ($this->notification->removeElement($notification)) {
            $notification->removeIdHabitat($this);
        }

        return $this;
    }

    public function getIdDomaine(): ?Domaine
    {
        return $this->idDomaine;
    }

    public function setIdDomaine(?Domaine $idDomaine): self
    {
        $this->idDomaine = $idDomaine;

        return $this;
    }

    /**
     * @return Collection|Propriete[]
     */
    public function getPropriete(): Collection
    {
        return $this->propriete;
    }

    public function addPropriete(Propriete $propriete): self
    {
        if (!$this->propriete->contains($propriete)) {
            $this->propriete[] = $propriete;
        }

        return $this;
    }

    public function removePropriete(Propriete $propriete): self
    {
        $this->propriete->removeElement($propriete);

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

}
