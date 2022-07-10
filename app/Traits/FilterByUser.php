<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

trait FilterByUser
{
    protected static function bootFilterByUser()
    {
        if (Auth::check()) {
            self::addGlobalScope(function (Builder $builder) {
                if(!Auth::user()->hasRole('master')) {
                    $builder->where('created_by', Auth::id());
                }
            });
        }
    }
}
