<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangkeluarController;
use App\Http\Controllers\CatagoryController;
use App\Http\Controllers\FakturController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\MinimarketController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ReturController;
use App\Http\Controllers\StockminimarController;
use App\Http\Controllers\SuplierController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(UserController::class)->group(function (){
    Route::post('login', 'login');
    Route::post('user_register', 'register');
});
Route::middleware('auth:api')->group(function () {
    Route::controller(UserController::class)->group(function (){
        Route::post('user_update/{id}', 'update');
        Route::post('logout', 'logout');
        Route::get('get_user', 'index');
        Route::get('user_detail/{id}', 'detail');
    });
    Route::resource('/barang', BarangController::class);
    Route::resource('barangkeluar', BarangkeluarController::class);
    Route::resource('category', CatagoryController::class);
    Route::resource('faktur', FakturController::class);
    Route::resource('gudang', GudangController::class);
    Route::resource('minimarket', MinimarketController::class);
    Route::resource('penjualan', PenjualanController::class);
    Route::resource('retur', ReturController::class);
    Route::resource('stockminimart', StockminimarController::class);
    Route::resource('suplier', SuplierController::class);
});

// Route::group(['middleware' => 'auth:api'], function(){

// });
