<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->username = "DylanRodgers98";
        $user->email = "dylanirodgers@aol.com";
        $user->password = "password123";
        $user->email_verified_at = now();
        $user->save();

        $profile = new Profile();
        $profile->user_id = $user->id;
        $profile->display_name = "Dylan Rodgers";
        $profile->bio = "Welcome to my profile!";
        $profile->location = "Abertawe, Cymru";
        $profile->website_url = "https://www.github.com/DylanRodgers98";
        $profile->save();

        Profile::factory()->count(10)->create();
    }
}
