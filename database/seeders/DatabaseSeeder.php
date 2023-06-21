<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $user = new User();
        $user->name = "Sagar Khunt";
        $user->phone_number = "9725516774";
        $user->email = "sagar@admin.com";
        $user->password = Hash::make('admin@123');
        $user->role_id = '1';
        // $user->user_type = 'admin';
        $user->save();
    }
}
