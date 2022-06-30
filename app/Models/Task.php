<?php

namespace App\Models;

use App\Traits\FilterByUser;
use App\Traits\LogUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory, LogUser, FilterByUser;

    protected $fillable = [
        'name'
    ];
}
