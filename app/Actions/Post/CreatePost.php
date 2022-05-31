<?php 

namespace App\Actions\Post;

use App\Models\Post;

class CreatePost
{
    
    
    /**
     * execute
     *
     * @param  mixed $request
     * @return Post
     */
    public function execute(array $data) : Post
    {
        return Post::UpdateOrCreate($data, 
                        [
                            'title' => $data['title'], 
                            'description' => $data['description'],
                        ]);
    }

}
