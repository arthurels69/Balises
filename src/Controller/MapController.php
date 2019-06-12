<?php

namespace App\Controller;

use App\Repository\TheaterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Theater;

class MapController extends AbstractController
{




    /**
     * @Route("/map2", name="map2")
     */
    public function map2(TheaterRepository $theaterRepository, Theater $theater = null)
    {
        $theater = new Theater();
        $street = $theater->getAddress1();
        $zipCode = $theater->getZipCode();
        $city = $theater->getCity();

        $opts = array('http'=>array('header'=>"User-Agent: StevesCleverAddressScript 3.7.6\r\n"));
        $context = stream_context_create($opts);
        $address = "17 rue Delandine 69002 Lyon";
        $json=file_get_contents(
            'https://nominatim.openstreetmap.org/search.php?q='
            . urlencode($address)
            . '&format=json',
            false,
            $context
        );

        $obj = json_decode($json, true);

        $latitude = $obj[0]['lat'];
        $longitude = $obj[0]['lon'];


        return $this->render('home/map2.html.twig', [
            'theaters' => $theaterRepository->findAll(),
             'lat' => $latitude,
             'long' => $longitude
        ]);
    }
}
