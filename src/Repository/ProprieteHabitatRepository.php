<?php

namespace App\Repository;

use App\Entity\ProprieteHabitat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProprieteHabitat|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProprieteHabitat|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProprieteHabitat[]    findAll()
 * @method ProprieteHabitat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProprieteHabitatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProprieteHabitat::class);
    }

    // /**
    //  * @return ProprieteHabitat[] Returns an array of ProprieteHabitat objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProprieteHabitat
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
