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


Auth::routes();

Route::redirect('/', 'portfolio');
Route::redirect('/home', '/portfolio');
Route::view('/portfolio', 'portfolio');

Route::redirect('/logincas', '/')->middleware('auth.cas');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::redirect('/admin', '/admin/home');
    Route::get('/admin/{view}', function ($view) {
        try{
            return view('admin.' . $view);
        }
        catch(\Exception $e){
            abort(404);
        }
    });
});
