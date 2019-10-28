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

Route::Resource('/dataPengunjung', 'dataPengunjungController');
Route::get('/tabelPengunjung', 'dataPengunjungController@tabelPengunjung')->name('tabel.pengunjung');
Route::get('/tabelPengunjungWisata', 'dataPengunjungController@tabelPengunjungWisata')->name('tabel.pengunjungWisata');

Route::Resource('/wisata', 'wisataController');
Route::post('/dataProvinsi/{id}', 'dataPengunjungController@dataProvinsi')->name('data.provinsi');
Route::get('/tabelwisata', 'wisataController@tabelwisata')->name('tabel.wisata');

Route::Resource('/adminWisata', 'adminWisataController');

Route::Resource('/userWisata', 'userWisataController');
