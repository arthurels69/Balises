<?php

namespace App\Controller;

use App\Entity\Spectacle;
use App\Entity\Theater;
use App\Service\MapadoApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('index.html.twig');
    }

    /**
     * @Route("/infos/{id}", name="theater_show_visitors", methods={"GET"})
     * @param Theater $theater
     * @return Response
     */
    public function showVisitors(Theater $theater, Spectacle $spectacle): Response
    {
        return $this->render('theater/showVisitors.twig', [
            'theater' => $theater,
            'spectacle' => $spectacle]);
    }
}
