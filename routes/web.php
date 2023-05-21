<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Fortify;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

Route::get('/', function () {

    Auth::logout();

    return view('welcome');
});

Route::get('/login', function () {
    Auth::logout();
    return view('auth.login');
})->name('loginView');


Route::post('/aut', function (Request $request) {

    $user = User::where('email', $request->email)->first();

    if ($user && Hash::check($request->password, $user->password)) {

        Auth::login($user);


        if (Auth::user()->role == 'admin') {

            $user->assignRole('admin');

            return $user->permissions;

            // return view('admin.dashboard');
        } else {
            $user->assignRole('user');
            return $user->permissions;
            // return view('index');
        }
    }
})->name('login');
