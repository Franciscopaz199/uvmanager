<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class loginController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function loginView()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {

            Auth::login($user);

            // Validar que el usuario tenga el rol de admin
            if ($user->hasRole('admin')) {

                return redirect()->route('admin.dashboard');

            } else if ($user->hasRole('user')) {

                return redirect()->route('index');
            }
        }
    }
}
