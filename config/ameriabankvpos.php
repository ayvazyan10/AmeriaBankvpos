<?php

return [
    "ClientID" => '00000000-0000-0000-0000-000000000000', // provided by bank
    "Username" => "00000000_api", // provided by bank
    "Password" => "0000000000000000", // provided by bank
    "Currency" => "051", // currency ISO code (current: AMD)
    "TestMode" => false, // true|false
    "BackUrl" => 'order.payment.check', // (route: name) redirect back url from bank - success|fail
];
