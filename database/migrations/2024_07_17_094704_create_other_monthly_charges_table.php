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
        Schema::create('other_monthly_charges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('other_id')->nullable();
            $table->integer('month')->nullable();
            $table->timestamp('due_date')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->unsignedBigInteger('original_amount')->nullable();
            $table->unsignedBigInteger('paid_amount')->nullable();
            $table->string('paid_via')->nullable()->default('BEHPARDAKHT');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('other_monthly_charges');
    }
};
