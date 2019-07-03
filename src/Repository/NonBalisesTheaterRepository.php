<?php

namespace App\Repository;

use App\Entity\NonBalisesTheater;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method NonBalisesTheater|null find($id, $lockMode = null, $lockVersion = null)
 * @method NonBalisesTheater|null findOneBy(array $criteria, array $orderBy = null)
 * @method NonBalisesTheater[]    findAll()
 * @method NonBalisesTheater[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NonBalisesTheaterRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, NonBalisesTheater::class);
    }

    // /**
    //  * @return NonBalisesTheater[] Returns an array of NonBalisesTheater objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NonBalisesTheater
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
