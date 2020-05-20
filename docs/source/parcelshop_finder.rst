Parcel Shops finder
===================

It is possible to offer your customer the possibility to let the shipment be delivered on a parcel shop. In order to
find the closest parcel shop, you should use this endpoint, as you need the ID of the parcel shop when creating a
shipment.

Get the parcel shops
^^^^^^^^^^^^^^^^^^^^

To get the closest parcel shops, you should make the following request

.. code-block:: shell

    $ curl -X "POST" "https://portal.keendelivery.com/api/v2/parcel-shop/search?api_token=YourAPIToken" \
         -H 'Accept: application/json' \
         -H 'Content-Type: application/json' \
         -d $'{
      "country": "NL",
      "street_line_1": "Wiltonstraat",
      "city": "Veenendaal",
      "number_line_1": "41",
      "products": [
        "DPD",
        "DHL"
      ]
    }'

Request values
^^^^^^^^^^^^^^

============= ====== ===========
Field         Type   Description
============= ====== ===========
street_line_1 string The street name of the address
number_line_1 string The house number of the address
zip_code      string The postal code of the address
city          string The city of the address
country       string The country code of the address. This field is always required.
limit         int    The amount of parcel shops you'd like to receive. If this field is not included, it defaults to 5.
products      array  Which carriers you'd like the parcel shops of. Currently only DPD and DHL are supported.
latitude      float  The latitude of the address
longitude     float  The longitude of the address
============= ====== ===========

Note that not all fields are required. When you already have the latitude and the longitude off the address, you don't
have to include the street_line_1, number_line_1, zip_code and city fields.

The field for zip code is only required if you don't include street_line_1, number_line_1 and city in the request.

Response values
^^^^^^^^^^^^^^^

The response will be like this (shortened for readability):

.. code-block:: json

    {
      "parcel_shops":{
        "DPD":[
          {
            "id":480004,
            "name":"A12TOYS",
            "street":"STORKSTRAAT",
            "house_number":"1A",
            "country":"NL",
            "zip_code":"3905KX",
            "city":"Veenendaal",
            "longitude":5.55926,
            "latitude":52.03905,
            "opening_hours":[
              {
                "afternoon_close":"17:00",
                "afternoon_open":"16:00",
                "morning_open":"11:00",
                "morning_close":"15:00",
                "weekday":1
              }
            ]
          }
        ]
      }
    }

============= ===========
Field         Description
============= ===========
parcelshops   Holds the parcelshops seperated by carrier. (DPD or DHL)
id            The id of the parcel shop. You will need this when creating a shipment.
name          The name of the parcel shop.
street        The street of the parcel shop.
house_number  The house number of the parcel shop.
country       The country code of the parcel shop.
zip_code      The zip code of the parcel shop
city          The city of the parcel shop
longitude     The longitude of the parcel shop. This can be used to place the parcel shops on a map.
latitude      The latitude of the parcel shop. This can be used to place the parcel shops on a map.
opening_hours An array with the opening hours of the parcel shop. Each day the shop is open, is listed as an item in
              this array. If a day misses, you can safely assume the shop is'nt open on that day.
============= ===========

Error codes
^^^^^^^^^^^

==== =====
Code Cause
==== =====
401  The supplied API token is incorrect
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
        'query' => ['api_token' => 'YourAPIToken'],
    ]);

    $response = $client->post(
        'parcel-shop/search',
        [
            'form_params' => [
                'zip_code' => '3905KW',
                'street_line_1' => 'Wiltonstraat',
                'number_line_1' => '41',
                'country' => 'NL',
                'city' => 'Veenendaal',
                'products' => ['DPD', 'DHL'],
            ]
        ]
    );
