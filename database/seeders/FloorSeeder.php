<?php

namespace Database\Seeders;

use App\Models\Floor;
use Illuminate\Database\Seeder;

class FloorSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run (): void {
        Floor::query()
                  ->firstOrCreate([
                                      'floor' => Floor::FLOORS[ 'UNDERGROUND' ] ,
                                      'floor_fa' => 'زیر زمین',
                                      'base_charge_amount' => 1000
                                  ]);
        #
        Floor::query()
                  ->firstOrCreate([
                                      'floor' => Floor::FLOORS[ 'GROUND' ] ,
                                      'floor_fa' => 'همکف',
                                      'base_charge_amount' => 2000

                                  ]);
        #
        Floor::query()
                  ->firstOrCreate([
                                      'floor' => Floor::FLOORS[ 'FIRST' ] ,
                                      'floor_fa' => 'طبقه اول',
                                      'base_charge_amount' => 3000

                                  ]);
        #
        Floor::query()
                  ->firstOrCreate([
                                      'floor' => Floor::FLOORS[ 'SECOND' ] ,
                                      'floor_fa' => 'طبقه دوم',
                                      'base_charge_amount' => 4000

                                  ]);
        #
        Floor::query()
             ->firstOrCreate([
                                 'floor' => Floor::FLOORS[ 'THIRD' ] ,
                                 'floor_fa' => 'طبقه سوم',
                                 'base_charge_amount' => 5000

                             ]);
    }
}
