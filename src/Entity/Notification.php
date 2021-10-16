<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * Notification
 *
 * @ORM\Table(name="notification", indexes={@ORM\Index(name="fk_typehabitat", columns={"id_type_habitat"})})
 * @ORM\Entity
 */
class Notification
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     * @Groups("notification:info")
     * @ORM\Column(name="titre", type="string", length=50, nullable=false)
     */
    private $titre;

    /**
     * @var string
     * @Groups("notification:info")
     * @ORM\Column(name="contenu", type="string", length=255, nullable=false)
     */
    private $contenu;

    /**
     * @var \TypeHabitat
     *
     * @ORM\ManyToOne(targetEntity="TypeHabitat")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_type_habitat", referencedColumnName="id")
     * })
     */
    private $idTypeHabitat;

    /**
     * @ORM\ManyToMany(targetEntity=Habitat::class, inversedBy="notification")
     */
    private $idHabitat;

    /**
     * @ORM\Column(type="date")
     */
    private $datePublication;

    public function __construct()
    {
        $this->idHabitat = new ArrayCollection();
        $this->datePublication = new \DateTime('now');

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

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
     * @return Collection|Habitat[]
     */
    public function getIdHabitat(): Collection
    {
        return $this->idHabitat;
    }

    public function addIdHabitat(Habitat $idHabitat): self
    {
        if (!$this->idHabitat->contains($idHabitat)) {
            $this->idHabitat[] = $idHabitat;
        }

        return $this;
    }

    public function removeIdHabitat(Habitat $idHabitat): self
    {
        $this->idHabitat->removeElement($idHabitat);

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


}
