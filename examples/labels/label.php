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
        'label',
        ['body' => ['shipments' => [123456, 123457, 123458]]]
    );

    file_put_contents('labels.pdf', base64_decode(json_decode($response->getBody())->labels));
} catch (BadResponseException $e) {
    if ($e->getResponse()->getStatusCode() == 401) {
        echo "The supplied API token is incorrect\n";
    } elseif ($e->getResponse()->getStatusCode() == 422) {
        echo "Something is wrong with the request: \n\n";
        echo "Error: " . json_decode($response->getBody())->error . "\n";
    } else {
        echo $e->getMessage() . "\n";
    }
}