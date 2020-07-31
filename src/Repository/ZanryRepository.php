<?php

namespace App\Repository;

use App\Entity\Zanry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Zanry|null find($id, $lockMode = null, $lockVersion = null)
 * @method Zanry|null findOneBy(array $criteria, array $orderBy = null)
 * @method Zanry[]    findAll()
 * @method Zanry[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ZanryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Zanry::class);
    }

    // /**
    //  * @return Zanry[] Returns an array of Zanry objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('z')
            ->andWhere('z.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('z.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Zanry
    {
        return $this->createQueryBuilder('z')
            ->andWhere('z.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
