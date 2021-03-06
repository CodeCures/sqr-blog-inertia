<?php

namespace App\Models;

use App\Enums\PostState;
use App\Helpers\PostImage;
use App\Scopes\UserAuthenticatedScope;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Post extends Model
{

    use HasFactory;
    // use QueryCacheable;

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
        'published_at'
    ];

    /**
     * casts
     *
     * @var array
     */
    protected $casts = [
        'state' => PostState::class
    ];

    /**
     * Get the user that owns the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * scopeFilter
     *
     * @param  mixed $query
     * @param  mixed $filters
     * @return void
     */
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, fn ($query, $search) => 
                $query->where('title', 'like', '%'. $search . '%')
                      ->orWhere('description', 'like', '%'. $search .'%')  
            );
    }

    /**
     * scopeOrder
     *
     * @param  mixed $query
     * @param  mixed $order
     * @return void
     */
    public function scopeOrder($query, $order)
    {
        $query->when($order['order'] ?? 'DESC', fn ($query, $order) => 
            $query->orderBy('published_at', $order)
        );
    }

     /**
     * Get the post's image.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn () => new PostImage(),
        );
    }

    /**
     * format post date.
     *
     * @return String
     */
    protected function scopePublicationDate()
    {
        return Carbon::parse($this->published_at)->toFormattedDateString();
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new UserAuthenticatedScope);

        static::creating(function ($post) {
            if (auth()->check()) {
                $post->user_id = auth()->id();
            }
            $post->slug = Str::slug(Str::words($post->title, 5, ''), '-');
        });
    }
}
