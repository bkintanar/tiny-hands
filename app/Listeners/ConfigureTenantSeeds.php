<?php

namespace App\Listeners;

use Database\Seeders\RolesTableSeeder;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\StatusesTableSeeder;
use Database\Seeders\AdmissionsTableSeeder;
use Database\Seeders\AcademicTermsTableSeeder;
use Database\Seeders\AcademicLevelsTableSeeder;
use Tenancy\Hooks\Migration\Events\ConfigureSeeds;
use Database\Seeders\AcademicDepartmentsTableSeeder;
use Database\Seeders\AcademicLevelAcademicTermTableSeeder;

class ConfigureTenantSeeds
{
    public function handle(ConfigureSeeds $event)
    {
        $event->seed(UsersTableSeeder::class);
        $event->seed(RolesTableSeeder::class);
    }
}
