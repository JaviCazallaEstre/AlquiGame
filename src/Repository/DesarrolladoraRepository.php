<?php

namespace App\Repository;

use App\Entity\Desarrolladora;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Desarrolladora|null find($id, $lockMode = null, $lockVersion = null)
 * @method Desarrolladora|null findOneBy(array $criteria, array $orderBy = null)
 * @method Desarrolladora[]    findAll()
 * @method Desarrolladora[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DesarrolladoraRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Desarrolladora::class);
    }

    // /**
    //  * @return Desarrolladora[] Returns an array of Desarrolladora objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Desarrolladora
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
