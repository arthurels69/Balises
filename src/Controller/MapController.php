<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MapController extends AbstractController
{
    /**
     * @Route("/map", name="map")
     */
    public function map()
    {
        return $this->render('home/map.html.twig');
    }

    /**
     * @Route("/map2", name="map2")
     */
    public function map2()
    {
        return $this->render('home/map2.html.twig');
    }
}
