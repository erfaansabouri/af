<?php

namespace Database\Seeders;

use App\Models\HazineOmrani;
use App\Models\Tenant;
use App\Models\TenantType;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Verta;

class HazineOmraniSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run (): void {
        HazineOmrani::truncate();
        $items = [
            [
                Verta::jalaliToGregorian(1403 , 10 , 01) ,
                Verta::jalaliToGregorian(1403 , 12 , 30) ,
            ] ,
            [
                Verta::jalaliToGregorian(1404 , 01 , 01) ,
                Verta::jalaliToGregorian(1404 , 03 , 31) ,
            ] ,
            [
                Verta::jalaliToGregorian(1404 , 04 , 01) ,
                Verta::jalaliToGregorian(1404 , 06 , 31) ,
            ] ,
            [
                Verta::jalaliToGregorian(1404 , 07 , 01) ,
                Verta::jalaliToGregorian(1404 , 9 , 31) ,
            ] ,
            [
                Verta::jalaliToGregorian(1404 , 10 , 01) ,
                Verta::jalaliToGregorian(1404 , 12 , 30) ,
            ] ,
        ];
        function getCarbon ( $year , $month , $day ) {
            return Carbon::create($year , $month , $day);
        }

        $result = [];
        foreach ( $items as $item ) {
            $result[] = [
                getCarbon($item[ 0 ][ 0 ] , $item[ 0 ][ 1 ] , $item[ 0 ][ 2 ])->format('Y-m-d') ,
                getCarbon($item[ 1 ][ 0 ] , $item[ 1 ][ 1 ] , $item[ 1 ][ 2 ])->format('Y-m-d') ,
            ];
        }
        foreach ( $result as $item ) {
            $started_at = $item[ 0 ];
            $ended_at = $item[ 1 ];
            foreach ( Tenant::query()
                            ->where('tenant_type_id' , 2)
                            ->get() as $edari ) {
                HazineOmrani::query()
                            ->create([
                                         'tenant_id' => $edari->id ,
                                         'started_at' => $started_at ,
                                         'ended_at' => $ended_at ,
                                         'for_restore_amount' => 1000000 ,
                                         'original_amount' => 1000000 ,
                                     ]);
            }
        }
    }
}
