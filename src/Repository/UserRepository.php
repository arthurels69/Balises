<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }
    
    public function getPaginationOrderUsers($limit, $off, $champ, $order)
    {
     
        if ($champ!="" && $order!="") {
            if ($champ == 'zipCode') {
                $field = 'theater.' . $champ;
            } elseif ($champ == 'name') {
                $field = 'theater.' . $champ;
            } else {
                $field = 'user.' . $champ;
            }

            if ($order=='up') {
                $order="ASC";
            }
            if ($order=='down') {
                $order="DESC";
            }
        } else {
            $field="";
        }

        return $this->createQueryBuilder('user')
            ->innerJoin('user.theater', 'theater')
            //->orderBy($field, $order)
            ->setFirstResult($off)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
