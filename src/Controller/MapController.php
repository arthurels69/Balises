<?php

namespace App\Controller;

use App\Repository\TheaterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MapController extends AbstractController
{
    /**
     * @Route("/map", name="map")
     * @param TheaterRepository $theaterRepository
     * @return Response
     */
    public function index(TheaterRepository $theaterRepository): Response
    {
        return $this->render('home/map.html.twig', [
            'theaters' => $theaterRepository->findAll(),
        ]);
    }



    /**
     * @Route("/map2", name="map2")
     */
    public function map2()
    {
        return $this->render('home/map2.html.twig');
    }
}
