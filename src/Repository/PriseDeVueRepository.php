<?php

namespace App\Repository;

use App\Entity\PriseDeVue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PriseDeVue|null find($id, $lockMode = null, $lockVersion = null)
 * @method PriseDeVue|null findOneBy(array $criteria, array $orderBy = null)
 * @method PriseDeVue[]    findAll()
 * @method PriseDeVue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PriseDeVueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PriseDeVue::class);
    }

    // /**
    //  * @return PriseDeVue[] Returns an array of PriseDeVue objects
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
    public function findOneBySomeField($value): ?PriseDeVue
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
