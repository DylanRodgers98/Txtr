<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserLikedPostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Post::get() as $post) {
            $numberOfUsers = rand(0, 10);
            $randomUserIDs = User::inRandomOrder()->where('id', '<>', $post->user->id)->limit($numberOfUsers)->pluck('id');
            $post->likedBy()->attach($randomUserIDs);
        }
    }
}
