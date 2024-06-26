<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up (): void {
        Schema::create('transactions' , function ( Blueprint $table ) {
            $table->id();
            $table->string('tx_id')
                  ->nullable();
            $table->string('ref_id')
                  ->nullable();
            $table->unsignedBigInteger('tenant_id')
                  ->nullable();
            $table->unsignedBigInteger('monthly_charge_id')
                  ->nullable();
            $table->unsignedBigInteger('debt_id')
                  ->nullable();
            $table->unsignedBigInteger('original_amount')
                  ->nullable();
            $table->unsignedBigInteger('amount')
                  ->nullable();
            $table->string('subject')
                  ->nullable();
            $table->timestamp('paid_at')
                  ->nullable();
            $table->timestamp('failed_at')
                  ->nullable();
            $table->string('paid_via')
                  ->nullable()
                  ->default('BEHPARDAKHT');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down (): void {
        Schema::dropIfExists('transactions');
    }
};
