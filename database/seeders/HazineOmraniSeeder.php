<?php

namespace Database\Seeders;

use App\Models\BedehiOmrani;
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
        BedehiOmrani::truncate();
        $plaques = $this->plaques();
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
            foreach ( $plaques as $edari ) {
                $tenant = Tenant::query()
                                ->wherePlaque($edari[ 'val0' ])
                                ->firstOrFail();
                HazineOmrani::query()
                            ->create([
                                         'tenant_id' => $tenant->id ,
                                         'started_at' => $started_at ,
                                         'ended_at' => $ended_at ,
                                         'for_restore_amount' => str_replace(',' , '' , $edari[ 'val1' ]) ,
                                         'original_amount' => str_replace(',' , '' , $edari[ 'val1' ]) ,
                                     ]);
                if ( $edari[ 'val2' ] != '0' ) {
                    BedehiOmrani::query()
                                ->firstOrCreate([
                                             'tenant_id' => $tenant->id ,
                                             'amount' => $edari[ 'val2' ] ,
                                         ]);
                }
            }
        }
    }

    public function plaques () {
        $array = [
            [
                "val0" => "401" ,
                "val1" => "61,159,000" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "402" ,
                "val1" => "58,897,000" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "403" ,
                "val1" => "62,029,000" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "404" ,
                "val1" => "64,649,500" ,
                "val2" => "108915127",
            ] ,
            [
                "val0" => "405" ,
                "val1" => "59,546,500" ,
                "val2" => "86367250",
            ] ,
            [
                "val0" => "406" ,
                "val1" => "59,528,500" ,
                "val2" => "86287716",
            ] ,
            [
                "val0" => "407" ,
                "val1" => "59,296,000" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "408" ,
                "val1" => "52,570,000" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "409" ,
                "val1" => "42,978,000" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "410" ,
                "val1" => "59,873,500" ,
                "val2" => "87812117",
            ] ,
            [
                "val0" => "411" ,
                "val1" => "52,807,500" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "412" ,
                "val1" => "50,752,000" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "413" ,
                "val1" => "49,223,200" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "414" ,
                "val1" => "46,321,600" ,
                "val2" => "59040708",
            ] ,
            [
                "val0" => "415" ,
                "val1" => "60,538,000" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "416" ,
                "val1" => "44,314,400" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "417" ,
                "val1" => "43,591,600" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "418" ,
                "val1" => "47,294,000" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "419" ,
                "val1" => "51,001,600" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "420" ,
                "val1" => "60,454,000" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "421" ,
                "val1" => "59,311,000" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "422" ,
                "val1" => "41,698,800" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "423" ,
                "val1" => "41,272,400" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "424" ,
                "val1" => "55,735,000" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "425" ,
                "val1" => "63,190,000" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "426" ,
                "val1" => "50,960,000" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "501" ,
                "val1" => "54,355,000" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "502" ,
                "val1" => "58,897,000" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "503" ,
                "val1" => "61,147,000" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "504" ,
                "val1" => "66,524,500" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "505" ,
                "val1" => "59,923,000" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "506" ,
                "val1" => "58,526,500" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "507" ,
                "val1" => "56,575,000" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "508" ,
                "val1" => "56,545,000" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "509" ,
                "val1" => "37,767,600" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "510" ,
                "val1" => "59,873,500" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "511" ,
                "val1" => "52,095,000" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "512" ,
                "val1" => "52,355,000" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "513" ,
                "val1" => "53,345,000" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "514" ,
                "val1" => "44,938,400" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "515" ,
                "val1" => "60,589,000" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "516" ,
                "val1" => "49,410,400" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "517" ,
                "val1" => "48,729,200" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "518" ,
                "val1" => "38,069,200" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "519" ,
                "val1" => "52,175,000" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "520" ,
                "val1" => "61,898,500" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "521" ,
                "val1" => "61,130,500" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "522" ,
                "val1" => "41,698,800" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "523" ,
                "val1" => "41,095,600" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "524" ,
                "val1" => "55,725,000" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "525" ,
                "val1" => "63,887,500" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "526" ,
                "val1" => "53,242,500" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "601" ,
                "val1" => "54,785,000" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "602" ,
                "val1" => "58,897,000" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "603" ,
                "val1" => "62,314,000" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "604" ,
                "val1" => "67,526,500" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "605" ,
                "val1" => "59,872,000" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "606" ,
                "val1" => "58,358,500" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "607" ,
                "val1" => "53,050,000" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "608" ,
                "val1" => "56,552,500" ,
                "val2" => "78347576",
            ] ,
            [
                "val0" => "609" ,
                "val1" => "38,745,200" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "610" ,
                "val1" => "59,873,500" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "611" ,
                "val1" => "52,097,500" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "612" ,
                "val1" => "52,235,000" ,
                "val2" => "66901314",
            ] ,
            [
                "val0" => "613" ,
                "val1" => "52,892,500" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "614" ,
                "val1" => "41,038,400" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "615" ,
                "val1" => "59,905,000" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "616" ,
                "val1" => "53,322,500" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "617" ,
                "val1" => "43,591,600" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "618" ,
                "val1" => "37,112,400" ,
                "val2" => "47302821",
            ] ,
            [
                "val0" => "619" ,
                "val1" => "46,841,600" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "620" ,
                "val1" => "59,837,500" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "621" ,
                "val1" => "60,478,000" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "622" ,
                "val1" => "41,698,800" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "623" ,
                "val1" => "41,464,800" ,
                "val2" => "52850315",
            ] ,
            [
                "val0" => "624" ,
                "val1" => "56,025,000" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "625" ,
                "val1" => "64,096,000" ,
                "val2" => "0",
            ] ,
            [
                "val0" => "626" ,
                "val1" => "52,650,000" ,
                "val2" => "0",
            ],
        ];

        return collect($array);
    }
}
