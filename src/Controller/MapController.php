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
     * @Route("/map2", name="map2")
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



    /**
     * @Route("/spectacle/{id}", name="detailSpectacle", methods={"GET"})
     * @param Spectacle $spectacle
     * @return Response
     */
    public function detailSpectacle(Spectacle $spectacle): Response
    {
        return $this->render('home/spectacle.html.twig', [
            'spectacle' => $spectacle,
        ]);
    }
}
