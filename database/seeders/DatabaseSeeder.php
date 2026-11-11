<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\AdminSeeder;
use Database\Seeders\DepartmentSeeder;
use Database\Seeders\OfficialSeeder;
use Database\Seeders\ManagementSeeder;
use Database\Seeders\AnnualEventSeeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            DepartmentSeeder::class,
            OfficialSeeder::class,
            ManagementSeeder::class,
            AnnualEventSeeder::class,
        ]);
    }
}
