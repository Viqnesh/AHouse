<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HomeController
 *
 * @ORM\Table(name="home_controller")
 * @ORM\Entity
 */
class HomeController
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }


}
