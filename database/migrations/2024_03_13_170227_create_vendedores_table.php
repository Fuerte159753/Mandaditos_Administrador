<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendedores', function (Blueprint $table) {
            $table->id(); // Autoincremento del ID
            $table->string('nombre_establecimiento');
            $table->string('username')->unique();
            $table->string('correo')->unique();
            $table->string('contraseña');
            $table->string('telefono')->nullable(); // Teléfono (puede ser nulo)
            $table->string('activo')->default(0); // Columna para verificación
            $table->string('codigo_verificacion')->nullable(); // Código de verificación
            $table->string('password_reset_token')->nullable(); // Token de restablecimiento de contraseña
            $table->timestamp('password_reset_token_expires_at')->nullable(); // Expiración del token de restablecimiento de contraseña
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
        Schema::dropIfExists('vendedores');
    }
}
