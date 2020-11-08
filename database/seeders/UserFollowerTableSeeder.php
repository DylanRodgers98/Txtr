<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserFollowerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (User::get() as $user) {
            $numberOfUsers = rand(0, 10);
            $randomUserIDs = User::inRandomOrder()->where('id', '<>', $user->id)->limit($numberOfUsers)->pluck('id');
            $user->followers()->attach($randomUserIDs);
        }
    }
}
