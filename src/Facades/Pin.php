<?php

namespace Intellicore\Pin\Facades;

use Illuminate\Support\Facades\Facade;

class Pin extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'pin';
    }
}
