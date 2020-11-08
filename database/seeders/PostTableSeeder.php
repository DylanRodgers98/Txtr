<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = new Post();
        $post->user_id = User::where('name', 'Dylan Rodgers')->value('id');
        $post->body = "This is my first post!";
        $post->save();

        Post::factory()->count(50)->create();
    }
}
