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
            $table->string('plaque')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('tenant_id')->nullable();
            $table->timestamp('financial_period_started_at')->nullable();
            $table->timestamp('financial_period_ended_at')->nullable();
            $table->string('monthly_charge_amount')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->text('remember_token')->nullable();
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
