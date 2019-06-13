<?php
namespace App\Service;
use App\Repository\UserRepository;

/**
 * Classe pour trier un champ par ordre croissant ou decroissant
 */
class TriService {

private $userRepository;

    /**
     * Ce contructeur permet l'injection de dépendance 
     * de l'objet $userRepository pour le container du Service
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository){
        $this->userRepository=$userRepository;
    }

     /**
      * Permet de trier un champ par ordre croissant ou decroissant
      *
      * @param String $champ
      * @param String $sens
      * @return array
      */

    public function tri(String $champ,String $sens) :array
    {
        if ($sens == "up") {
            return $this->userRepository->getOrderUsers($champ, 'ASC');
        }
        else {
            return $this->userRepository->getOrderUsers($champ, 'DESC');
        }
    }
}

