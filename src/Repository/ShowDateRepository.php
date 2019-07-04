<?php

namespace App\Repository;

use App\Entity\ShowDate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ShowDate|null find($id, $lockMode = null, $lockVersion = null)
 * @method ShowDate|null findOneBy(array $criteria, array $orderBy = null)
 * @method ShowDate[]    findAll()
 * @method ShowDate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShowDateRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ShowDate::class);
    }

    // /**
    //  * @return ShowDate[] Returns an array of ShowDate objects
    //  */
    /*
    public function findByDate($dateShow)
    {

        return $this->createQueryBuilder('s')
            ->andWhere(Date_format(s.dateShow, "%Y-%m-%d") = ':val')
            ->setParameter('val', $date)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
    public function findByDate($dateShow, $dateShowPlusOne): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT s.id
        FROM App\Entity\ShowDate s
        WHERE s.dateShow >= :start AND s.dateShow < :end
        ORDER BY s.id ASC'
        )
            ->setParameter('start', $dateShow)
            ->setParameter('end', $dateShowPlusOne);

        // returns an array of Product objects
        return $query->execute();
    }

    /*
    public function findOneBySomeField($value): ?ShowDate
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

//    public function searchThreeDates():array
//    {
//        $entityManager = $this->getEntityManager();
//
//        $query = $entityManager->createQuery(
//            'SELECT *
//                FROM App\Entity\ShowDate s
//                WHERE s.dateShow > NOW()
//                ORDER BY s.dateShow DESC LIMIT 3'
//        );
//            return $query->execute();
//    }
}
