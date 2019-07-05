<?php
namespace App\Service;

use App\Repository\UserRepository;

/**
 * Classe pour trier un champ par ordre croissant ou decroissant
 */
class TriPageService
{

    private $userRepository;

    /**
     * Ce contructeur permet l'injection de dépendance
     * de l'objet $userRepository pour le container du Service
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository=$userRepository;
    }

     /**
      * Permet de trier un champ par ordre croissant ou decroissant
      *
      * @param String $champ
      * @param String $sens
      * @return array
      */

    public function paginationTri(int $page_cours, int $ligne_page, String $champ = "", String $sens = "") :array
    {
        $users = $this->userRepository->findAll();

         //Nombre de ligne total
         $ligne_totale=count($users);

         //calcul du nombre de pages totales
         $page_total=ceil($ligne_totale/$ligne_page);
 
         //Tableau de users dont le nombre de ligne = $ligne_page
         $off=($page_cours-1)*$ligne_page;
         
         $limit=$ligne_page;         
         
         return $this->userRepository->getPaginationOrderUsers($limit, $off, $champ, $sens);
    }
}
