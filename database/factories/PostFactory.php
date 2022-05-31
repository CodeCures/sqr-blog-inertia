<?php

namespace Database\Factories;

use App\Enums\PostState;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = $this->faker->sentence(6);

        return [
            'user_id'       => 1,
            'title'         => $title,
            'slug'         => $title,
            'description'   => $this->faker->sentence(50),
            'state'         => PostState::Published,
            'published_at' => now()
        ];
    }
}
