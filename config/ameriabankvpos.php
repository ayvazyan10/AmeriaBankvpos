<?php

return [
    "ClientID" => env('AMERIABANKVPOS_CLIENT_ID', '00000000-0000-0000-0000-000000000000'), // provided by bank
    "Username" => env('AMERIABANKVPOS_USERNAME', '00000000_api'), // provided by bank
    "Password" => env('AMERIABANKVPOS_PASSWORD', '0000000000000000'), // provided by bank
    "Language" => env('AMERIABANKVPOS_LANGUAGE', 'am'), // Interface language: am-Armenian ru-Russian en-English
    "Currency" => env('AMERIABANKVPOS_CURRENCY', '051'), // currency ISO code ((051 - AMD)-(by default) (978 - EUR) (840 - USD) (643 - RUB))
    "TestMode" => env('AMERIABANKVPOS_TEST_MODE', false), // true|false
    "BackUrl" => env('AMERIABANKVPOS_BACK_URL', 'order.payment.check'), // (route: name) redirect back url from bank - success|fail
];
