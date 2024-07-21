<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('others', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id')->nullable();
            $table->string('plaque')->nullable();
            $table->string('password')->nullable();
            $table->string('type')->nullable();
            $table->timestamp('monthly_charge_started_at')->nullable();
            $table->timestamp('monthly_charge_ended_at')->nullable();
            $table->unsignedBigInteger('monthly_charge_amount')->nullable();
            $table->unsignedBigInteger('debt_amount')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('others');
    }
};
