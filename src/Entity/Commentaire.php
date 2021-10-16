<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Commentaire
 *
 * @ORM\Table(name="commentaire", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_67F068BC79F37AE5", columns={"id_user_id"})}, indexes={@ORM\Index(name="IDX_67F068BCA74ADF1", columns={"id_habitat_id_commentaire"})})
 * @ORM\Entity
 */
class Commentaire
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups("location:info")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text", length=0, nullable=false)
     * @Groups("location:info")
     */
    private $contenu;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user_id", referencedColumnName="id")
     * })
     * @Groups("location:info")
     */
    private $idUser;

    /**
     * @var \Habitat
     *
     * @ORM\ManyToOne(targetEntity="Habitat")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_habitat_id_commentaire", referencedColumnName="id")
     * })
     */
    private $idHabitatIdCommentaire;

    /**
     * @ORM\Column(type="string", length=45)
     * @Groups("location:info")
     */
    private $titre;

    /**
     * @ORM\ManyToOne(targetEntity=ActiviteHabitat::class)
     * @ORM\JoinColumn(nullable=true)
     */
    private $idActiviteHabitat;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getIdHabitatIdCommentaire(): ?Habitat
    {
        return $this->idHabitatIdCommentaire;
    }

    public function setIdHabitatIdCommentaire(?Habitat $idHabitatIdCommentaire): self
    {
        $this->idHabitatIdCommentaire = $idHabitatIdCommentaire;

        return $this;
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
