

## Getting Started for Balises

### Prerequisites

1. Check composer is installed
2. Check yarn & node are installed

### Install

1. Clone this project
2. Run `composer install`
3. Run `yarn install`
4. Run `yarn encore dev`

### Working

1. Run `php bin/console server:run` to launch your local php web server
2. Run `yarn run dev --watch` to launch your local server for assets

### Testing

1. Run `./bin/phpcs` to launch PHP code sniffer
2. Run `./bin/phpstan analyse src --level 5` to launch PHPStan

## Deployment

Add additional notes about how to deploy this on a live system

## Built With

* [Symfony](https://github.com/symfony/symfony)
* [GrumPHP](https://github.com/phpro/grumphp)
* [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer)
* [PHPStan](https://github.com/phpstan/phpstan)
* [Travis CI](https://github.com/marketplace/travis-ci)

## Contributing

Please read [CONTRIBUTING.md](https://gist.github.com/PurpleBooth/b24679402957c63ec426) for details on our code of conduct, and the process for submitting pull requests to us.

## Mapado
Wallet ID : 1092. This is a mandatory information to pass in Ticketing.

All codes related to Mapado are located in /src/MapadoController and /Service/MapadoApi. 
__Construct funcrtion in MapadoService will provide a valid Token to write and read. 
Following docs are available : 
https://ticketing.mapado.net/doc.html#section/Versionning
https://github.com/mapado/rest-client-sdk/blob/master/README.md

3 entry points : 
-1/ Ticketing : 
    eg. --> 
    {
	"description": "test",
	"place": "lyon",
	"title": "test",
	"wallet": "/v1/wallets/1092",
	"timezone": "Europe/Paris",
	"isOnSale" : true
  }
  
-2/ Event_dates : 
  eg. -->
  {
	"startDate": "2019-07-05T14:19:59Z",
	"endDate": "2019-07-10T08:19:59Z",
	"saleStartDate": "2019-07-05T14:19:59Z",
	"saleEndDate": "2019-07-10T08:19:59Z",
	"ticketing": "/v1/ticketings/13999",
	"eventDatePattern": "d-m-y-h-i",
	"totalStock" : 40
  }
-3/ Ticket_prices : 
  eg. --> 
  {
  "facialValue": 20,
  "type": "reduced",
  "eventDate": {
                  "startDate": "2016-02-05T20:30:00+00:00",
                  "endDate": null,
                  "startOfEventDay": "2016-02-05T04:00:00+00:00",
                  "endOfEventDay": "2016-02-06T04:00:00+00:00",
                  "saleStartDate": null,
                  "saleEndDate": null,
                  "ticketing": "\/v1\/ticketings\/3",
                  "onSale": false,
                  "remainingStock": null,
                  "manuallySetStock": null,
                  "issuedTickets": 0,
                  "dynamic": false
              },
  "tax": {
      "rate": 0.2,
      "countryCode": "FR"
    },
  "wallet" : "/v1/wallets/1092",
  "buyable": true,
  "visible": true,
  "eventDatePattern": null
  }
  
  We are stucked at level 3 / Ticket_prices : invalid value for eventDatePattern; A URI is expected. Tried many variations, none    work. Contact with Mapado needed to go futher.
  
  Felinn is in CC of all emails with Mapado. Last mails : 04/07/2019 16:57

Mapado's Balise Mini site: 
https://54yzsyel.mapado.com/en/


## Authors

Julien Beauhaire
Nathalie Cortès
Foucauld Gaudin
Kevin Heitz
Jamal Labrhaila
Thomas Rey


## Acknowledgments

