<?php

namespace App\Repository;

use App\Entity\ShowDate;
use App\Entity\Spectacle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Spectacle|null find($id, $lockMode = null, $lockVersion = null)
 * @method Spectacle|null findOneBy(array $criteria, array $orderBy = null)
 * @method Spectacle[]    findAll()
 * @method Spectacle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpectacleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Spectacle::class);
    }

    public function findbyDatesX($showId) : array
    {
        return $this->createQueryBuilder('s')
            ->innerJoin('s.showDates', 'd')
            ->andWhere('d.showId = :val1')
            ->setParameter('val1', $showId)
            ->orderBy('d.dateShow')
            ->getQuery()
            ->getResult()
        ;
    }
    /**
    * @return spectacle[] Returns an array of spectacle objects
    */
    /*
    public function findAllByDate($value)
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
    public function findOneBySomeField($value): ?Show
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
