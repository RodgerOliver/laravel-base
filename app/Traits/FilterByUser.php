<?php

namespace App\Traits;

use App\Scopes\FilterByUserScope;

trait FilterByUser
{
    protected static function bootFilterByUser()
    {
        self::addGlobalScope(new FilterByUserScope);
    }
}
