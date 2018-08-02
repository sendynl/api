Shipping methods
================

To create a shipment, you have to supply a shipping method and a service. Because the shipping methods can be enabled
and disabled in the portal, you should rely on the results of this endpoint and never hard code these values within your
application. The available shipping methods could change, but we highly encourage your to cache the result of this
request for 24 hours.

Retrieving a list of available shipping methods
-----------------------------------------------

To retrieve the list of available shipping methods and services, you should make to following request

.. code-block:: shell

   $ curl "https://portal.keendelivery.com/api/v2/shipping_methods?api_token=YourAPIToken" \
     -H 'Accept: application/json'

Return values
^^^^^^^^^^^^^

The response will be like this (shortened for readability):

.. code-block:: json

   {
    "shipping_methods": {
      "1": {
        "value": "DPD",
        "text": "DPD",
        "services": {
          "1": {
            "value": "DPD_HOME_DROP_OFF",
            "text": "Home (naar particulieren) - Inleveren",
            "options": {
              "1": {
                "field": "predict",
                "text": "Predict ",
                "type": "selectbox",
                "mandatory": 1,
                "choices": {
                  "sms": {
                    "value": 1,
                    "text": "SMS notificatie"
                  },
                  "email": {
                    "value": 2,
                    "text": "E-mail notificatie"
                  }
                }
              },
              "2": {
                "field": "weight",
                "text": "Gewicht ",
                "type": "textbox",
                "mandatory": 1,
                "choices": null
              },
              "3": {
                "field": "saturday_delivery",
                "text": "Zaterdaglevering ",
                "type": "checkbox",
                "mandatory": 0,
                "choices": null
              },
              "4": {
                "field": "cod",
                "text": "Rembours ",
                "type": "checkbox",
                "mandatory": 0,
                "choices": null
              },
              "5": {
                "field": "cod_value",
                "text": "Rembours waarde ",
                "type": "textbox",
                "mandatory": 0,
                "choices": null
              },
              "6": {
                "field": "send_track_and_trace_email",
                "text": "Verstuur track&trace e-mail ",
                "type": "checkbox",
                "mandatory": 0,
                "choices": null
              },
              "7": {
                "field": "bcc_email",
                "text": "BCC e-mailadres voor track&trace e-mail ",
                "type": "email",
                "mandatory": 0,
                "choices": null
              }
            }
          }
        }
      }
    }

shipping_methods
""""""""""""""""

======== ===========
Property Description
======== ===========
value    The value to be entered in the ``product`` field when creating a shipment
text     The textual representation of the shipping method
services The list with all the services that are available for the shipping method
======== ===========

services
""""""""
======== ===========
Property Description
======== ===========
value    The value the be entered in the ``service`` field when creating a shipment
text     The textual representation of the service
options  The available options for the service
======== ===========

options
"""""""
========= ===========
Property  Description
========= ===========
field     The field to be included in the request to create a shipment
text      The textual representation of the options
type      The type of form field to be used. This is used in our plug-ins.
mandatory Whether of nor the field is required. ``1`` means the field is required, ``0`` means it can be omitted
choices   Contains a list of choices which can be entered as a value for the field. If this is ``null`` there are no
          choices available
========= ===========

choices
"""""""
========= ===========
Property  Description
========= ===========
value     The value to be entered in the field for the option
text      The textual representation of the choice
========= ===========

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

   $response = $client->get('shipping_methods');