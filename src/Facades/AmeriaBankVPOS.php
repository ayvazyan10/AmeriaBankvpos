<?php

namespace Ayvazyan10\AmeriaBankVPOS\Facades;

use Illuminate\Support\Facades\Facade;

class AmeriaBankVPOS extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'ameriabank-vpos';
    }
}

