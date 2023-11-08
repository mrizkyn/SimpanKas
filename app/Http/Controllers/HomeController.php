<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard based on the user's role.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('Superadmin')) {
            return redirect()->route('superadmin.index');
        } elseif ($user->hasRole('financial')) {
            return redirect()->route('dashboard.index');
        } elseif ($user->hasRole('owner')) {
            return redirect()->route('owner.index');
        }
    }
}
