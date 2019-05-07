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

Route::get('/portfolio', function () {
    return view('portfolio');
});


Auth::routes();

Route::view('/', 'portfolio');
Route::redirect('/logincas', '/')->middleware('auth.cas');


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin');
    });
});
