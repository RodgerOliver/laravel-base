<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelLogUser;

class Task extends Model
{
    use HasFactory, ModelLogUser;

    protected $fillable = [
        'name'
    ];
}
