<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $domain = config('app.domain');

        DB::table('users')->insert([
            [
                'id' => 1,
                'first_name' => 'Site',
                'middle_name' => '',
                'last_name' => 'Admin',
                'email' => "admin@{$domain}",
                'email_verified_at' => now(),
                'password' => '$2y$10$2igFKo3ThJNeTPsGzf1/k.G4TX2OlH0wP8HE/qgUzNtva0RLh4iTy',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'first_name' => 'Site',
                'middle_name' => '',
                'last_name' => 'Moderator',
                'email' => "moderator@{$domain}",
                'email_verified_at' => now(),
                'password' => '$2y$10$2igFKo3ThJNeTPsGzf1/k.G4TX2OlH0wP8HE/qgUzNtva0RLh4iTy',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'first_name' => 'Site',
                'middle_name' => '',
                'last_name' => 'Member',
                'email' => "member@{$domain}",
                'email_verified_at' => now(),
                'password' => '$2y$10$2igFKo3ThJNeTPsGzf1/k.G4TX2OlH0wP8HE/qgUzNtva0RLh4iTy',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
