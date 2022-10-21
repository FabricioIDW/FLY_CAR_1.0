<?php

use App\Http\Controllers\ProductController;
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

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');
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

// Route::resource('vehicles', VehicleController::class)->parameters(['vehicles' => 'vehicles'])->names('vehicles');

Route::resource('vehicles', VehicleController::class);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
