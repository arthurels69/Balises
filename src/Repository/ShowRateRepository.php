<?php

namespace App\Repository;

use App\Entity\ShowRate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ShowRate|null find($id, $lockMode = null, $lockVersion = null)
 * @method ShowRate|null findOneBy(array $criteria, array $orderBy = null)
 * @method ShowRate[]    findAll()
 * @method ShowRate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShowRateRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ShowRate::class);
    }

    // /**
    //  * @return ShowRate[] Returns an array of ShowRate objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ShowRate
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
