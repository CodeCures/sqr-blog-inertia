<?php 

namespace App\Actions\Post;

use App\Enums\PostState;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class ImportPost
{
    private $createPost;

    private $admin;

    public function __construct()
    {
        $this->createPost = new CreatePost;

        $this->admin = User::firstWhere('role', 'admin');
    }
    
    /**
     * execute
     *
     * @param  mixed $request
     * @return Post
     */
    public function execute()
    {
        $posts = $this->fetchPosts();

        if ($this->isNotAnEmpty($posts)) {
            $this->registerAll($posts);

            return "Posts Imported";
        }
    }

    private function fetchPosts()
    {
        $response = Http::get('https://sq1-api-test.herokuapp.com/posts')->throw();

        if ($response->successful()) {
            return $response->object()->data;
        }
    }

    private function isNotAnEmpty($data)
    {
        return is_array($data) && !empty($data);
    }

    private function registerAll($posts)
    {
        foreach ($posts as $post) {
            $this->createPost->execute([
                'user_id' => $this->admin->id,
                'title' => $post->title,
                'description' => $post->description,
                'state' => PostState::Published,
                'published_at' => Carbon::parse($post->publication_date)
            ]);
        }
    }

}
