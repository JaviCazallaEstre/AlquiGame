<?php

namespace App\Repository;

use App\Entity\Juego;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Juego|null find($id, $lockMode = null, $lockVersion = null)
 * @method Juego|null findOneBy(array $criteria, array $orderBy = null)
 * @method Juego[]    findAll()
 * @method Juego[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JuegoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Juego::class);
    }

    // /**
    //  * @return Juego[] Returns an array of Juego objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Juego
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findAllGames()
    {
        $con = $this->getEntityManager()->getConnection();

        $query = "
        select j.id, j.nombre, p.nombre as plataforma, j.foto, j.precio, j.rango_edad_id, j.plataforma_id, j.desarrolladora_id, json_agg(jg.genero_id) as generos_id from juego j 
        join plataforma p on p.id = j.plataforma_id 
        join juego_genero jg on j.id = jg.juego_id 
        group by j.id, p.nombre, j.nombre, j.id, j.foto, j.precio, j.rango_edad_id, j.plataforma_id, j.desarrolladora_id
        ";
        $resul = $con->prepare($query);
        $a =  $resul->execute();
        return $a->fetchAllAssociative();
    }

    public function findGame(string $id)
    {
        $con = $this->getEntityManager()->getConnection();
        $query = "select j.id as id, j.nombre as nombre, j.descripcion as descripcion,j.precio as precio, j.foto as foto,j.video as video  ,string_agg(g.nombre,', ') as generos, p.nombre as plataforma, d.nombre as desarrolladora, re.edad as rango from juego
        j join juego_genero jg on j.id = jg.juego_id
        join genero g on g.id = jg.genero_id
        join plataforma p on p.id = j.plataforma_id 
        join desarrolladora d on d.id = j.desarrolladora_id
        join rango_edad re on re.id = j.rango_edad_id
        where j.id =".$id."
        group by j.id, p.nombre, d.nombre, re.edad";
        $resul = $con->prepare($query);
        $a =  $resul->execute();
        return $a->fetchAssociative();
    }
}
