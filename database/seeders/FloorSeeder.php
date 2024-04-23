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
                                  ]);
        #
        Floor::query()
                  ->firstOrCreate([
                                      'floor' => Floor::FLOORS[ 'GROUND' ] ,
                                      'floor_fa' => 'همکف',
                                  ]);
        #
        Floor::query()
                  ->firstOrCreate([
                                      'floor' => Floor::FLOORS[ 'FIRST' ] ,
                                      'floor_fa' => 'طبقه اول',
                                  ]);
        #
        Floor::query()
                  ->firstOrCreate([
                                      'floor' => Floor::FLOORS[ 'SECOND' ] ,
                                      'floor_fa' => 'طبقه دوم',
                                  ]);
        #
        Floor::query()
             ->firstOrCreate([
                                 'floor' => Floor::FLOORS[ 'THIRD' ] ,
                                 'floor_fa' => 'طبقه سوم',
                             ]);
    }
}
