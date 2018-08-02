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
        'parcel-shop/search',
        [
            'body' => [
                'street_line_1' => 'Wiltonstraat',
                'number_line_1' => '41',
                'country' => 'NL',
                'city' => 'Veenendaal',
                'products' => ['DPD', 'DHL'],
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