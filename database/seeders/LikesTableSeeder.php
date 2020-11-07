<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class LikesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $iterations = rand(10, 50);
        for ($i = 0; $i < $iterations; $i++) {
            $postId = Post::inRandomOrder()->first()->id;
            User::inRandomOrder()->first()->likedPosts()->syncWithoutDetaching($postId);
        }
    }
}
