<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BibliografiaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\SearchController;

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
    return view('intro');
});

Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/user', UserController::class);//->except([]);
Route::put('user', [UserController::class, 'userupdate'])->name('user.userupdate');

Route::resource('/bibliografia', BibliografiaController::class);
Route::resource('/categoria', CategoriaController::class);
Route::resource('libro', LibroController::class);

Route::get('/search/', [App\Http\Controllers\SearchController::class,'search'])->name('search');

Route::get('/showLibro/{id}', [LibroController::class, 'showLibro'])->name('libro.show-libro');
Route::get('/borrar', [UserController::class, 'borrar'])->name('user.borrar');
Route::get('/restaurar/{id}', [UserController::class, 'restaurar'])->name('user.restaurar');
Route::delete('/borrarDefinitivo/{id}', [UserController::class, 'borrarDefinitivo'])->name('user.borrarDefinitivo');

