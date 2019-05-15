<?php
use App\Illustration;
use Illuminate\Http\Request;

Auth::routes();

Route::redirect('/', 'portfolio');
Route::redirect('/home', '/portfolio');
Route::view('/portfolio', 'portfolio');

Route::redirect('/logincas', '/')->middleware('auth.cas');
Route::middleware('auth.cas')->group(function () {
    Route::view('/request', 'request');
});
Route::middleware(['auth.cas', 'admin'])->group(function () {
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
