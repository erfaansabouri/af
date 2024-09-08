<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up (): void {
        Schema::create('verify_logs' , function ( Blueprint $table ) {
            $table->id();
            $table->unsignedBigInteger('transaction_id')
                  ->nullable()->index();
            $table->longText('request')
                  ->nullable();
            $table->longText('exception_message')
                  ->nullable();
            $table->longText('exception_code')
                  ->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down (): void {
        Schema::dropIfExists('verify_logs');
    }
};
