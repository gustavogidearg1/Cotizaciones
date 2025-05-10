<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaisController;
//use App\Http\Controllers\RoleController;
use App\Http\Controllers\TipoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\UnidadController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FamiliaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\FormaPagoController;
use App\Http\Controllers\LocalidadController;
use App\Http\Controllers\ProvinciaController;
use App\Http\Controllers\CotizacionController;
use Illuminate\Support\Facades\Auth; // <-- Añade esta línea


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// routes/web.php


// Rutas protegidas por roles
Route::middleware(['auth', 'can:admin'])->group(function () {
    Route::resource('users', UserController::class)->except(['show']);
});

Route::middleware('auth')->group(function () {
    Route::resource('productos', ProductoController::class);
});

// Opcional: Rutas para las tablas relacionadas (si quieres CRUD para ellas también)
Route::resource('unidades', UnidadController::class)->middleware('auth');
Route::resource('familias', FamiliaController::class);
Route::resource('tipos', TipoController::class)->middleware('auth');

Route::resource('pais', PaisController::class);
Route::resource('provincia', ProvinciaController::class);
Route::resource('localidad', LocalidadController::class);
Route::resource('categoria', CategoriaController::class);
Route::resource('cliente', ClienteController::class);

Route::middleware(['auth'])->group(function () {
    Route::resource('cotizaciones', CotizacionController::class)
        ->parameters(['cotizaciones' => 'cotizacion']);
});


Route::middleware(['auth'])->group(function () {
    Route::resource('pedidos', PedidoController::class);
    Route::resource('forma-pagos', FormaPagoController::class);
});

Route::get('/pedidos/last-price/{producto}', [PedidoController::class, 'getLastPrice']);

Route::get('/pedidos/{pedido}/pdf', [PedidoController::class, 'generarPDF'])->name('pedidos.pdf');

// RUTA DE PRUEBA PARA TESTEAR EL ENVÍO DE CORREOS (TEMPORAL)
Route::get('/test-email', function() {
    try {
        Mail::raw('This is a test email', function($message) {
            $message->to('gustavog@live.com.ar')
                    ->subject('Test Email');
        });
        return 'Email sent successfully';
    } catch (\Exception $e) {
        return 'Error: '.$e->getMessage();
    }
});


Route::get('/productos-por-familia/{familia}', [PedidoController::class, 'productosPorFamilia']);

Route::post('/pedidos', [PedidoController::class, 'store'])->name('pedidos.store');

// Agrega esto con las demás rutas de recursos
Route::get('users/{user}', [UserController::class, 'show'])
    ->middleware('auth')
    ->name('users.show');

    // Rutas protegidas para administradores (role_id = 1)
    Route::middleware(['auth', 'can:admin'])->group(function () {
        Route::resource('colores', ColorController::class);
    });
