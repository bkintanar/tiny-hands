<?php

namespace App\Listeners;

use Database\Seeders\RolesTableSeeder;
use Tenancy\Hooks\Migration\Events\ConfigureSeeds;

class ConfigureTenantSeeds
{
    public function handle(ConfigureSeeds $event)
    {
        $event->seed(RolesTableSeeder::class);
    }
}
