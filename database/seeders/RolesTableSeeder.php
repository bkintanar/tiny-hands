<?php

namespace Database\Seeders;

use HRis\Auth\Eloquent\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();

        DB::table('roles')->insert([
            ['name' => 'super-admin', 'guard_name' => 'api'],
        ]);

        $role = Role::first();

        $role->givePermissionTo(Permission::all());

        (User::find(1))->assignRole($role);
    }
}
