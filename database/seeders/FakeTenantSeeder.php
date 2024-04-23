<?php

namespace Database\Seeders;

use App\Models\Floor;
use App\Models\Tenant;
use App\Models\TenantType;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FakeTenantSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run (): void {
        for ( $i = 0 ; $i < 20 ; $i++ ) {
            $tenant_type = TenantType::query()
                                     ->inRandomOrder()
                                     ->first();
            $floor = Floor::query()
                          ->inRandomOrder()
                          ->first();
            $plaque = $i + 1;
            Tenant::query()
                  ->updateOrCreate([
                                       'plaque' => $plaque ,
                                   ] , [
                                       'floor_id' => $floor->id ,
                                       'tenant_type_id' => $tenant_type->id ,
                                       'meters' => rand(10 , 99) ,
                                       'monthly_charge_amount' => rand(10 , 99) * 10000 ,
                                       'phone_number' => "0937" . rand() ,
                                       'name' => $tenant_type->type_fa . " " . $plaque ,
                                       'owner_first_name' => Factory::create('fa_IR')->name ,
                                       'owner_last_name' => Factory::create('fa_IR')->name ,
                                       'username' => $plaque ,
                                       'password' => bcrypt($plaque . "@1403") ,
                                   ]);
        }
    }
}
