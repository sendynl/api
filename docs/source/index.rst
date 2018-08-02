.. KeenDelivery API documentation master file, created by
   sphinx-quickstart on Wed Aug  1 10:19:00 2018.
   You can adapt this file completely to your liking, but it should at least
   contain the root `toctree` directive.

Introduction
============

Welcome to the KeenDelivery API documentation. Here you will find the resource addresses and the explanation on how to
use our API.

All of the endpoints start with ``https://portal.keendelivery.com/api/v2`` and all the requests must use the following
headers:

============ ================ =============================
Header       Value            Comments
============ ================ =============================
Accept       application/json
Content-Type application/json Not required for GET requests
============ ================ =============================

Examples
--------

The examples as listed in the documentation can also be found on GitHub: https://github.com/keendelivery/api

.. toctree::
   :maxdepth: 3

   authentication
   shipping_methods
   shipments
   labels
   parcelshop_finder
