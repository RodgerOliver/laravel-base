<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait LogUser
{
    protected static function bootLogUser()
    {
        if(Auth::check()) {
            self::creating(function($model) {
                $model->created_by = Auth::id();
                $model->updated_by = Auth::id();
            });
            self::updating(function($model) {
                $model->updated_by = Auth::id();
            });
        }
    }
}
