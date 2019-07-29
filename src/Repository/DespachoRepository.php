<?php

namespace App\Repository;

use App\Entity\Despacho;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Despacho|null find($id, $lockMode = null, $lockVersion = null)
 * @method Despacho|null findOneBy(array $criteria, array $orderBy = null)
 * @method Despacho[]    findAll()
 * @method Despacho[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DespachoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Despacho::class);
    }

    // /**
    //  * @return Despacho[] Returns an array of Despacho objects
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
    public function findOneBySomeField($value): ?Despacho
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
