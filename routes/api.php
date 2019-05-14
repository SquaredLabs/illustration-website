<?php

use Illuminate\Http\Request;
use App\Illustration;
use App\User;
use App\Request as IllustrationRequest;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/illustrations', function(){
    return Illustration::all()->map(function($illustration){
        $illustration->thumbnail_url = Storage::url($illustration->image);
        return $illustration;
    });
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::post('/illustration', function (Request $request) {
        $illustration = new Illustration;
        $illustration->title = $request->input('title');
        $illustration->description = $request->input('description');
        $illustration->image = $request->file('image')->store('public/illustrations');
        $illustration->save();
    });
    Route::get('/illustration/delete/{id}', function ($id, Request $request) {
        $illustration = Illustration::find($id);
        if(!$illustration) return 'That illustration does not exist';
        Storage::delete('public/'.$illustration->image);
        $illustration->delete();
        return  'Successfully deleted `'.$illustration->title.'`';
    });
    Route::get('/requests', function (Request $request) {
        return IllustrationRequest::with(['requestee', 'illustrator'])->get();
    });
    Route::get('/users', function (Request $request) {
        return User::all();
    });
    

});
