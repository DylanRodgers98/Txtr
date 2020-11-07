<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "Dylan Rodgers";
        $user->email = "dylanirodgers@aol.com";
        $user->email_verified_at = now();
        $user->password = "password";
        $user->save();

        User::factory()->count(10)->create();
    }
}
