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
                'id'                => 1,
                'name'              => 'School Admin',
                'email'             => "admin@{$domain}",
                'email_verified_at' => null,
                'password'          => '$2y$10$2igFKo3ThJNeTPsGzf1/k.G4TX2OlH0wP8HE/qgUzNtva0RLh4iTy',
                'remember_token'    => null,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'id'                => 2,
                'name'              => 'School Teacher',
                'email'             => "teacher@{$domain}",
                'email_verified_at' => null,
                'password'          => '$2y$10$2igFKo3ThJNeTPsGzf1/k.G4TX2OlH0wP8HE/qgUzNtva0RLh4iTy',
                'remember_token'    => null,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'id'                => 3,
                'name'              => 'Parent',
                'email'             => "parent@{$domain}",
                'email_verified_at' => null,
                'password'          => '$2y$10$2igFKo3ThJNeTPsGzf1/k.G4TX2OlH0wP8HE/qgUzNtva0RLh4iTy',
                'remember_token'    => null,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'id'                => 4,
                'name'              => 'Student 1',
                'email'             => "student@{$domain}",
                'email_verified_at' => null,
                'password'          => '$2y$10$2igFKo3ThJNeTPsGzf1/k.G4TX2OlH0wP8HE/qgUzNtva0RLh4iTy',
                'remember_token'    => null,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
        ]);
    }
}
