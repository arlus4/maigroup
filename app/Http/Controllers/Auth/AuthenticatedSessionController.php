<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('pages.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended($this->redirectTo());
    }

    protected function redirectTo()
    {
        if (Auth::check()) {
            switch (Auth::user()->users_type) {
                case 1:
                    return '/pembeli/dashboard';
                case 2:
                    return '/owner/dashboard';
                case 3:
                    return '/pegawai/dashboard';
                case 4:
                    return '/admin/dashboard';
                default:
                    return RouteServiceProvider::HOME;
            }
        }

        return RouteServiceProvider::HOME;
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
