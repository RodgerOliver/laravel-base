<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait ModelLogUser
{
    protected static function boot()
    {
        parent::boot();
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
