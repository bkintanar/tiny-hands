<?php

namespace App\Listeners;

use Tenancy\Facades\Tenancy;
use Tenancy\Affects\Configs\Events\ConfigureConfig;

class ConfigureTenantIntegrations
{
    public function handle(ConfigureConfig $event)
    {
        if ($event->event->tenant) {
            $event->set('database.default', Tenancy::getTenantConnectionName());
        }
    }
}
