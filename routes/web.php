<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendedorController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/loginadmin', function () {
    return view('loginadmin');
})->name('loginadmin');
Route::get('/loginvendedor', function () {
    return view('loginvendedor');
})->name('loginvendedor');
//todo esto dentro de admin
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login'); // Ruta para mostrar el formulario de inicio de sesión
    Route::post('/login', [AdminController::class, 'login']);// Ruta para procesar el inicio de sesión

    Route::get('/inicio', [AdminController::class, 'inicio'])->name('admin.inicio');
    // Ruta para la página de inicio del administrador
    Route::get('/clientes', [AdminController::class, 'clientes'])->name('admin.clientes');
    Route::put('/clientes/{cliente_id}', [AdminController::class, 'actualizarCliente'])->name('admin.actualizarCliente');
    Route::delete('/clientes/{cliente_id}/eliminar', [AdminController::class, 'eliminarCliente'])->name('admin.eliminarCliente');
    //rutas para los repartiores
    Route::get('/repartidores', [AdminController::class, 'repartidores'])->name('admin.repartidor');
    Route::put('/repartidore/{repartidor_id}', [AdminController::class, 'updarepar'])->name('admin.updarepar');
    Route::delete('/repartidores/{repartidor_id}/eliminar', [AdminController::class, 'deleterepar'])->name('admin.deleterepar');
    Route::post('/repartidores/registrar', [AdminController::class, 'registrarRepartidor'])->name('admin.registrarRepartidor');
    //rutas para los vendedores
    Route::get('/vendedores', [AdminController::class, 'vendedores'])->name('admin.vendedores');
    Route::get('vendedores/{id}', [AdminController::class, 'actuavendedor'])->name('admin.actuavendedor');
    Route::get('/vendedores/registrar', [AdminController::class,'registrarVendedor'])->name('admin.registrarVendedor');
    Route::delete('/Vendedores/{id}/eliminar', [AdminController::class, 'eliminarVendedor'])->name('admin.eliminarVendedor');
    //rutas para el perfil
    Route::get('/perfil',function(){return view('admin.perfil');})->name('admin.perfil');
    Route::get('/pedidos', [AdminController::class, 'pedidos'])->name('admin.pedidos');
});

//todo esto dentro de vendedor
Route::prefix('vendedor')->group(function () {
    Route::get('/login', [VendedorController::class, 'showLoginForm'])->name('vendedor.login'); // Ruta para mostrar el formulario de inicio de sesión
    Route::post('/login', [VendedorController::class, 'login']);// Ruta para procesar el inicio de sesión
    Route::get('/inicio', function () {return view('vendedor.inicio');})->name('vendedor.inicio');
});
