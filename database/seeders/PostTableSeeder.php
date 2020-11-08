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

        /**
         * Using for-loop rather than ->count(50) on factory because ->create()
         * saves all created records in one transaction. This means that within
         * the factory the parent_post_id will only ever be the id of $post
         * created above, as it will be the only Post persisted in the database.
         * By creating one Post at a time with the factory, each Post is saved
         * within its own transaction, and so becomes available for future
         * Posts to reference its id as a foreign key for parent_post_id. This
         * sacrifice in performance allows for the avoidance of looping through
         * Posts after the factory creates them and setting the parent_post_id
         * manually, and so, in essence, is actually better for performance.
         */
        for ($i = 0; $i < 50; $i++) {
            Post::factory()->createOne();
        }
    }
}
