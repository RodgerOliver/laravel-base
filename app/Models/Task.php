<?php

namespace App\Models;

use App\Events\TaskCreated;
use App\Traits\FilterByUser;
use App\Traits\LogUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Task extends Model
{
    use HasFactory, LogUser, FilterByUser, Searchable;

    protected $fillable = [
        'name'
    ];

    protected $dispatchesEvents = [
        'created' => TaskCreated::class,
    ];

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
        ];
    }
}
