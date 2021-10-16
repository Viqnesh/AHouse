<?php

namespace App\Repository;

use App\Entity\CalendrierDomaine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CalendrierDomaine|null find($id, $lockMode = null, $lockVersion = null)
 * @method CalendrierDomaine|null findOneBy(array $criteria, array $orderBy = null)
 * @method CalendrierDomaine[]    findAll()
 * @method CalendrierDomaine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CalendrierDomaineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CalendrierDomaine::class);
    }

    // /**
    //  * @return CalendrierDomaine[] Returns an array of CalendrierDomaine objects
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
    public function findOneBySomeField($value): ?CalendrierDomaine
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
