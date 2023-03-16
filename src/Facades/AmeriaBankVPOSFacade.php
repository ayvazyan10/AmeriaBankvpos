<?php

namespace Ayvazyan10\AmeriaBankVPOS\Facades;

use Ayvazyan10\AmeriaBankVPOS\AmeriaBankVPOS;
use Illuminate\Support\Facades\Facade;
/**
 *
 * @see AmeriaBankVPOS
 */
final class AmeriaBankVPOSFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'ameriabankvpos';
    }
}

