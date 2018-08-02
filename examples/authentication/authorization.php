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
    $response = $client->get('authorization');

    echo sprintf("Authorized as %s\n", json_decode($response->getBody())->authorized_as);
} catch (BadResponseException $e) {
    if ($e->getResponse()->getStatusCode() == 401) {
        echo "The supplied API token is incorrect\n";
    } else {
        echo $e->getMessage() . "\n";
    }
}

