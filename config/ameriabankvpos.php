<?php

return [
    "ClientID" => '00000000-0000-0000-0000-000000000000', // provided by bank
    "Username" => "00000000_api", // provided by bank
    "Password" => "0000000000000000", // provided by bank
    "Language" => "am", // Interface language: am-Armenian ru-Russian en-English
    "Currency" => "051", // currency ISO code ((051 - AMD)-(by default) (978 - EUR) (840 - USD) (643 - RUB))
    "TestMode" => false, // true|false
    "BackUrl" => 'order.payment.check', // (route: name) redirect back url from bank - success|fail
];
