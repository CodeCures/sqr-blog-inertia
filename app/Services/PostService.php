<?php 

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class PostService {

    public static function getPosts($limit = 6)
    {
        return Post::order(request(['order']))
                    ->filter(request(['search']))
                    ->simplePaginate($limit);   
    }

}