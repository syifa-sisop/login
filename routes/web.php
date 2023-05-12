<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DataGuruController;
use App\Http\Controllers\DataSiswaController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\LayoutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|


Route::get('/', function () {
    return view('welcome');
});*/

//Route::get('login',[LoginController::class,'index'])->name('login');

Route::get('/', [LayoutController::class, 'index'])->middleware('auth');
Route::get('/home', [LayoutController::class, 'index'])->middleware('auth');


Route::controller(LoginController::class)->group(function(){
    Route::get('login','index')->name('login');
    Route::post('login/proses','proses');
    Route::get('logout', 'logout');
});

Route::group(['middleware' => ['auth']], function(){
    Route::group(['middleware' => ['cekUserLogin:1']],function(){
        Route::resource('dataguru',DataGuruController::class);
        Route::resource('kelas',KelasController::class);
        Route::resource('datasiswa',DataSiswaController::class);
        Route::resource('absensi',AbsensiController::class);
        Route::patch('/update/{id}', ['as' => 'datasiswa.update', 'uses' => 'App\Http\Controllers\DataSiswaController@update']);
        Route::delete('/destroy/{id}', ['as' => 'datasiswa.destroy', 'uses' => 'App\Http\Controllers\DataSiswaController@destroy']);


        Route::patch('/update/{id}', ['as' => 'dataguru.update', 'uses' => 'App\Http\Controllers\DataGuruController@update']);
        Route::delete('/delete/{id}', ['as' => 'dataguru.delete', 'uses' => 'App\Http\Controllers\DataGuruController@delete']);
    });
    Route::group(['middleware' => ['cekUserLogin:2']],function(){
        Route::resource('guru',Guru::class);
    });
    Route::group(['middleware' => ['cekUserLogin:3']],function(){
        Route::resource('siswa',Siswa::class);
    });
});
