<?php

namespace App\Repository;

use App\Entity\ContenuController;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ContenuController|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContenuController|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContenuController[]    findAll()
 * @method ContenuController[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContenuControllerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContenuController::class);
    }

    // /**
    //  * @return ContenuController[] Returns an array of ContenuController objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ContenuController
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
