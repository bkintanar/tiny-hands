<?php

namespace App\Listeners;

use Tenancy\Affects\URLs\Events\ConfigureURL;

class ConfigureApplicationUrl
{
    public function handle(ConfigureURL $event)
    {
        if ($tenant = $event->event->tenant) {
            $event->changeRoot('https://'.$tenant->fqdn);
        }
    }
}
