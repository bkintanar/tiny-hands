<?php

namespace App\Providers;

use App\Listeners\ConfigureTenantSeeds;
use Illuminate\Auth\Events\Registered;
use App\Listeners\ConfigureApplicationUrl;
use App\Listeners\ConfigureTenantDatabase;
use App\Listeners\ResolveTenantConnection;
use App\Listeners\ConfigureTenantConnection;
use App\Listeners\ConfigureTenantMigrations;
use Tenancy\Affects\URLs\Events\ConfigureURL;
use App\Listeners\ConfigureTenantIntegrations;
use Tenancy\Affects\Configs\Events\ConfigureConfig;
use Tenancy\Hooks\Migration\Events\ConfigureMigrations;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Tenancy\Affects\Connections\Events\Resolving as ResolvingConnection;
use Tenancy\Hooks\Database\Events\Drivers\Configuring as ConfiguringDatabase;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Tenancy\Affects\Connections\Events\Drivers\Configuring as ConfiguringConnection;
use Tenancy\Hooks\Migration\Events\ConfigureSeeds;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        ConfigureMigrations::class => [
            ConfigureTenantMigrations::class,
        ],

        ConfiguringConnection::class => [
            ConfigureTenantConnection::class,
        ],

        ConfiguringDatabase::class => [
            ConfigureTenantDatabase::class,
        ],

        ResolvingConnection::class => [
            ResolveTenantConnection::class,
        ],

        ConfigureConfig::class => [
            ConfigureTenantIntegrations::class,
        ],

        ConfigureURL::class => [
            ConfigureApplicationUrl::class,
        ],

        ConfigureSeeds::class => [
            ConfigureTenantSeeds::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
