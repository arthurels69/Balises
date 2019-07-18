<?php

namespace App\Controller;

use App\Entity\Spectacle;
use App\Repository\SpectacleRepository;
use App\Repository\TheaterRepository;
use App\Repository\ShowDateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class MapController extends AbstractController
{

    /**
     * @Route("/map", name="map2")
     */
    public function map2(
        TheaterRepository $theaterRepository,
        SpectacleRepository $spectacleRepository,
        ShowDateRepository $dateRepository,
        ShowDateRepository $showDateRepository
    ) {
        return $this->render('home/map2.html.twig', [
            'theaters' => $theaterRepository->findAll(),
            'spectacles' => $spectacleRepository->findAll(),
            'showdates' =>$dateRepository->findAll(),

        ]);
    }
}
