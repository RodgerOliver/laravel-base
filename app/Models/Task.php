<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\TaskCreated;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    protected $dispatchesEvents = [
        'created' => TaskCreated::class,
    ];
}
