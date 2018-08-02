<?php

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../constants.php';

$client = new Client([
    'base_uri' => 'https://portal.keendelivery.com/api/v2/',
    'headers' => [
        'Accept' => 'application/json',
        'Content-Type' => 'application/json',
    ],
    'query' => ['api_token' => KEENDELIVERY_API_TOKEN],
]);

try {
    $response = $client->post(
        'shipment',
        [
            'body' => [
                "company_name"=> "KeenDelivery",
                "street_line_1"=> "Wiltonstraat",
                "number_line_1"=> "41",
                "number_line_1_addition"=> "",
                "zip_code"=> "3905 KW",
                "city"=> "Veenendaal",
                "country"=> "NL",
                "contact_person"=> "John Doe",
                "phone"=> "0318-513813",
                "comment"=> "This is a comment",
                "email"=> "developer@keendelivery.com",
                "reference"=> "Referentie",
                "product"=> "DPD",
                "service"=> "DPD_HOME_DROP_OFF",
                "amount"=> 1,
                "weight"=> 1,
                "predict"=> 1,
            ]
        ]
    );
} catch (BadResponseException $e) {
    if ($e->getResponse()->getStatusCode() == 401) {
        echo "The supplied API token is incorrect\n";
    } else {
        echo $e->getMessage() . "\n";
    }
}