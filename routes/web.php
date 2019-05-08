<?php
use App\Illustration;
use Illuminate\Http\Request;

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
