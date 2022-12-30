<?php

namespace App\Console\Commands;

use App\Eloquent\Tenant;
use Illuminate\Console\Command;
use Tenancy\Tenant\Events\Updated;

class TenancyTriggerMigrationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenancy:trigger-updated-event';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Triggers updated event for each tenant. You can use this if you want to run migrations for all of your tenant database.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Tenant::cursor()->each(function ($tenant) {
            $start = microtime(true);

            $this->warn("Triggering: Updated event for tenant: {$tenant->fqdn}.");

            event(new Updated($tenant));

            $timeElapsedSecs = round((microtime(true) - $start) * 1000);
            $this->info("Triggered: Updated event for tenant: {$tenant->fqdn}. ({$timeElapsedSecs}ms)");
        });
    }
}
