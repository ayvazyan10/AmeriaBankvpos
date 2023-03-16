<?php

use Ayvazyan10\AmeriaBankVPOS\AmeriaBankVPOS;

if (!function_exists('ameriabank')) {
    function ameriabank(): AmeriaBankVPOS
    {
        return app(AmeriaBankVPOS::class);
    }
}
