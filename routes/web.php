<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


// hacer una vista para cerra sesion por metodo get
Route::get('logout', function(){
	Auth::logout();
	return Redirect::to('login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route Hooks - Do not delete//
	Route::view('docentes', 'livewire.docentes.index')->middleware('auth');
	Route::view('paises', 'livewire.paises.index')->middleware('auth');
	Route::view('libros', 'livewire.libros.index')->middleware('auth');
	Route::view('cars', 'livewire.cars.index')->middleware('auth');
	Route::view('ciudades', 'livewire.ciudades.index')->middleware('auth');

