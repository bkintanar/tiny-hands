<?php

namespace App\Console\Commands;

use App\Jobs\CreateTenant;
use Illuminate\Console\Command;
use App\Generators\UuidGenerator;

class CreateTenantCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenancy:create-tenant {tenant}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new tenant website.';

    /**
     * Execute the console command.
     */
    public function __invoke(): void
    {
        $tenant = $this->argument('tenant');

        $domain = config('app.domain');

        $url = $tenant . '.' . $domain;

        $data = [
            'uuid'                  => (new UuidGenerator())->generate(),
            'fqdn'                  => $url,
            'first_name'            => ucfirst($tenant),
            'last_name'             => 'Admin',
            'email'                 => "{$tenant}@{$domain}",
            'password'              => bcrypt('password'),
            'password_confirmation' => bcrypt('password'),
            'name'                  => ucfirst($tenant),
        ];

        $website = (new CreateTenant($data))->handle();

        $this->info('New Tenant Created: '. $url . PHP_EOL);
    }
}
