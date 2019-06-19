<?php

namespace App\Controller;

use Mapado\LeagueOAuth2Provider\Provider\MapadoOAuth2Provider;
use Mapado\RestClientSdk\RestClient;
use Mapado\RestClientSdk\SdkClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use GuzzleHttp;

class MapadoController extends AbstractController
{
    /**
     * @Route("/mapado", name="mapado")
     */
    public function index()
    {

        $provider = new MapadoOAuth2Provider([
            'clientId' => '626_8zldy7pffu8s484scs0kcoskkws8okoo44w0oksgkcc4co44s',
            'clientSecret' => '5edoxd1i800008wsg08oswsc44sgo8kk44ogw8oosswo8ckg08'
        ]);


        $token = $provider->getAccessToken('password', [
            'scope' => 'ticketing:events:read',
            'username' => 'wildcode@test.com',
            'password' => 'wildcode',
        ]);

        $realToken = $token->getToken();
		dump($realToken);
        //$provider->getAuthenticatedRequest('GET', '', '')
        dump($token->getValues());



        return $this->render('mapado/index.html.twig');
    }
}
