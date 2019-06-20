<?php


namespace App\Service;

use App\Repository\TheaterRepository;
use GuzzleHttp\Client;
use App\Entity\Theater;

class TheaterService
{
    private $theaterRepository;

    public function __construct(TheaterRepository $theaterRepository)
    {
        $this->theaterRepository = $theaterRepository;
    }

    /**
     * Transforms any proper address to coordinates
     */
    public function geocode(Theater $theater)
    {

        $street = $theater->getAddress1();
        $zipCode = $theater->getZipCode();
        $city = $theater->getCity();

        $address = $street . " " . $zipCode . " " . $city;

        $client = new Client([
            'base_uri' => 'https://nominatim.openstreetmap.org/',
        ]);

        $response = $client->request('GET', 'search.php?q='
            . urlencode($address)
            . '&format=json');
        $body = $response->getBody();
        $obj = json_decode($body->getContents(), true);
        $latitude = $obj[0]['lat'];
        $longitude = $obj[0]['lon'];
        $theater->setLongitude($longitude)
                ->setLat($latitude);
    }
}
