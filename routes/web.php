<?php

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

Route::get('/', function () {
    return redirect()->route('userWisata.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/tabelPengunjung', 'dataPengunjungController@tabelPengunjung')->name('tabel.pengunjung');
Route::Resource('/dataPengunjung', 'dataPengunjungController');
Route::Resource('/wisata', 'wisataController');
Route::Resource('/userWisata', 'userWisataController');
Route::get('/tabelwisata', 'wisataController@tabelwisata')->name('tabel.wisata');
Route::post('/dataProvinsi/{id}', 'dataPengunjungController@dataProvinsi')->name('data.provinsi');
