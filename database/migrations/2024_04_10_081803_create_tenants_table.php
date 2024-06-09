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
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_type_id')->nullable();
            $table->unsignedBigInteger('floor_id')->nullable();
            $table->string('monthly_charge_amount')->nullable();
            $table->string('meters')->nullable();
            $table->string('plaque')->nullable();
            $table->string('name')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('owner_first_name')->nullable();
            $table->string('owner_last_name')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->boolean('can_login')->default(1);
            $table->string('activity_type')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};
