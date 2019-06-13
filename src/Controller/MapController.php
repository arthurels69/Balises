<?php

namespace App\Controller;

use App\Repository\TheaterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class MapController extends AbstractController
{




    /**
     * @Route("/map2", name="map2")
     */
    public function map2(TheaterRepository $theaterRepository)
    {
        return $this->render('home/map2.html.twig', [
            'theaters' => $theaterRepository->findAll(),
        ]);
    }
}
