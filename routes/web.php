<?php

use App\Http\Controllers\OfferController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::controller(ProductController::class)->group(function(){
    Route::get('catalogo', 'catalogo')->name('productos.catalogo');   
    Route::get('products/searchVehicles', 'indexVehiculos')->name('vehiculos.buscar');
    Route::get('products/searchAccesories', 'indexAccesorios')->name('accesorios.buscar');

    Route::get('busquedaV', 'searchV')->name('productos.buscarVehiculos'); 
    Route::get('busquedaA', 'searchA')->name('productos.buscarAccesorios');

    Route::get('vehicleEdit/{vehiculo}', 'editVehicle')->name('vehiculos.editar');
    Route::get('accessoryEdit/{accesorio}', 'editAccesory')->name('accesorios.editar');

    Route::put('vehicle/{vehiculo}','updateVehicle')->name('vehiculos.actualizar');
    Route::put('accesory/{accesorio}','updateAccesory')->name('accesorios.actualizar');

    Route::get('products/vehicleDown/{vehiculo}', 'destroyVehicle')->name('vehiculos.baja');
    Route::get('products/accessoryDown/{accesorio}', 'destroyAccesory')->name('accesorios.baja');
    
    
    Route::get('modelsByBrand', 'modelsBrand')->name('productos.modelosPorMarca');


    Route::get('products/create', 'create')->name('productos.create');

    Route::post('products', 'store')->name('productos.store');

    
    Route::get('products/search/products/{id}', 'destroy_vehicle')->name('productos.destroy');
    // Route::get('products/search/accesory/{id}', 'destroy_accesory')->name('productos_accesorio.destroy');
    
   });

   Route::controller(UserController::class)->group(function(){
    Route::get('indexAdmin', 'indexAdmin')->name('admin.index');

   });
   
   Route::get('/', function () {
       return redirect()->route('productos.catalogo');
   })->name('home');

Route::resource('vehicles', VehicleController::class);
// Offers
Route::controller(OfferController::class)->group(function () {
    Route::get('/ofertas', 'index')->name('offers.index');
    Route::get('/crearOferta', 'create')->name('offers.create');
    Route::get('/editarOferta/{offer}', 'edit')->name('offers.edit');
    Route::post('/ofertas', 'store')->name('offers.store');
    Route::put('/ofertas/{offer}', 'update')->name('offers.update');
    Route::get('/ofertas/{offer}', 'destroy')->name('offers.destroy');
});
// Payment
Route::controller(PaymentController::class)->group(function () {
    Route::get('/pago/{action}/{amount}', 'index')->name('payments.index');
    Route::post('/pago', 'store')->name('payments.store');
});
// Quotations
Route::controller(QuotationController::class)->group(function () {
    Route::get('/cotizacion/{quotation}', 'show')->name('quotations.show');
    Route::get('quotation/{vehiculo}/', 'simularCotizacion')->name('quotations.simularCotizacion');
    Route::post('quotation/', 'agregarOtroVehiculo')->name('quotations.cotizar');
    Route::get('miCotizacion/', 'generarCotizacion')->name('quotations.miCotizacion');
    Route::post('searchQuotation/', 'buscarCotizacion')->name('quotations.search');
});


// Reserve
Route::controller(ReserveController::class)->group(function () {
    Route::get('/reserva', 'create')->name('reserves.create');
});
// Sale
Route::controller(SaleController::class)->group(function () {
    Route::get('/venta/{concretized}', 'create')->name('sales.create');
});
// User
Route::controller(UserController::class)->group(function () {
    // Customer
    Route::get('/crearCuenta', 'index')->name('usersCustomer.index');
    Route::get('/crearCuenta/nuevoCliente', 'create_new_customer')->name('usersCustomer.createNew');
    Route::get('/crearCuenta/clienteExistente', 'create_existing_customer')->name('usersCustomer.createExisting');
    Route::post('/crearCuenta/nuevoCliente', 'store_new_customer')->name('usersCustomer.storeNew');
    Route::post('/crearCuenta/clienteExistente', 'store_existing_customer')->name('usersCustomer.storeExisting');
    Route::put('/user/profile', 'update_customer')->name('usersCustomer.update');
    // Seller
    Route::get('/crearCuenta/vendedor', 'create_seller')->name('usersSeller.create');
    Route::post('/crearCuenta/vendedor', 'store_seller')->name('usersSeller.store');
});

// Middlewares
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
