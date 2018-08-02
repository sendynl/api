Authentication
==============

Our API uses an API token as a parameter in the URL to authenticate the user. The API token has to be supplied for
every request as a query parameter.

To retrieve your token, login in our portal at https://portal.keendelivery.com/ with your credentials and go to
Instellingen > Koppelingen. The token can be found in the field labeled 'API Key'

Verifying your API token
------------------------

To verify if you if the API token is correct, you can make a call to our API to verify the credentials. To do this, you
have to use the following endpoint:

.. code-block:: shell

   $ curl "https://portal.keendelivery.com/api/v2/authorization?api_token=YourAPIToken" \
     -H 'Accept: application/json'

If the API token is correct, you will receive the following response:

.. code-block:: json

   {
     "authorized": true,
     "authorized_as": "developer@keendelivery.com"
   }

Error codes
-----------

==== =====
Code Cause
==== =====
401  The supplied API token is incorrect
==== =====

Example in PHP with Guzzle
--------------------------

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

    $response = $client->get('authorization');