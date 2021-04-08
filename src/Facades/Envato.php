<?php

namespace Dipokhalder\Envato\Facades;

use Illuminate\Support\Facades\Facade;

class Envato extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'envato';
    }
}
