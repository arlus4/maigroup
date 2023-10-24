<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;

class Login_Controller extends Controller
{
    /**
     * Display the login view.
     */
    public function create(Request $request): View
    {
        return view('login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        dd($request->all());
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended($this->redirectTo());
    }

    protected function redirectTo()
    {
        switch (Auth::user()->users_type) {
            case 1:
                return '/pembeli/dashboard';
                break;
            case 2:
                return '/penjual/dashboard';
                break;
            case 3:
                return '/pegawai/dashboard';
                break;
            case 4:
                return '/admin/dashboard';
                break;
            default:
                return RouteServiceProvider::HOME;
                break;
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
