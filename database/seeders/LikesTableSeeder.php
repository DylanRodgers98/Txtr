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
        foreach (Post::get() as $post) {
            $randomUserIDs = User::inRandomOrder()->limit(rand(0, 10))->pluck('id');
            $post->likedBy()->attach($randomUserIDs);
        }
    }
}
