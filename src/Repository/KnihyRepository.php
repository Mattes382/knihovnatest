<?php

namespace App\Repository;

use App\Entity\Knihy;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Knihy|null find($id, $lockMode = null, $lockVersion = null)
 * @method Knihy|null findOneBy(array $criteria, array $orderBy = null)
 * @method Knihy[]    findAll()
 * @method Knihy[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KnihyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Knihy::class);
    }

    public function findAuthors()
    {
        return $this->createQueryBuilder('k')
            ->select('k, a')
            ->leftJoin('k.author', 'a')
            ->getQuery()
            ->execute();
    }
    // /**
    //  * @return Knihy[] Returns an array of Knihy objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('k.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Knihy
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
