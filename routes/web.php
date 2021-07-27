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

Route::get('/', function () {
    return redirect()->route('siswa');
});

Route::post('/login', 'Siswa\SiswaController@login')->name('siswa.login');

Route::get('siswa', 'Siswa\SiswaController@index')->name('siswa');

Route::post('siswa/votes', 'Siswa\SiswaController@voting')->name('siswa.votes');

Route::post('siswa', 'Siswa\SiswaController@logout')->name('siswa.logout');

// Admin or Administrator

Route::get('/admin/login', 'Admin\AdminController@form_login')->name('form.admin');
Route::post('/admin/login', 'Admin\AdminController@login')->name('admin.login');

//Dashboard

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('dashboard', 'AdminController@dashboard')->name('dashboard');
    Route::post('logout', 'AdminController@logout')->name('logout');

    // Route buat siswa
    Route::get('siswa', 'SiswaController@index')->name('siswa');
    Route::post('siswa', 'SiswaController@store')->name('siswa.store');

    //Route buat calon
    Route::get('calon', 'CalonController@index')->name('calon');
    Route::post('calon', 'CalonController@store')->name('calon.store');
    Route::delete('calon/{id}', 'CalonController@delete')->name('calon.delete');
    Route::post('calon/all', 'CalonController@deleteall')->name('calon.delete.all');

    //Route buat Laporan
    Route::get('laporan', 'LaporanController@index')->name('laporan');
    Route::get('laporan/votes/export_excel/{year}', 'LaporanController@excel')->name('laporan.excel');
    Route::get('laporan/find', 'LaporanController@findyear')->name('laporan.pertahun');
});
