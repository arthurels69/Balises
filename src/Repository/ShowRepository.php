<?php

namespace App\Repository;

use App\Entity\Spectacle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method spectacle|null find($id, $lockMode = null, $lockVersion = null)
 * @method spectacle|null findOneBy(array $criteria, array $orderBy = null)
 * @method spectacle[]    findAll()
 * @method spectacle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShowRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Spectacle::class);
    }

    // /**
    //  * @return spectacle[] Returns an array of spectacle objects
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
    public function findOneBySomeField($value): ?spectacle
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
