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

		/*$baseURL = $provider->getBaseAccessTokenUrl([
			'scope' => 'ticketing:events:read',
			'username' => 'wildcode@test.com',
			'password' => 'wildcode',
		]); */
		dump($provider->getAuthorizationUrl());
		//dump($provider->getRequest('GET', 'https://ticketing.mapado.net/v1/ticketings??view=list'));

		$request = $provider->getAuthenticatedRequest('GET', 'https://api.mapado.net/v2/?fields=eventDateList', $token);

		dump($request);
		dump($request->getBody());
		//Returns a token (string)
		$realToken = $token->getToken();
        //dump($realToken);

        //$provider->getAuthenticatedRequest('GET', '', '')

		//returns token type and given scope
        //dump($token->getValues());

		//returns clients info
        $client = $provider->getHttpClient();
		dump($client);

		$client->request('GET', 'https://ticketing.mapado.net/v1/?fields=eventDateList');

        return $this->render('mapado/index.html.twig');
    }
}
