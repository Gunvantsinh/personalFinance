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
    if (auth()->check()) {
        return redirect('/home');
    }
    return view('auth.login');
});



Auth::routes();



Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('categories', 'CategoryController');

    Route::resource('modes', 'ModeController');

    Route::resource('accounts',"AccountController");

    Route::get('transcations/csv_sample', 'TranscationController@SampleCsv')->name('transcations.csv_sample');
    Route::get('transcations/export', 'TranscationController@exportCsv')->name('transcations.export');
    Route::post('transcations/import', "TranscationController@import")->name('importTranscation');
    Route::resource('transcations', "TranscationController");
});