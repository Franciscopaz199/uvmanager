<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Fortify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\loginController;
use Illuminate\Support\Facades\Redirect;

Route::get('/', [loginController::class, 'index'])->name('index');
Route::get('/login', [HomeController::class, 'index'])->name('login');
// Route::post('/aut', [loginController::class, 'login'])->name('login');


Route::middleware(['role:admin' ])->group(function () {
    
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard')->middleware(['permission:create users']);

})->middleware('auth');

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

