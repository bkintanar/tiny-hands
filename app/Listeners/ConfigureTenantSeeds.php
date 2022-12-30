<?php

namespace App\Listeners;

use Database\Seeders\RolesTableSeeder;
use Database\Seeders\UsersTableSeeder;
use Tenancy\Hooks\Migration\Events\ConfigureSeeds;

class ConfigureTenantSeeds
{
    public function handle(ConfigureSeeds $event)
    {
        $event->seed(UsersTableSeeder::class);
        $event->seed(RolesTableSeeder::class);
    }
}
