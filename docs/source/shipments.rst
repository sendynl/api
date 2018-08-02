Shipments
=========

Create a shipment
-----------------

To create a shipment, you should make the following request:

.. code-block:: shell

   curl -X "POST" "https://portal.keendelivery.com/api/v2/shipment?api_token=YourAPIToken" \
       -H 'Accept: application/json' \
       -H 'Content-Type: application/json; charset=utf-8' \
       -d $'{
    "product": "DPD",
    "service": "DPD_HOME_DROP_OFF",
    "amount": 1,
    "reference": "Shipment reference",
    "company_name": "KeenDelivery",
    "contact_person": "John Doe",
    "street_line_1": "Wiltonstraat",
    "number_line_1": "41",
    "number_line_1_addition": "",
    "zip_code": "3905 KW",
    "city": "Veenendaal",
    "country": "NL",
    "phone": "0318-513813",
    "email": "developer@keendelivery.com"
    "comment": "This is a comment",
    "predict": 1,
    "weight": 1
  }'

Request values
^^^^^^^^^^^^^^
====================== ====== ===========
Field                  Type   Description
====================== ====== ===========
product                string The shipment to be used. Possible values can be found on :ref:`shipping_methods`.
service                string The service to be used. Possible values can be found on :ref:`shipping_methods`.
amount                 int    The amount of parcels of this shipment
reference              string Your own reference of the shipment
company_name           string The company name of the addressee
contact_person         string The name of the addressee
street_line_1          string The street of the addressee
number_line_1          string The house number of the addressee
number_line_1_addition string The addition of the house number of the addressee
zip_code               string The postal code of the addressee
city                   string The city of the addressee
country                string The country code of the addressee in ISO-3166-1 format
phone                  string The phone number of the addressee
email                  string The e-mail address of the addressee
comment                string A comment of the address. Will be used as second address line on the label if possible.
weight                 int    The weight of the parcel in kilograms. Must be entered as an integer.
====================== ====== ===========

Besides these request values, other field must be supplied to the request according the response of the shipping_methods
endpoint. In the example above you can see that the field ``predict`` is included. This field is a required field for
this specific service, as you can see in the example response of the shipping_methods endpoint.

Response values
^^^^^^^^^^^^^^^

The response wil be like this (shortened for readability):

.. code-block:: json

   {
     "shipment_id": 12345678,
     "label": "",
     "track_and_trace": {
       "09988914957226": "https:\/\/tracking.dpd.de\/parcelstatus?locale=nl_NL&query=09988914957226"
     }
   }

=============== ===========
Property        Description
=============== ===========
shipment_id     The id of the generated shipment.
label           A base64 encoded string of the label in the requested format
track_and_trace List of parcel numbers with the corresponding links to the track and trace page
=============== ===========

Error codes
^^^^^^^^^^^

==== =====
Code Cause
==== =====
401  The supplied API token is incorrect
422  Something is wrong with the request. The errors are returned in the response body as a JSON object
==== =====

Example in PHP with Guzzle
^^^^^^^^^^^^^^^^^^^^^^^^^^

.. code-block:: php

    <?php

    use GuzzleHttp\Client;

    $client = new Client([
        'base_uri' => 'https://portal.keendelivery.com/api/v2/',
        'headers' => [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ],
        'query' => ['api_token' => KEENDELIVERY_API_TOKEN],
    ]);

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