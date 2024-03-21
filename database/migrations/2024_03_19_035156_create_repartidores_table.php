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
        Schema::create('repartidores', function (Blueprint $table) {
            $table->bigIncrements('repartidor_id');
            $table->unsignedBigInteger('ruta_asignada')->nullable();
            $table->foreign('ruta_asignada')->references('id')->on('rutas')->onDelete('set null');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('correo')->unique();
            $table->string('username')->unique();
            $table->string('password')->nullable()->default(null);
            $table->string('telefono')->nullable();
            $table->string('password_reset_token')->nullable();
            $table->timestamp('password_reset_token_expires_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repartidores');
    }
};
