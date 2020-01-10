<?php

namespace Dawson\TVDB;

use Illuminate\Support\Facades\Facade;

class TVDBFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'tvdb';
    }
}