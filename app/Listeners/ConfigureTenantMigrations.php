<?php

namespace App\Listeners;

use Tenancy\Hooks\Migration\Events\ConfigureMigrations;

class ConfigureTenantMigrations
{
    public function handle(ConfigureMigrations $event)
    {
        $event->path(database_path('tenant/migrations'));
    }
}
