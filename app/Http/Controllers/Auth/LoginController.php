<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers {
        logout as performLogout;
    }
    



    protected function authenticated(Request $request, $user)
{
    $roles = $user->roles;

    if ($roles) {
        $name = $roles[0]['name'];

        if ($name == 'superadmin') {
            return redirect()->route('layouts.app');;
        } elseif ($name == 'akuntan') {
            return redirect()->route('layouts.index');;
        } elseif ($name == 'pemilik') {
            return redirect('layouts.laporan.app');
        }
    }

    return redirect($this->redirectTo);
}
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
