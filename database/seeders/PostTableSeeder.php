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
        $this->seedLikesForPost($post);

        /**
         * Using a for-loop rather than count(50) on factory because create()
         * creates the required amount of records using the definition in the
         * factory and THEN persists them to the database. This means that
         * within the factory the parent_post_id will only ever be the id of
         * $post created above, as it will be the only Post persisted in the
         * database at the time of creation. By creating one Post at a time,
         * its id then becomes available for future Posts created by the
         * factory to reference as a foreign key for parent_post_id.
         * This for-loop also seeds 'likes' for each created Post. (Note: this
         * could be done within an afterCreating callback configured within the
         * factory, however doing this outside of the factory actually performs
         * around 200-300ms faster.)
         */
        for ($i = 0; $i < 50; $i++) {
            $postFromFactory = Post::factory()->createOne();
            $this->seedLikesForPost($postFromFactory);
        }
    }

    private function seedLikesForPost(Post $post)
    {
        $numberOfUsers = rand(0, 10);
        $randomUserIDs = User::inRandomOrder()->limit($numberOfUsers)->pluck('id');
        $post->likedBy()->attach($randomUserIDs);
    }
}
