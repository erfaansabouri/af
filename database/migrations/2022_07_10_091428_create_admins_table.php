<?php

use App\Models\Admin;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('username')->nullable();
            $table->text('password');
            $table->boolean('can_login')->default(1);
            $table->rememberToken();
            $table->timestamps();
        });

        Admin::query()->updateOrCreate([
                'first_name' => 'مدیریت آفتاب',
            ]
            , [
                'username' => 'aftab',
                'password' => bcrypt('aftab'),
            ]);


    }

    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
