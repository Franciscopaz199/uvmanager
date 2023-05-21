<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;
use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Hash;

class JetstreamServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        //
    }

    public function boot(): void
    {

        Fortify::loginView(function () {
            return view('auth.login');
        });

        // $this->configurePermissions();

        Jetstream::deleteUsersUsing(DeleteUser::class);

        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->email)->first();
    
            if ($user &&
                Hash::check($request->password, $user->password)) {
                return $user;
            }
        });
    }

    protected function configurePermissions(): void
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}
