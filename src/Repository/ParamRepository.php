<?php

namespace App\Repository;

use App\Entity\Param;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Param|null find($id, $lockMode = null, $lockVersion = null)
 * @method Param|null findOneBy(array $criteria, array $orderBy = null)
 * @method Param[]    findAll()
 * @method Param[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParamRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Param::class);
    }

    // /**
    //  * @return Param[] Returns an array of Param objects
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
    public function findOneBySomeField($value): ?Param
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
