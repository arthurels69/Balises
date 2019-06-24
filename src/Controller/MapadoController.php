<?php


namespace App\Controller;

use App\Service\MapadoApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MapadoController extends AbstractController
{

    /**
     * @Route("/mapado", name="mapado")
     */
    public function mapado()
    {

        $mapadoRead = new MapadoApi('ticketing:events:read');

        dump($mapadoRead->getTicketings());


        $mapadoWrite = new MapadoApi('ticketing:events:write');

        $payload = [
        '@context' => '/v1/contexts/Ticketing',
        '@id' => '/v1/ticketings',
        '@type' => 'hydra:PagedCollection',
        'title' => 'test',
        'description' => 'test',
        'place' => 'lyon'
        ];

        $payloadJson = \GuzzleHttp\json_encode($payload);
        dump($payloadJson);

        $result = $mapadoWrite->createTicketing('/v1/ticketings?timezone=Europe/Paris&wallet=1519', $payloadJson);
        return $this->redirectToRoute("home");
    }
}
