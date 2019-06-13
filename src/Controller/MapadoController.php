<?php

namespace App\Controller;

use Mapado\RestClientSdk\SdkClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MapadoController extends AbstractController
{
    /**
     * @Route("/mapado", name="mapado")
     */
    public function index(SdkClient $client)
    {

    	$this->get('mapado.rest_client_sdk.foo');

		dump($client);
    	$activities = $client->getRepository(Activity::class)->findAll();
		dump($activities);
        return $this->render('mapado/index.html.twig');
    }
}
