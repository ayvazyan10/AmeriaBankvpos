<?php

namespace Ayvazyan10\AmeriaBankVPOS\Facades;

use Illuminate\Support\Facades\Facade;

class AmeriaBankVPOS extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'ameriabankvpos';
    }
}
