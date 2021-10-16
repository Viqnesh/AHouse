<?php

namespace Tests\AppBundle\Entity;

use PHPUnit\Framework\TestCase;

class LocationTest extends TestCase
{

    public function testStatut()
    {

        $location = new Location(1, new \DateTime('now'),new \DateTime('now'));
        $this->assertSame("Validé", $location->setStatut("Validé"));
    }


}