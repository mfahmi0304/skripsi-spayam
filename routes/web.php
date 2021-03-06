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

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::redirect('/', '/home');
    Route::get('/home', 'HomeController@index')->name('home');

    Route::resources([
        'gejala'            => 'GejalaController',
        'penyakit'          => 'PenyakitController',
        'basis_pengetahuan' => 'BasisPengetahuanController',
        'diagnosa'          => 'DiagnosaController',
    ]);
});
