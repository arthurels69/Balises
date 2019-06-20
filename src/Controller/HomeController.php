<?php

namespace App\Controller;

use App\Service\MapadoApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {

    	$mapadoRead = new MapadoApi('ticketing:events:read');

    	dump($mapadoRead->getTicketings());


    	$mapadoWrite = new MapadoApi('ticketing:events:write');

    	$body = {
		"activityUuid": "string",
  "timezone": "string",
  "permanent": true,
  "eventDateList": [
    {
		"startDate": "2019-06-20T07:16:56Z",
      "endDate": "2019-06-20T07:16:56Z",
      "saleStartDate": "2019-06-20T07:16:56Z",
      "saleEndDate": "2019-06-20T07:16:56Z",
      "ticketing": "string",
      "ticketPriceList": [
        {
			"id": "/v1/ticket_prices/1",
          "facialValue": 1000,
          "type": "reduced",
          "name": "Under 18 ticket",
          "description": "We love our children, so price is reduced for them !",
          "manualSort": 0,
          "saleStartDate": "2019-01-01T18:00:00+0200",
          "saleEndDate": "2019-01-05T18:00:00+0200",
          "templateParameters": [
			"string"
		],
          "eventDate": {},
          "eventDatePattern": "string",
          "tax": {},
          "ticketPriceGroup": {},
          "wallet": "string",
          "ticketStartDate": "2019-06-20T07:16:56Z",
          "ticketExpirationInterval": "string",
          "sellingDeviceList": [
			"string"
		],
          "ticketPriceSeatGroupList": [
			"string"
		],
          "buyable": true,
          "visible": true,
          "offerRuleList": [
			"string"
		],
          "behaviour": "string",
          "totalStock": 100,
          "unlimitedStock": true,
          "valueIncvat": null
        }
      ],
      "stockContingentList": [
		"string"
	],
      "status": "string",
      "seatConfig": "string",
      "seatingName": "string",
      "eventDatePattern": "string",
      "isReservableOnline": true,
      "totalStock": 0,
      "unlimitedStock": true
    }
  ],
  "eventDatePatternList": [
			"string"
		],
  "wallet": "string",
  "isOnSale": true,
  "isOnSaleDemoMode": true,
  "title": "string",
  "slug": "string",
  "activitySlug": "string",
  "description": "string",
  "place": "string",
  "address": "string",
  "city": "string",
  "citySlug": "string",
  "countryCode": "string",
  "imageList": [
			"string"
		],
  "schedule": "string",
  "position": 0,
  "customerRequiredFields": [
			"string"
		],
  "templateParameters": [
			"string"
		],
  "orderNotificationEmailList": [
			"string"
		]
}

    	$mapadoWrite->createTicketing('/v1/ticketings', $body);



        return $this->render('index.html.twig');
    }
}
