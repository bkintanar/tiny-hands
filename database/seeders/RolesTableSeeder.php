<?php

namespace Database\Seeders;

use App\Eloquent\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesTableSeeder extends Seeder
{
    public const ROLE_ID_ADMIN = 1;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();

        $roles = [
            ['name' => 'admin', 'guard_name' => 'api', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'teacher', 'guard_name' => 'api', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'parent', 'guard_name' => 'api', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'student', 'guard_name' => 'api', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('roles')->insert($roles);

        foreach ($roles as $k => $name) {
            $role = Role::where('name', $name)->first();

            if ($k+1 == self::ROLE_ID_ADMIN) {
                $role->givePermissionTo(Permission::all());
            }

            (User::find($k+1))->assignRole($role);
        }
    }
}
