<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('lastname_p');
            $table->string('lastname_m');
            $table->integer('age');
            $table->date('birthdate');
            $table->string('email')->unique();
            $table->string('phone',20)->unique();
            $table->string('password');
            $table->boolean('active')->default(false);
            $table->double('latitude');
            $table->double('longitude');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
