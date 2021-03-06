<?php

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
// });
Route::get('/', 'AuthController@index')->name('login');
Route::post('login', 'AuthController@authenticate')->name('login.auth');
Route::post('logout', 'AuthController@logout')->name('logout');
Route::middleware('auth')->group(function(){
    Route::get('dashboard','DashboardController@index')->name('dashboard');
    Route::resource('user', 'UserController')->middleware('role:Owner,Manager');
    Route::get('user/{id}/password', 'UserController@password')->name('user.password')->middleware('role:Owner');
    Route::put('user/password/{id}', 'UserController@changePassword')->name('user.change.password')->middleware('role:Owner');
    Route::get('user/{id}/permission', 'UserController@permission')->name('user.permission')->middleware('role:Owner');
    Route::post('user/permission', 'UserController@storePermission')->name('user.store.permission')->middleware('role:Owner');

    Route::resource('role', 'RoleController')->middleware('role:Owner');
    Route::resource('kategori', 'KategoriController')->middleware('role:Owner,Manager');
    Route::resource('barang', 'BarangController');
    Route::resource('ruangan', 'RuanganController');
    Route::get('laporan', 'LaporanController@index')->name('laporan.index')->middleware('role:Manager');
    // Route::post('laporan/pdf', 'LaporanController@pdf')->name('laporan.pdf')->middleware('role:Manager');
    // Route::post('laporan/excel', 'LaporanController@excel')->name('laporan.excel')->middleware('role:Manager');
});
