<?php

namespace App\Console\Commands;

use App\Eloquent\Tenant;
use Illuminate\Console\Command;

class DeleteTenantCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenancy:delete-tenant {tenant}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete a tenant website.';

    /**
     * Execute the console command.
     */
    public function __invoke(): void
    {
        $tenant = $this->argument('tenant');

        if ($tenant == 'all') {
            $this->deleteAllTenants();

            return;
        }
    }

    private function deleteAllTenants()
    {
        $tenants = Tenant::all();

        foreach ($tenants as $tenant) {
            $tenant->delete();
        }
    }
}
