<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});
//todo esto dentro de admin
Route::prefix('admin')->group(function () {
    // Ruta para mostrar el formulario de inicio de sesión
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    // Ruta para procesar el inicio de sesión
    Route::post('/login', [AdminController::class, 'login']);
    // Ruta para la página de inicio del administrador
    Route::get('/inicio', function () {return view('admin.inicio');})->name('admin.inicio');
    Route::get('/clientes', [AdminController::class, 'clientes'])->name('admin.clientes');
    Route::put('/clientes/{cliente_id}', [AdminController::class, 'actualizarCliente'])->name('admin.actualizarCliente');
    Route::delete('/clientes/{cliente_id}', 'AdminController@eliminarCliente')->name('admin.eliminarCliente');
    //rutas para los repartiores
    Route::get('/repartidores', [AdminController::class, 'repartidores'])->name('admin.repartidor');
    //rutas para los vendedores
    Route::get('/usuarios', function () {return view('admin.vendedores');})->name('admin.vendedores');
    //rutas para el perfil
    Route::get('/perfil',function(){return view('admin.perfil');})->name('admin.perfil');
});