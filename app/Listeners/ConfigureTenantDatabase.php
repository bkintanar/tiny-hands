<?php

namespace App\Listeners;

use Tenancy\Hooks\Database\Events\Drivers\Configuring;

class ConfigureTenantDatabase
{
    public function handle(Configuring $event)
    {
        $overrides = array_merge(['host' => '%'], $event->defaults($event->tenant));

        $event->useConnection('mysql', $overrides);
    }
}
