<?php

namespace App\Repository;

use App\Entity\Reservas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Reservas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reservas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reservas[]    findAll()
 * @method Reservas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservas::class);
    }

    public function insertReserva($form){
        $con = $this->getEntityManager()->getConnection();
        $query = "insert into reserva(fecha_inicio, fecha_fin, precio,juego_id, usuario_id) values";
        $resul = $con->prepare($query);
        $resul->executeQuery();
    }

    public function findAlquileresByUser($id){
        $con = $this->getEntityManager()->getConnection();

        $query = "select j.nombre,r.fecha_inicio, r.fecha_fin, r.precio, fecha_devolucion
        from reservas r join juego j on j.id = r.juego_id
        where r.usuario_id=".$id;
        $resul = $con->prepare($query);
        $a =  $resul->execute();
        return $a->fetchAllAssociative();
    }

    // /**
    //  * @return Reservas[] Returns an array of Reservas objects
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
    public function findOneBySomeField($value): ?Reservas
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
