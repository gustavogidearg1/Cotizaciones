<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use App\Models\Pedido;

use App\Http\Controllers\{
    CategoriaController,
    ClienteController,
    ColorController,
    CotizacionController,
    FamiliaController,
    FormaPagoController,
    HomeController,
    LocalidadController,
    PaisController,
    PedidoController,
    ProductoController,
    ProvinciaController,
    TipoController,
    UnidadController,
    UserController,
    MonedaController
};

// Página de bienvenida
Route::get('/', fn() => view('welcome'));

// Autenticación
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');


// ✅ RUTAS PÚBLICAS
Route::get('cotizaciones/consulta-productos', [CotizacionController::class, 'buscarProducto'])->name('cotizaciones.buscar_producto');
Route::get('cotizaciones/producto/{id}', [CotizacionController::class, 'consultaProducto'])->name('cotizaciones.consulta_producto');


// ✅ RUTAS PROTEGIDAS POR LOGIN
Route::middleware(['auth'])->group(function () {

    // Usuarios
    Route::resource('users', UserController::class)->except(['show']);
    Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
    
    Route::get('/cotizaciones/duplicar', function () {
    return view('components.cotizaciones.duplicar_seleccionar');
})->name('cotizaciones.duplicar.seleccionar');


    Route::get('/cotizaciones/duplicar-con-aumento', [CotizacionController::class, 'duplicarConAumento'])->name('cotizaciones.duplicar');

    // Cotizaciones
    Route::get('/cotizaciones/importar', [CotizacionController::class, 'formImportar'])->name('cotizaciones.importar.form');
    Route::post('/cotizaciones/importar', [CotizacionController::class, 'importar'])->name('cotizaciones.importar');
    Route::get('/cotizaciones/exportar-plantilla', [CotizacionController::class, 'exportarPlantilla'])->name('cotizaciones.exportar.plantilla');
    Route::resource('cotizaciones', CotizacionController::class)->parameters(['cotizaciones' => 'cotizacion']);

    // Productos
    Route::resource('productos', ProductoController::class);

    // Tablas relacionadas
    Route::resource('unidades', UnidadController::class);
    Route::resource('tipos', TipoController::class);
    Route::resource('pedidos', PedidoController::class);
    Route::resource('forma-pagos', FormaPagoController::class);
    Route::resource('monedas', MonedaController::class);

    // País/Provincia/Localidad
    Route::resource('pais', PaisController::class)->parameters(['pais' => 'pais']);
    Route::resource('provincia', ProvinciaController::class)->parameters(['provincia' => 'provincia']);
    Route::resource('localidad', LocalidadController::class)->parameters(['localidad' => 'localidad']);

    // Ruta de debug de roles
    Route::get('/debug-rol', function () {
        $user = Auth::user();
        return view('debug.rol', ['user' => $user, 'is_admin' => Gate::allows('admin')]);
    });
    


});


// ✅ RUTAS GENERALES (fuera de `auth` porque algunas podrían ser públicas)

Route::resource('familias', FamiliaController::class);
Route::resource('categoria', CategoriaController::class);
Route::resource('cliente', ClienteController::class);
// Rutas protegidas para administradores (role_id = 1)
Route::resource('colores', ColorController::class)->parameters(['colores' => 'color']);

Route::get('/pedidos/last-price/{producto}', [PedidoController::class, 'getLastPrice']);
Route::get('/pedidos/{pedido}/pdf', [PedidoController::class, 'generarPDF'])->name('pedidos.pdf');
Route::post('/pedidos', [PedidoController::class, 'store'])->name('pedidos.store');

Route::get('/forma-pago/{id}/diferencia', [PedidoController::class, 'getDiferencia']);
Route::get('/pedido-publico/{token}', [PedidoController::class, 'verPublico'])->name('pedidos.publico');
Route::get('/productos-por-familia/{familia}', [PedidoController::class, 'productosPorFamilia']);

Route::get('/subpedido-template', [PedidoController::class, 'subpedidoTemplate'])->name('subpedido.template');

// Test de email
Route::get('/test-email', function () {
    try {
        Mail::raw('This is a test email', function ($message) {
            $message->to('gustavog@live.com.ar')->subject('Test Email');
        });
        return 'Email sent successfully';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});

// Test de vista email
Route::get('/test-vista-email/{id}', function ($id) {
    $pedido = Pedido::with([
        'formaPago',
        'user',
        'subPedidos.producto',
        'subPedidos.moneda',
        'subPedidos.color',
        'localidad',
        'provincia',
        'pais'
    ])->findOrFail($id);

    return view('emails.pedido_creado', compact('pedido'));
});




