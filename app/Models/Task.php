<?php

namespace App\Models;

use App\Events\TaskCreated;
use App\Traits\FilterByUser;
use App\Traits\LogUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Task extends Model
{
    use HasFactory, LogUser, FilterByUser, Searchable;

    protected $perPage = 10;

    protected $fillable = [
        'name'
    ];

    protected $dispatchesEvents = [
        'created' => TaskCreated::class,
    ];

    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
            'created_by' => $this->created_by,
        ];
    }

    public static function makeAllSearchableUsing(Builder $builder)
    {
        return $builder->withoutGlobalScopes();
    }

    public static function getSearchFilterAttributes()
    {
        return [
            'name',
            'created_by',
        ];
    }
}
