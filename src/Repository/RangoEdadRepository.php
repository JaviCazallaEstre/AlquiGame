<?php

namespace App\Repository;

use App\Entity\RangoEdad;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RangoEdad|null find($id, $lockMode = null, $lockVersion = null)
 * @method RangoEdad|null findOneBy(array $criteria, array $orderBy = null)
 * @method RangoEdad[]    findAll()
 * @method RangoEdad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RangoEdadRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RangoEdad::class);
    }

    // /**
    //  * @return RangoEdad[] Returns an array of RangoEdad objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RangoEdad
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
