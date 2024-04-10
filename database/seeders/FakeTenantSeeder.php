<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FakeTenantSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run (): void {
        for ( $i = 0 ; $i < 300 ; $i++ ) {
            Tenant::query()
                  ->firstOrCreate([
                                      'plaque' => $i + 1 ,
                                  ] , [
                                      'name' => "غرفه " . $i + 1 ,
                                      'owner_first_name' => Factory::create('fa_IR')->name ,
                                      'owner_last_name' => Factory::create('fa_IR')->name ,
                                      'username' => $i + 1 ,
                                      'password' => bcrypt($i + 1) ,
                                  ]);
        }
    }
}
