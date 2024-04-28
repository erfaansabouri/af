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
                                      'floor' => 'zirzamin' ,
                                      'floor_fa' => 'زیر زمین',
                                  ]);
        #
        Floor::query()
                  ->firstOrCreate([
                                      'floor' => 'hamkaf' ,
                                      'floor_fa' => 'همکف',
                                  ]);
        #
        Floor::query()
                  ->firstOrCreate([
                                      'floor' => '1' ,
                                      'floor_fa' => 'طبقه اول',
                                  ]);
        #
        Floor::query()
                  ->firstOrCreate([
                                      'floor' => '1-edari' ,
                                      'floor_fa' => 'طبقه اول اداری',
                                  ]);
        #
        Floor::query()
             ->firstOrCreate([
                                 'floor' => '2-edari' ,
                                 'floor_fa' => 'طبقه دوم اداری',
                             ]);

        #
        Floor::query()
             ->firstOrCreate([
                                 'floor' => '3-edari' ,
                                 'floor_fa' => 'طبقه سوم اداری',
                             ]);
    }
}
