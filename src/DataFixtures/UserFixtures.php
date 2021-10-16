<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Activite;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{

    private $passwordEncoder ;

         public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }
    public function load(ObjectManager $manager)
    {
        $product = new User() ;
        $product->setLogin("eshwar");
        $product->setRoles(["ROLE_USER"]);
        $product->setEmail("eshwar@gmail.com");
        $product->setNom("eshwar");
        $product->setPrenom("tillai");
        $product->setAdresse("202 Rue Desaix");
        $product->setVille("Evry");
        $product->setCP("72000");
        $product->setDateNaissance(new \DateTime('now'));
        $product->setGenre("Homme");
        $product->setTelephone("0646437355");

        $password = $this->passwordEncoder->encodePassword($product, 'mdpasse');
        $product->setPassword($password);
        $manager->persist($product);
        $manager->flush();
    }
    
}
