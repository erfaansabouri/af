<?php

namespace Database\Seeders;

use App\Models\TenantType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TenantTypeSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run (): void {
        TenantType::query()
                  ->firstOrCreate([
                                      'type' => TenantType::TYPES[ 'GHORFEH_TEJARI' ] ,
                                      'type_fa' => 'غرفه تجاری',
                                  ]);
        #
        TenantType::query()
                  ->firstOrCreate([
                                      'type' => TenantType::TYPES[ 'GHORFEH_EDARI' ] ,
                                      'type_fa' => 'غرفه اداری',
                                  ]);
        #
        TenantType::query()
                  ->firstOrCreate([
                                      'type' => TenantType::TYPES[ 'VITRIN' ] ,
                                      'type_fa' => 'ویترین',
                                  ]);
        #
        TenantType::query()
                  ->firstOrCreate([
                                      'type' => TenantType::TYPES[ 'TABLIGHAT' ] ,
                                      'type_fa' => 'تبلیغات',
                                  ]);
        #
        TenantType::query()
                  ->firstOrCreate([
                                      'type' => TenantType::TYPES[ 'MOSHAAT' ] ,
                                      'type_fa' => 'مشاعات',
                                  ]);
        #
        TenantType::query()
                  ->firstOrCreate([
                                      'type' => TenantType::TYPES[ 'ANBAR' ] ,
                                      'type_fa' => 'انبار',
                                  ]);
    }
}
