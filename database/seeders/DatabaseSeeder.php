<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(FloorSeeder::class);
        $this->call(TenantTypeSeeder::class);
        $this->call(FakeTenantSeeder::class);
    }
}
