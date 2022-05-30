<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Post extends Model
{
    use HasFactory;

    use HasFactory, QueryCacheable;

    /**
     * Specify the amount of time to cache queries.
     * Do not specify or set it to null to disable caching.
     *
     * @var int|\DateTime
     */
    public $cacheFor = 3600;

    public $timestamps = false;

     /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'state',
    ];

    /**
     * casts
     *
     * @var array
     */
    protected $casts = [
        'state' => PostState::class
    ];
}
