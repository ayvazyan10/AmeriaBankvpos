<?php

namespace Ayvazyan10\AmeriaBankVPOS\Facades;

use Ayvazyan10\AmeriaBankVPOS\AmeriaBankVPOS;
use Illuminate\Support\Facades\Facade;
/**
 *
 * @see AmeriaBankVPOS
 */
class AmeriaBankVPOSFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'ameriabank-vpos';
    }
}

