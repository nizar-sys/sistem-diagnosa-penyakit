<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }
    

    public function create2()
    {
        return view('auth.login2');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();
        
        $request->session()->regenerate();
        
        if(!auth()->user()->getIsAdminAttribute()) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/login')->with('error', 'Terjadi sebuah kesalahan');
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function store2(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        if(!auth()->user()->getIsAdminAttribute()) {
            return redirect()->intended(RouteServiceProvider::DIAGNOSA);
        }
        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect('/login2')->with('error', ['Terjadi sebuah kesalahan']);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
