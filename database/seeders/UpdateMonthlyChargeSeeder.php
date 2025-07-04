<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UpdateMonthlyChargeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->charges() as $charge){
            $tenant = Tenant::query()->find((int)($charge['val0']));
            if ($tenant){
                $tenant->monthly_charge_amount = str_replace(',', '', $charge['val1']);
                $tenant->save();
            }
        }
    }

    public function charges () {
        return array(
            array("val0"=>" 1 ", "val1"=>"229,740,420"),
            array("val0"=>" 2 ", "val1"=>"0"),
            array("val0"=>" 3 ", "val1"=>"0"),
            array("val0"=>" 4 ", "val1"=>"0"),
            array("val0"=>" 5 ", "val1"=>"0"),
            array("val0"=>" 6 ", "val1"=>"0"),
            array("val0"=>" 7 ", "val1"=>"0"),
            array("val0"=>" 8 ", "val1"=>"40,884,480"),
            array("val0"=>" 9 ", "val1"=>"31,589,740"),
            array("val0"=>" 10 ", "val1"=>"20,394,192"),
            array("val0"=>" 11 ", "val1"=>"29,844,360"),
            array("val0"=>" 12 ", "val1"=>"21,767,200"),
            array("val0"=>" 13 ", "val1"=>"25,847,640"),
            array("val0"=>" 14 ", "val1"=>"24,897,600"),
            array("val0"=>" 15 ", "val1"=>"25,339,860"),
            array("val0"=>" 16 ", "val1"=>"40,374,880"),
            array("val0"=>" 17 ", "val1"=>"44,499,000"),
            array("val0"=>" 18 ", "val1"=>"42,180,320"),
            array("val0"=>" 19 ", "val1"=>"26,322,660"),
            array("val0"=>" 20 ", "val1"=>"31,777,200"),
            array("val0"=>" 21 ", "val1"=>"42,952,000"),
            array("val0"=>" 22 ", "val1"=>"51,296,700"),
            array("val0"=>" 23 ", "val1"=>"36,524,670"),
            array("val0"=>" 24 ", "val1"=>"17,514,224"),
            array("val0"=>" 25 ", "val1"=>"16,308,656"),
            array("val0"=>" 26 ", "val1"=>"35,410,830"),
            array("val0"=>" 27 ", "val1"=>"34,900,320"),
            array("val0"=>" 28 ", "val1"=>"24,764,376"),
            array("val0"=>" 29 ", "val1"=>"38,161,760"),
            array("val0"=>" 30 ", "val1"=>"24,864,840"),
            array("val0"=>" 31 ", "val1"=>"34,281,520"),
            array("val0"=>" 32 ", "val1"=>"32,628,960"),
            array("val0"=>" 33 ", "val1"=>"24,998,792"),
            array("val0"=>" 34 ", "val1"=>"26,044,200"),
            array("val0"=>" 35 ", "val1"=>"28,386,540"),
            array("val0"=>" 36 ", "val1"=>"31,171,140"),
            array("val0"=>" 37 ", "val1"=>"35,843,990"),
            array("val0"=>" 38 ", "val1"=>"37,360,050"),
            array("val0"=>" 39 ", "val1"=>"37,220,820"),
            array("val0"=>" 40 ", "val1"=>"42,588,000"),
            array("val0"=>" 41 ", "val1"=>"42,136,640"),
            array("val0"=>" 42 ", "val1"=>"29,746,080"),
            array("val0"=>" 43 ", "val1"=>"42,850,080"),
            array("val0"=>" 44 ", "val1"=>"27,846,000"),
            array("val0"=>" 45 ", "val1"=>"22,805,328"),
            array("val0"=>" 46 ", "val1"=>"28,075,320"),
            array("val0"=>" 47 ", "val1"=>"22,135,568"),
            array("val0"=>" 48 ", "val1"=>"31,187,520"),
            array("val0"=>" 49 ", "val1"=>"43,843,800"),
            array("val0"=>" 50 ", "val1"=>"32,224,010"),
            array("val0"=>" 51 ", "val1"=>"38,380,160"),
            array("val0"=>" 52 ", "val1"=>"35,194,250"),
            array("val0"=>" 53 ", "val1"=>"30,696,120"),
            array("val0"=>" 54 ", "val1"=>"26,748,540"),
            array("val0"=>" 55 ", "val1"=>"26,977,860"),
            array("val0"=>" 56 ", "val1"=>"24,027,640"),
            array("val0"=>" 57 ", "val1"=>"31,564,260"),
            array("val0"=>" 58 ", "val1"=>"28,075,320"),
            array("val0"=>" 59 ", "val1"=>"38,288,250"),
            array("val0"=>" 60 ", "val1"=>"41,618,850"),
            array("val0"=>" 61 ", "val1"=>"27,780,480"),
            array("val0"=>" 62 ", "val1"=>"24,635,520"),
            array("val0"=>" 63 ", "val1"=>"31,203,900"),
            array("val0"=>" 64 ", "val1"=>"25,241,580"),
            array("val0"=>" 65 ", "val1"=>"52,157,560"),
            array("val0"=>" 66 ", "val1"=>"24,864,840"),
            array("val0"=>" 67 ", "val1"=>"25,929,540"),
            array("val0"=>" 68 ", "val1"=>"17,547,712"),
            array("val0"=>" 69 ", "val1"=>"32,193,070"),
            array("val0"=>" 70 ", "val1"=>"34,436,220"),
            array("val0"=>" 71 ", "val1"=>"32,456,060"),
            array("val0"=>" 72 ", "val1"=>"28,140,840"),
            array("val0"=>" 73 ", "val1"=>"30,794,400"),
            array("val0"=>" 74 ", "val1"=>"28,206,360"),
            array("val0"=>" 75 ", "val1"=>"22,369,984"),
            array("val0"=>" 76 ", "val1"=>"23,491,832"),
            array("val0"=>" 77 ", "val1"=>"23,860,200"),
            array("val0"=>" 78 ", "val1"=>"24,462,984"),
            array("val0"=>" 79 ", "val1"=>"24,362,520"),
            array("val0"=>" 80 ", "val1"=>"16,308,656"),
            array("val0"=>" 81 ", "val1"=>"28,321,020"),
            array("val0"=>" 82 ", "val1"=>"17,497,480"),
            array("val0"=>" 83 ", "val1"=>"21,850,920"),
            array("val0"=>" 84 ", "val1"=>"21,315,112"),
            array("val0"=>" 85 ", "val1"=>"21,633,248"),
            array("val0"=>" 86 ", "val1"=>"21,248,136"),
            array("val0"=>" 87 ", "val1"=>"20,528,144"),
            array("val0"=>" 88 ", "val1"=>"24,010,896"),
            array("val0"=>" 89 ", "val1"=>"23,491,832"),
            array("val0"=>" 90 ", "val1"=>"22,386,728"),
            array("val0"=>" 91 ", "val1"=>"22,889,048"),
            array("val0"=>" 92 ", "val1"=>"20,109,544"),
            array("val0"=>" 93 ", "val1"=>"24,663,912"),
            array("val0"=>" 94 ", "val1"=>"24,931,816"),
            array("val0"=>" 95 ", "val1"=>"24,799,320"),
            array("val0"=>" 96 ", "val1"=>"24,546,704"),
            array("val0"=>" 97 ", "val1"=>"24,714,144"),
            array("val0"=>" 98 ", "val1"=>"23,223,928"),
            array("val0"=>" 99 ", "val1"=>"29,467,620"),
            array("val0"=>" 100 ", "val1"=>"24,178,336"),
            array("val0"=>" 101 ", "val1"=>"24,161,592"),
            array("val0"=>" 102 ", "val1"=>"24,195,080"),
            array("val0"=>" 103 ", "val1"=>"24,111,360"),
            array("val0"=>" 104 ", "val1"=>"22,269,520"),
            array("val0"=>" 105 ", "val1"=>"18,719,792"),
            array("val0"=>" 106 ", "val1"=>"27,780,480"),
            array("val0"=>" 107 ", "val1"=>"15,270,528"),
            array("val0"=>" 108 ", "val1"=>"32,471,530"),
            array("val0"=>" 109 ", "val1"=>"33,786,480"),
            array("val0"=>" 110 ", "val1"=>"27,403,740"),
            array("val0"=>" 111 ", "val1"=>"32,530,680"),
            array("val0"=>" 112 ", "val1"=>"29,271,060"),
            array("val0"=>" 113 ", "val1"=>"25,880,400"),
            array("val0"=>" 114 ", "val1"=>"16,777,488"),
            array("val0"=>" 115 ", "val1"=>"31,868,200"),
            array("val0"=>" 201 ", "val1"=>"180,347,440"),
            array("val0"=>" 202 ", "val1"=>"23,951,200"),
            array("val0"=>" 203 ", "val1"=>"27,900,600"),
            array("val0"=>" 204 ", "val1"=>"34,834,800"),
            array("val0"=>" 205 ", "val1"=>"25,134,200"),
            array("val0"=>" 206 ", "val1"=>"24,278,800"),
            array("val0"=>" 207 ", "val1"=>"39,905,320"),
            array("val0"=>" 208 ", "val1"=>"18,309,200"),
            array("val0"=>" 209 ", "val1"=>"19,601,400"),
            array("val0"=>" 210 ", "val1"=>"32,323,200"),
            array("val0"=>" 211 ", "val1"=>"32,414,200"),
            array("val0"=>" 212 ", "val1"=>"32,705,400"),
            array("val0"=>" 213 ", "val1"=>"27,427,400"),
            array("val0"=>" 214 ", "val1"=>"36,127,000"),
            array("val0"=>" 215 ", "val1"=>"29,884,400"),
            array("val0"=>" 216 ", "val1"=>"41,244,840"),
            array("val0"=>" 217 ", "val1"=>"36,090,600"),
            array("val0"=>" 218 ", "val1"=>"47,415,550"),
            array("val0"=>" 219 ", "val1"=>"32,978,400"),
            array("val0"=>" 220 ", "val1"=>"20,711,600"),
            array("val0"=>" 221 ", "val1"=>"20,875,400"),
            array("val0"=>" 222 ", "val1"=>"23,787,400"),
            array("val0"=>" 223 ", "val1"=>"21,676,200"),
            array("val0"=>" 224 ", "val1"=>"35,790,300"),
            array("val0"=>" 226 ", "val1"=>"29,047,200"),
            array("val0"=>" 227 ", "val1"=>"35,600,110"),
            array("val0"=>" 228 ", "val1"=>"36,032,360"),
            array("val0"=>" 229 ", "val1"=>"33,105,800"),
            array("val0"=>" 230 ", "val1"=>"32,141,200"),
            array("val0"=>" 231 ", "val1"=>"34,561,800"),
            array("val0"=>" 232 ", "val1"=>"53,464,320"),
            array("val0"=>" 233 ", "val1"=>"58,400,160"),
            array("val0"=>" 234 ", "val1"=>"59,389,330"),
            array("val0"=>" 235 ", "val1"=>"59,868,900"),
            array("val0"=>" 236 ", "val1"=>"69,247,360"),
            array("val0"=>" 237 ", "val1"=>"60,951,800"),
            array("val0"=>" 238 ", "val1"=>"45,601,920"),
            array("val0"=>" 239 ", "val1"=>"22,422,400"),
            array("val0"=>" 240 ", "val1"=>"24,551,800"),
            array("val0"=>" 241 ", "val1"=>"49,041,720"),
            array("val0"=>" 242 ", "val1"=>"40,873,560"),
            array("val0"=>" 243 ", "val1"=>"41,687,100"),
            array("val0"=>" 244 ", "val1"=>"34,616,400"),
            array("val0"=>" 245 ", "val1"=>"37,087,050"),
            array("val0"=>" 246 ", "val1"=>"47,780,460"),
            array("val0"=>" 247 ", "val1"=>"26,881,400"),
            array("val0"=>" 248 ", "val1"=>"34,052,200"),
            array("val0"=>" 249 ", "val1"=>"40,216,540"),
            array("val0"=>" 250 ", "val1"=>"42,567,980"),
            array("val0"=>" 251 ", "val1"=>"47,272,680"),
            array("val0"=>" 252 ", "val1"=>"61,516,000"),
            array("val0"=>" 253 ", "val1"=>"25,789,400"),
            array("val0"=>" 254 ", "val1"=>"25,844,000"),
            array("val0"=>" 255 ", "val1"=>"42,153,020"),
            array("val0"=>" 256 ", "val1"=>"32,359,600"),
            array("val0"=>" 257 ", "val1"=>"28,919,800"),
            array("val0"=>" 258 ", "val1"=>"20,911,800"),
            array("val0"=>" 259 ", "val1"=>"27,955,200"),
            array("val0"=>" 260 ", "val1"=>"37,968,840"),
            array("val0"=>" 261 ", "val1"=>"93,184,000"),
            array("val0"=>" 262 ", "val1"=>"125,550,880"),
            array("val0"=>" 263 ", "val1"=>"23,496,200"),
            array("val0"=>" 264 ", "val1"=>"21,348,600"),
            array("val0"=>" 265 ", "val1"=>"20,948,200"),
            array("val0"=>" 266 ", "val1"=>"24,479,000"),
            array("val0"=>" 267 ", "val1"=>"19,965,400"),
            array("val0"=>" 268 ", "val1"=>"26,462,800"),
            array("val0"=>" 269 ", "val1"=>"17,435,600"),
            array("val0"=>" 270 ", "val1"=>"38,885,210"),
            array("val0"=>" 271 ", "val1"=>"29,775,200"),
            array("val0"=>" 272 ", "val1"=>"34,925,800"),
            array("val0"=>" 273 ", "val1"=>"46,734,870"),
            array("val0"=>" 301 ", "val1"=>"76,811,280"),
            array("val0"=>" 302 ", "val1"=>"29,593,200"),
            array("val0"=>" 303 ", "val1"=>"21,863,660"),
            array("val0"=>" 304 ", "val1"=>"21,565,180"),
            array("val0"=>" 305 ", "val1"=>"21,893,508"),
            array("val0"=>" 306 ", "val1"=>"30,084,600"),
            array("val0"=>" 307 ", "val1"=>"46,551,050"),
            array("val0"=>" 308 ", "val1"=>"27,955,200"),
            array("val0"=>" 309 ", "val1"=>"14,147,952"),
            array("val0"=>" 310 ", "val1"=>"18,356,520"),
            array("val0"=>" 311 ", "val1"=>"28,872,480"),
            array("val0"=>" 312 ", "val1"=>"27,982,500"),
            array("val0"=>" 313 ", "val1"=>"19,087,796"),
            array("val0"=>" 314 ", "val1"=>"19,893,692"),
            array("val0"=>" 315 ", "val1"=>"21,132,384"),
            array("val0"=>" 316 ", "val1"=>"28,378,350"),
            array("val0"=>" 317 ", "val1"=>"28,799,680"),
            array("val0"=>" 318 ", "val1"=>"18,192,356"),
            array("val0"=>" 319 ", "val1"=>"33,688,200"),
            array("val0"=>" 320 ", "val1"=>"25,611,040"),
            array("val0"=>" 321 ", "val1"=>"40,979,120"),
            array("val0"=>" 322 ", "val1"=>"42,339,570"),
            array("val0"=>" 323 ", "val1"=>"35,710,220"),
            array("val0"=>" 324 ", "val1"=>"30,207,450"),
            array("val0"=>" 325 ", "val1"=>"32,596,200"),
            array("val0"=>" 326 ", "val1"=>"32,410,560"),
            array("val0"=>" 327 ", "val1"=>"39,571,350"),
            array("val0"=>" 328 ", "val1"=>"45,439,030"),
            array("val0"=>" 329 ", "val1"=>"28,228,200"),
            array("val0"=>" 330 ", "val1"=>"28,188,160"),
            array("val0"=>" 331 ", "val1"=>"25,290,720"),
            array("val0"=>" 332 ", "val1"=>"35,722,960"),
            array("val0"=>" 333 ", "val1"=>"35,914,060"),
            array("val0"=>" 334 ", "val1"=>"28,665,000"),
            array("val0"=>" 335 ", "val1"=>"29,320,200"),
            array("val0"=>" 336 ", "val1"=>"30,849,000"),
            array("val0"=>" 337 ", "val1"=>"27,547,520"),
            array("val0"=>" 338 ", "val1"=>"39,949,910"),
            array("val0"=>" 339 ", "val1"=>"41,215,720"),
            array("val0"=>" 340 ", "val1"=>"37,430,120"),
            array("val0"=>" 341 ", "val1"=>"24,839,360"),
            array("val0"=>" 342 ", "val1"=>"12,774,944"),
            array("val0"=>" 343 ", "val1"=>"28,787,850"),
            array("val0"=>" 344 ", "val1"=>"22,422,400"),
            array("val0"=>" 345 ", "val1"=>"31,504,200"),
            array("val0"=>" 346 ", "val1"=>"37,965,200"),
            array("val0"=>" 347 ", "val1"=>"23,980,320"),
            array("val0"=>" 348 ", "val1"=>"30,207,450"),
            array("val0"=>" 349 ", "val1"=>"27,532,960"),
            array("val0"=>" 350 ", "val1"=>"35,187,880"),
            array("val0"=>" 351 ", "val1"=>"49,129,080"),
            array("val0"=>" 352 ", "val1"=>"19,535,516"),
            array("val0"=>" 353 ", "val1"=>"20,117,552"),
            array("val0"=>" 354 ", "val1"=>"25,844,000"),
            array("val0"=>" 355 ", "val1"=>"13,401,752"),
            array("val0"=>" 356 ", "val1"=>"46,361,770"),
            array("val0"=>" 357 ", "val1"=>"22,042,748"),
            array("val0"=>" 358 ", "val1"=>"20,147,400"),
            array("val0"=>" 359 ", "val1"=>"31,012,800"),
            array("val0"=>" 360 ", "val1"=>"34,538,140"),
            array("val0"=>" 361 ", "val1"=>"20,371,260"),
            array("val0"=>" 362 ", "val1"=>"24,067,680"),
            array("val0"=>" 363 ", "val1"=>"29,879,850"),
            array("val0"=>" 364 ", "val1"=>"17,490,928"),
            array("val0"=>" 365 ", "val1"=>"18,893,784"),
            array("val0"=>" 366 ", "val1"=>"30,726,150"),
            array("val0"=>" 367 ", "val1"=>"31,313,100"),
            array("val0"=>" 368 ", "val1"=>"41,345,850"),
            array("val0"=>" 369 ", "val1"=>"47,567,520"),
            array("val0"=>" 370 ", "val1"=>"36,334,480"),
            array("val0"=>" 371 ", "val1"=>"36,589,280"),
            array("val0"=>" 372 ", "val1"=>"22,291,360"),
            array("val0"=>" 373 ", "val1"=>"22,830,080"),
            array("val0"=>" 374 ", "val1"=>"35,391,720"),
            array("val0"=>" 375 ", "val1"=>"21,863,660"),
            array("val0"=>" 376 ", "val1"=>"22,087,520"),
            array("val0"=>" 377 ", "val1"=>"36,487,360"),
            array("val0"=>" 378 ", "val1"=>"16,789,500"),
            array("val0"=>" 379 ", "val1"=>"18,714,696"),
            array("val0"=>" 380 ", "val1"=>"18,058,040"),
            array("val0"=>" 381 ", "val1"=>"17,252,144"),
            array("val0"=>" 382 ", "val1"=>"28,856,100"),
            array("val0"=>" 383 ", "val1"=>"23,048,480"),
            array("val0"=>" 384 ", "val1"=>"27,591,200"),
            array("val0"=>" 385 ", "val1"=>"33,888,400"),
            array("val0"=>" 386 ", "val1"=>"16,177,616"),
            array("val0"=>" 387 ", "val1"=>"15,834,364"),
            array("val0"=>" 388 ", "val1"=>"16,908,892"),
            //
            array("val0"=>"401", "val1"=>"45,126,900"),
            array("val0"=>"402", "val1"=>"50,228,360"),
            array("val0"=>"403", "val1"=>"50,705,200"),
            array("val0"=>"404", "val1"=>"57,208,060"),
            array("val0"=>"405", "val1"=>"49,240,100"),
            array("val0"=>"406", "val1"=>"47,784,100"),
            array("val0"=>"407", "val1"=>"46,264,400"),
            array("val0"=>"408", "val1"=>"45,914,960"),
            array("val0"=>"409", "val1"=>"29,524,950"),
            array("val0"=>"410", "val1"=>"51,413,180"),
            array("val0"=>"411", "val1"=>"42,374,150"),
            array("val0"=>"412", "val1"=>"41,427,750"),
            array("val0"=>"413", "val1"=>"43,070,300"),
            array("val0"=>"414", "val1"=>"35,908,600"),
            array("val0"=>"415", "val1"=>"50,075,480"),
            array("val0"=>"416", "val1"=>"38,775,100"),
            array("val0"=>"417", "val1"=>"38,142,650"),
            array("val0"=>"418", "val1"=>"28,551,250"),
            array("val0"=>"419", "val1"=>"40,986,400"),
            array("val0"=>"420", "val1"=>"48,954,360"),
            array("val0"=>"421", "val1"=>"48,603,100"),
            array("val0"=>"422", "val1"=>"36,486,450"),
            array("val0"=>"423", "val1"=>"32,955,650"),
            array("val0"=>"424", "val1"=>"47,198,060"),
            array("val0"=>"425", "val1"=>"54,157,740"),
            array("val0"=>"426", "val1"=>"41,514,200"),
            array("val0"=>"501", "val1"=>"45,126,900"),
            array("val0"=>"502", "val1"=>"50,228,360"),
            array("val0"=>"503", "val1"=>"50,705,200"),
            array("val0"=>"504", "val1"=>"57,208,060"),
            array("val0"=>"505", "val1"=>"49,240,100"),
            array("val0"=>"506", "val1"=>"47,784,100"),
            array("val0"=>"507", "val1"=>"46,264,400"),
            array("val0"=>"508", "val1"=>"45,914,960"),
            array("val0"=>"509", "val1"=>"29,524,950"),
            array("val0"=>"510", "val1"=>"51,413,180"),
            array("val0"=>"511", "val1"=>"42,374,150"),
            array("val0"=>"512", "val1"=>"41,427,750"),
            array("val0"=>"513", "val1"=>"43,070,300"),
            array("val0"=>"514", "val1"=>"35,908,600"),
            array("val0"=>"515", "val1"=>"50,075,480"),
            array("val0"=>"516", "val1"=>"38,775,100"),
            array("val0"=>"517", "val1"=>"38,142,650"),
            array("val0"=>"518", "val1"=>"28,551,250"),
            array("val0"=>"519", "val1"=>"40,986,400"),
            array("val0"=>"520", "val1"=>"48,954,360"),
            array("val0"=>"521", "val1"=>"48,603,100"),
            array("val0"=>"522", "val1"=>"36,486,450"),
            array("val0"=>"523", "val1"=>"32,955,650"),
            array("val0"=>"524", "val1"=>"47,198,060"),
            array("val0"=>"525", "val1"=>"54,157,740"),
            array("val0"=>"526", "val1"=>"41,514,200"),
            array("val0"=>"601", "val1"=>"45,126,900"),
            array("val0"=>"602", "val1"=>"50,228,360"),
            array("val0"=>"603", "val1"=>"50,705,200"),
            array("val0"=>"604", "val1"=>"57,208,060"),
            array("val0"=>"605", "val1"=>"49,240,100"),
            array("val0"=>"606", "val1"=>"47,784,100"),
            array("val0"=>"607", "val1"=>"46,264,400"),
            array("val0"=>"608", "val1"=>"45,914,960"),
            array("val0"=>"609", "val1"=>"29,524,950"),
            array("val0"=>"610", "val1"=>"51,413,180"),
            array("val0"=>"611", "val1"=>"42,374,150"),
            array("val0"=>"612", "val1"=>"41,427,750"),
            array("val0"=>"613", "val1"=>"43,070,300"),
            array("val0"=>"614", "val1"=>"35,908,600"),
            array("val0"=>"615", "val1"=>"50,075,480"),
            array("val0"=>"616", "val1"=>"38,775,100"),
            array("val0"=>"617", "val1"=>"38,142,650"),
            array("val0"=>"618", "val1"=>"28,551,250"),
            array("val0"=>"619", "val1"=>"40,986,400"),
            array("val0"=>"620", "val1"=>"48,954,360"),
            array("val0"=>"621", "val1"=>"48,603,100"),
            array("val0"=>"622", "val1"=>"36,486,450"),
            array("val0"=>"623", "val1"=>"32,955,650"),
            array("val0"=>"624", "val1"=>"47,198,060"),
            array("val0"=>"625", "val1"=>"54,157,740"),
            array("val0"=>"626", "val1"=>"41,514,200"),
        );
    }
}

