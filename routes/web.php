<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Fortify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\loginController;

Route::get('/', [loginController::class, 'index'])->name('index');
Route::get('/login', [loginController::class, 'loginView'])->name('loginView');
Route::post('/aut', [loginController::class, 'login'])->name('login');


Route::middleware(['role:admin' ])->group(function () {
    
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard')->middleware(['permission:create users']);

})->middleware('auth');
