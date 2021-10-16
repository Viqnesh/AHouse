<?php

namespace App\Entity;

use App\Repository\CalendrierDomaineRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CalendrierDomaineRepository::class)
 */
class CalendrierDomaine
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDispo;

    /**
     * @ORM\ManyToOne(targetEntity=Domaine::class, inversedBy="calendrierDomaines")
     */
    private $idDomaine;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDispo(): ?\DateTimeInterface
    {
        return $this->dateDispo;
    }

    public function setDateDispo(\DateTimeInterface $dateDispo): self
    {
        $this->dateDispo = $dateDispo;

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
}
