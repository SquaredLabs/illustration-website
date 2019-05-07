<?php
use App\Illustration;

Auth::routes();

Route::redirect('/', 'portfolio');
Route::redirect('/home', '/portfolio');
Route::view('/portfolio', 'portfolio');

Route::redirect('/logincas', '/')->middleware('auth.cas');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::redirect('/admin', '/admin/home');
    Route::post('/illustration', function($request){
        $illustration = new Illustration;
        $illustration->title = $request->input('title');
        $illustration->description = $request->input('description');
        $illustration->image = $request->file('image')->store('illustrations');
        $illustration->save();
    });
    Route::get('/admin/{view}', function ($view) {
        try{
            return view('admin.' . $view);
        }
        catch(\Exception $e){
            abort(404);
        }
    });
});
