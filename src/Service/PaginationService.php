<?php
namespace App\Service;



/**
 * Classe pour trier un champ par ordre croissant ou decroissant
 */
class PaginationService
{

public function paginate(int $page, int $ligne, array $users){
    // dump($page);
    // dd($ligne);

    $nbLignes=count($users);

    $nbPages=ceil($nblignes/$ligne);




}


}