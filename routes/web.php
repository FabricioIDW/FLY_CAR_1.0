<?php

use App\Http\Controllers\OfferController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QuotationController;
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

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');
Route::controller(ProductController::class)->group(function () {
    Route::get('catalogo', 'catalogo')->name('productos.catalogo');
});

Route::get('/', function () {
    return redirect()->route('productos.catalogo');
})->name('home');

// Route::resource('vehicles', VehicleController::class)->parameters(['vehicles' => 'vehicles'])->names('vehicles');

Route::resource('vehicles', VehicleController::class);
// Offers
Route::controller(OfferController::class)->group(function () {
    Route::get('/ofertas', 'index')->name('offers.index');
    Route::get('/crearOferta', 'create')->name('offers.create');
    Route::get('/editarOferta/{offer}', 'edit')->name('offers.edit');
    Route::post('/ofertas', 'store')->name('offers.store');
    Route::put('/ofertas/{offer}', 'update')->name('offers.update');
    Route::delete('/ofertas/{offer}', 'destroy')->name('offers.destroy');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

///cotizacion

Route::controller(QuotationController::class)->group( function(){
    //Route::get('curso/create', 'create')->name('curso.create');
    //Route::get('curso', 'index')->name('curso.index');
    Route::get('quotation/{vehiculo}/', 'simularCotizacion')->name('quotations.simularCotizacion');
    Route::post('quotation/cotizar', 'cotizar')->name('quotations.cotizar');
    Route::get('quotation/addVehicle', 'agregarOtroVehiculo')->name('quotations.agregarOtroVehiculo');
    Route::get('quotation/miCotizacion', 'generarCotizacion')->name('quotations.generarCotizacion');
});
