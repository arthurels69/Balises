<?php
namespace App\Service;

use Mapado\LeagueOAuth2Provider\Provider\MapadoOAuth2Provider;
use GuzzleHttp\Client;

/*
 * Mode d'emploi :
 * la fonction construct va créer un TOKEN qui va permettre une connexion à l'API Mapado. Les possibilités (POST/ GET
 *  etc...) vont dépendre du SCOPE, qui sera passer en paramètre dans le controller.:
 * exemple -> " $mapadoWrite = new MapadoApi('ticketing:events:write');"
 *
 * Le body de la requete, notamment pour le Post, doit prendre tout un tas de paramètre en Json.
 * Voir doc sous https://ticketing.mapado.net/doc.html#tag/Ticketing
 * Il faut créer un nouvel évènement en plusieurs étapes.
 * 1 - Créer simplement l'évènement (= ticketing) sans date. Impératif : Timezone et Wallet. Ici pour test 1092. A
 * vérifier une fois en prod.
 *  Requete typique :
 * {
    "description": "test",
    "place": "lyon",
    "title": "test",
    "wallet": "/v1/wallets/1092",
    "timezone": "Europe/Paris"
}
 * En response de cette requete, on obtient en autre un IRI, celui du ticketing. Grâce à cette IRI, on va ensuite
 * pouvoir créer un Event_date. Voir doc pour corp de la requete : https://ticketing.mapado.net/doc.html#tag/EventDate
 * exemple :
 *
 *
 * Exemple de Response :
 * {
    "@context": "\/v1\/contexts\/EventDate",
    "@id": "\/v1\/event_dates\/115724",
    "@type": "EventDate",
    "startDate": "2019-07-05T08:19:59+00:00",
    "endDate": "2019-07-05T08:19:59+00:00",
    "startOfEventDay": "2019-07-05T03:00:00+00:00",
    "endOfEventDay": "2019-07-06T03:00:00+00:00",
    "saleStartDate": "2019-07-05T08:19:59+00:00",
    "saleEndDate": "2019-07-05T08:19:59+00:00",
    "ticketing": "\/v1\/ticketings\/13996",
    "ticketPriceList": [],
    "stockContingentList": [],
    "status": "string",
    "validScanNb": 0,
    "soldTickets": 0,
    "refundedTickets": 0,
    "bookedTickets": 0,
    "reservedTickets": 0,
    "contractApproved": true,
    "createdAt": "2019-07-05T08:58:10+00:00",
    "updatedAt": "2019-07-05T08:58:10+00:00",
    "seatConfig": null,
    "nbActiveSeats": null,
    "seatingName": null,
    "eventDatePattern": null,
    "isReservableOnline": true,
    "availableSeatList": [],
    "totalStock": 40,
    "unlimitedStock": false,
    "bookableStock": 40,
    "minPrice": 0,
    "maxPrice": 0,
    "onSale": false,
    "notOnSaleReasons": [
        "saleEndDate",
        "status"
    ],
    "hasTicketPriceOnSale": false,
    "remainingStock": 40,
    "manuallySetStock": 40,
    "issuedTickets": 0,
    "seatReservedList": [],
    "dynamic": false
}
 * Du coup, maintenant on crée un ticket Price :
 *  https://ticketing.mapado.net/doc.html#operation/postTicketPriceCollection
 *
 *
 */
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

       /* $this->token = $provider->getAccessToken('client_credentials', [
            'scope' => $scope,
        ]);*/

        $this->token = $provider->getAccessToken('password', [
        'username' => 'wildcode@test.com',
        'password' => 'wildcode',
        'scope' => $scope
        ]);

        $this->client = new Client(['base_uri' => $this->uri]);
    }

    public function getTicketings()
    {
        dump($this->token->getToken());
        return $this->sendRequest('GET', '/v1/ticketings?fields=@id,title,place,contract,city,wallet&itemsPerPage=15');
    }

    public function createTicketing($uri, $body)
    {
        dump($this->token->getToken());
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
