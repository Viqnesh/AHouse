<?php

namespace App\Repository;

use App\Entity\Habitat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Component\Validator\Constraints\NotEqualTo;
use Symfony\Component\Validator\Constraints\NotEqualToValidator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Habitat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Habitat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Habitat[]    findAll()
 * @method Habitat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HabitatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Habitat::class);
    }

    /**
    * @return Habitat[] Returns an array of Habitat objects
    */
    public function findByProprietaire($user)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.id_proprietaire !== :user')
            ->setParameter($user , false)
            ->orderBy('h.datePublication', 'ASC')
            ->setMaxResults(20)
            ->getQuery()
            ->getResult()
        ;
    }

    public function countId()
    {
        return $this->createQueryBuilder('id')
 
                        ->select('COUNT(id)')
 
                        ->getQuery()
 
                        ->getSingleScalarResult();
    }
    /*
    public function findOneBySomeField($value): ?Habitat
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */}