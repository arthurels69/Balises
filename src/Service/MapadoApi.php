<?php
namespace App\Service;

use Mapado\LeagueOAuth2Provider\Provider\MapadoOAuth2Provider;
use GuzzleHttp\Client;

class MapadoApi
{
    private $uri = "https://ticketing.mapado.net/";
    private $client;
    private $token;

    public function __construct($scope)
    {
        $provider = new MapadoOAuth2Provider([
            'clientId'          => '626_8zldy7pffu8s484scs0kcoskkws8okoo44w0oksgkcc4co44s',
            'clientSecret'      => '5edoxd1i800008wsg08oswsc44sgo8kk44ogw8oosswo8ckg08',
        ]);

        $this->token = $provider->getAccessToken('client_credentials', [
            'scope' => $scope,
        ]);

        $this->client = new Client(['base_uri' => $this->uri]);
    }

    public function getTicketings()
    {
        return $this->sendRequest('GET', '/v1/ticketings?fields=@id,title,place,contract,city,wallet&itemsPerPage=15');
    }

    public function createTicketing($uri, $body)
    {
		return $this->sendRequest('POST', $uri, $body);

		//return $this->sendRequest('POST', $uri, json_encode($body));
    }

    private function sendRequest($method, $uri, $body = null)
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->token->getToken(),
            'Accept'        => 'application/json',
        ];

        $response = $this->client->request($method, $uri, [
            'headers' => $headers,
            'body' => $body
        ]);

        $results = json_decode($response->getBody()->getContents(), true);

        return $results;
    }
}
