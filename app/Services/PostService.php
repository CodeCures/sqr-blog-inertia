<?php 

namespace App\Services;

use App\Enums\PostState;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class PostService {

    public static function getPosts($limit = 6)
    {
        return Post::order(request(['order']))
                    ->filter(request(['search']))
                    ->simplePaginate($limit);   
    }

    public function updatePost(Post $post, array $data)
{
        $data['published_at'] = now();

        $post->update($data);
    }

}