<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministradoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administradores', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('last_name');
            $table->string('mother_last_name');
            $table->string('phone');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('password_reset_token')->nullable(); // Nuevo campo para el token de restablecimiento de contraseña
            $table->timestamp('password_reset_token_expires_at')->nullable(); // Nuevo campo para la expiración del token de restablecimiento de contraseña
            $table->rememberToken(); // Para la autenticación de Laravel
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('administradores');
    }
}
