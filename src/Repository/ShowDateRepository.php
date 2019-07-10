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

    public function spectaclePerDates($start, $end) : array
    {
        return $this->createQueryBuilder('d')
            ->where('d.dateShow >= :start')
            ->andWhere('d.dateShow < :end')
            ->setParameter('start', $start)
            ->setParameter('end', $end)
            ->getQuery()
            ->getResult()
            ;
    }


    public function findDateMois()    
    {
        $conn = $this->getEntityManager()->getConnection();

        //$sql='SELECT COUNT(*) as nbSpectacle,MONTH(date_show) AS mois FROM show_date GROUP BY mois';
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
}
