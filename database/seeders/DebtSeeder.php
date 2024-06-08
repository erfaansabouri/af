<?php

namespace Database\Seeders;

use App\Models\Debt;
use App\Models\Tenant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DebtSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run (): void {
        $items = json_decode(file_get_contents(asset('seeds/bedehkaran.json')))->items;
        foreach ( $items as $item ) {
            $bedehi = @$item->bedehkar ?? 0;
            $talab = @$item->bestankar ?? 0;
            $tenant = Tenant::query()
                            ->where('plaque' , $item->plaque)
                            ->first();
            if ( $tenant ) {
                if ( $talab != 0 ) {
                    $tenant->submitBestankari($talab);
                }
                if ( $bedehi != 0 ) {
                    $tenant->addDebt($bedehi , 'بدهی از قبل' , Debt::TYPES[ 'NORMAL' ]);
                }
            }
        }
    }
}
