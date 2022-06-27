<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

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
