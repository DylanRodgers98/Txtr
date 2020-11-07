<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        $post->user_id = DB::table('users')->where('name', 'Dylan Rodgers')->value('id');
        $post->body = "This is my first post!";
        $post->save();

        Post::factory()->count(50)->create();
    }
}
