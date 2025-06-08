<?php

namespace Database\Seeders;

use App\Models\FiscalYear;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FiscalYearSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run (): void {
        $fiscal_year = FiscalYear::query()
                                 ->create([
                                              'year' => 1404 ,
                                              'started_at' => Carbon::parse('2025-06-22 00:00:00') ,
                                              'ended_at' => Carbon::parse('2026-04-20 00:00:00') ,
                                          ]);
    }
}
