Print labels
============

To combine the labels of multiple shipments into one file to print them, you should make to following request:

.. code-block:: shell

   $ curl -X "POST" "https://portal.keendelivery.com/api/v2/label?api_token=YourAPIToken" \
       -H 'Accept: application/json' \
       -H 'Content-Type: application/json' \
       -d $'{
         "shipments": [
            1234567,
            1234568,
            1234569
         ]
       }'

Request values
^^^^^^^^^^^^^^
========= ===== ===========
Field     Type  Description
========= ===== ===========
shipments array The array with one or more ID's of the shipment to fetch the labels for
========= ===== ===========

Reponse values
^^^^^^^^^^^^^^

The response will be like this (shortened for readability):

.. code-block:: json

   {
     "labels": "",
   }

=============== ===========
Property        Description
=============== ===========
labels          Contains the labels encoded with base64. The format of the labels is according to the settings in the
                portal. (Instellingen > Print instellingen)
=============== ===========

Error codes
^^^^^^^^^^^

==== =====
Code Cause
==== =====
401  The supplied API token is incorrect
422  Something is wrong with the request. The errors are returned in the response body as a JSON object
==== =====

.. code-block:: php

    <?php

    use GuzzleHttp\Client;

    $client = new Client([
        'base_uri' => 'https://portal.keendelivery.com/api/v2/',
        'headers' => [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ],
        'query' => ['api_token' => 'YourApiToken'],
    ]);

    $response = $client->post(
        'label',
        ['json' => ['shipments' => [123456, 123457, 123458]]]
    );

    file_put_contents('labels.pdf', base64_decode(json_decode($response->getBody())->labels));
