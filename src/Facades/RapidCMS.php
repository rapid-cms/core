<?php

namespace RapidCMS\Core\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \RapidCMS\Core\RapidCMS
 */
class RapidCMS extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \RapidCMS\Core\RapidCMS::class;
    }
}
