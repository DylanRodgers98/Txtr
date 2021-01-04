<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // seed admin user
        $admin = new User();
        $admin->admin = true;
        $admin->username = "Admin";
        $admin->email = "admin@admin.com";
        $admin->password = Hash::make("admin123");
        $admin->email_verified_at = now();
        $admin->save();

        $adminProfile = new Profile();
        $adminProfile->user_id = $admin->id;
        $adminProfile->display_name = "Admin";
        $adminProfile->save();

        // seed normal user
        $user = new User();
        $user->username = "DylanRodgers98";
        $user->email = "dylanirodgers@aol.com";
        $user->password = Hash::make("password123");
        $user->email_verified_at = now();
        $user->save();

        $profile = new Profile();
        $profile->user_id = $user->id;
        $profile->display_name = "Dylan Rodgers";
        $profile->bio = "Welcome to my profile!";
        $profile->location = "Abertawe, Cymru";
        $profile->website_url = "https://www.github.com/DylanRodgers98";
        $profile->save();

        User::factory()
            ->hasProfile()
            ->count(10)
            ->create();
    }
}
