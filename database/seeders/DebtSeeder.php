<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DebtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = json_decode(file_get_contents(asset('seeds/bedehkaran.json')))->items;
        foreach ($items as $item){
            $bedehi = @$item->bedehkar ?? 0;
            $talab = @$item->bestankar ?? 0;
            $debt = $bedehi - $talab;
            \App\Models\Tenant::query()
                              ->where('plaque', $item->plaque)
                              ->update(['debt_amount' => $debt]);
        }
    }
}
