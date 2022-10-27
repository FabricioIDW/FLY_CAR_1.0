<?php

use App\Http\Controllers\OfferController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\ReserveController;
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
    Route::get('searchProducts', 'index')->name('productos.buscar');
    Route::get('products/create', 'create')->name('productos.create');
    
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
