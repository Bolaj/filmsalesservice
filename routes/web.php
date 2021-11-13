<?php

use App\Models\Movie;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoviesController;

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
    
    $movie = Movie::all();
    return view('home', compact('movie'));
});

Route::get('/dashboard', function () {
    $movie = Movie::all();
    return view('dashboard', compact('movie'));
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';



//Amdin
Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function(){
    Route::namespace('Auth')->group(function(){
        //login route
        Route::get('login', 'AuthenticatedSessionController@create')->name('login');
        Route::post('login', 'AuthenticatedSessionController@store')->name('adminlogin');
    });
    
    Route::middleware('admin')->group(function(){
        Route::get('dashboard', 'HomeController@index')->name('dashboard');
        Route::get('add-movie', [MoviesController::class, 'registerMovie'])->name('add.movie');
        Route::post('store-movie', [MoviesController::class, 'storeMovie'])->name('save.movie');
        Route::get('all-movies', [MoviesController::class, 'index'])->name('show.movies');
        Route::get('edit-movie/{id}', [MoviesController::class, 'editMovie'])->name('edit.movie');
        Route::put('edit-movie/{id}', [MoviesController::class, 'update'])->name('edit-movie');
        //Route::get('delete-movie/{id}', [MoviesController::class, 'deleteMovie']);
        Route::delete('delete-movie/{id}', [MoviesController::class, 'deleteMovie']);
    });
    
    Route::post('logout', 'Auth\AuthenticatedSessionController@destroy')->name('logout');
});

