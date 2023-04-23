<?php

/*
|--------------------------------------------------------------------------
| Additional information
|--------------------------------------------------------------------------
|
| In the testing environment, it is necessary to select OrderID from the range of 2923001-2924000,
| and specify the amount as 10 AMD. The free testing system provides the ability to perform payments in one phase,
| as well as the Refund and Cancel transactions. Additional information is required to execute payments and related
| transactions in two phases, in order to receive the corresponding authorization.
|
| Note that the test is considered successful if it is performed via the Rest API and at least 5 payments
| are registered with a completed status, without any refunds or cancellations.
|
|--------------------------------------------------------------------------
*/

return [
    // ClientID - Provided by AmeriaBank
    "ClientID" => env('AMERIABANKVPOS_CLIENT_ID', '00000000-0000-0000-0000-000000000000'),

    // Username - Provided by AmeriaBank
    "Username" => env('AMERIABANKVPOS_USERNAME', '00000000_api'),

    // Password - Provided by AmeriaBank
    "Password" => env('AMERIABANKVPOS_PASSWORD', '0000000000000000'),

    // Interface language: am-Armenian ru-Russian en-English
    "Language" => env('AMERIABANKVPOS_LANGUAGE', 'am'),

    // Currency ISO code ((051 - AMD)-(by default) (978 - EUR) (840 - USD) (643 - RUB))
    "Currency" => env('AMERIABANKVPOS_CURRENCY', '051'),

    // Testing mode - true|false
    "TestMode" => env('AMERIABANKVPOS_TEST_MODE', false),

    // Route:name - redirect back url from bank - SUCCESS|FAIL
    "BackUrl" => env('AMERIABANKVPOS_BACK_URL') ? env('AMERIABANKVPOS_BACK_URL') : 'home',
];
