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

    public function spectaclePerDates($start, $end, $today) : array
    {
        return $this->createQueryBuilder('d')
            ->where('d.dateShow >= :start')
            ->andWhere('d.dateShow >= :today')
            ->andWhere('d.dateShow < :end')
            ->setParameter('start', $start)
            ->setParameter('today', $today)
            ->setParameter('end', $end)
            ->orderBy('d.dateShow', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }


    public function dateList($spectacleId, $today) :array
    {
        return $this->createQueryBuilder('d')
            ->where('d.showId >= :spectacleId')
            ->andWhere('d.dateShow >= :today')
            ->setParameter('spectacleId', $spectacleId)
            ->setParameter('today', $today)
            ->orderBy('d.dateShow', 'ASC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult()
            ;
    }


    public function findDateMois()    
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql='SELECT MONTH(date_show) AS mois, YEAR(date_show) AS annee, COUNT(*) as nbSpectacle FROM show_date GROUP BY annee, mois';

        $stmt = $conn->prepare($sql);
        $stmt->execute();
    
        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();

    }

    public function findDateYear()    
    {

        $conn = $this->getEntityManager()->getConnection();

        $sql='SELECT YEAR(date_show) as annee  FROM show_date  GROUP BY annee ORDER BY annee DESC' ;
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    
        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
    }

    public function findSpectacleYear()    
    {

        $conn = $this->getEntityManager()->getConnection();

        $sql='SELECT COUNT(*) AS nbSpectacleAn ,YEAR(date_show) AS annee FROM show_date GROUP BY annee; ' ;
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    
        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
    }

    public function moreDateList($spectacleId, $today) :array
    {
        return $this->createQueryBuilder('d')
            ->where('d.showId >= :spectacleId')
            ->andWhere('d.dateShow >= :today')
            ->setParameter('spectacleId', $spectacleId)
            ->setParameter('today', $today)
            ->orderBy('d.dateShow', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }
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
