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
        // var_dump($champ);
        // var_dump($order); 
        // die();

        switch ($champ) {
            case "zipCode" :
                $field = 'theater.zipCode';
                break;
            case "name" :
                $field = 'theater.name';
                break;
            case "email" :
                $field = 'user.email';
                break;
            default :
                $field = 'theater.id';
        }

        $order=='up' ? $order="DESC" : $order="ASC";

        
        return $this->createQueryBuilder('user')
        ->join('user.theater', 'theater')
        ->orderBy($field, $order)
        ->setMaxResults($limit)           
        ->setFirstResult($off)           
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
