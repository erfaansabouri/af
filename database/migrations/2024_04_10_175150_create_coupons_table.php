<?php

use App\Models\Coupon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up (): void {
        Schema::create('coupons' , function ( Blueprint $table ) {
            $table->id();
            $table->string('coupon')
                  ->nullable();
            $table->string('coupon_fa')
                  ->nullable();
            $table->float('discount_percent')
                  ->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
        Coupon::query()
                          ->create([
                                       'coupon' => Coupon::COUPONS[ 'FIRST_DAY' ],
                                       'coupon_fa' => 'کوپن روز اول هر ماه',
                                       'discount_percent' => 10
                                   ]);

        Coupon::query()
              ->create([
                           'coupon' => Coupon::COUPONS[ 'SECOND_DAY_TO_FIFTH_DAY' ],
                           'coupon_fa' => 'کوپن روز دوم تا پنجم هر ماه',
                           'discount_percent' => 5
                       ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down (): void {
        Schema::dropIfExists('coupons');
    }
};
