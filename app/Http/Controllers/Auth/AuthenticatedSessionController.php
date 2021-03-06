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

      // dd(auth()->user()->role);
      switch (auth()->user()->role) {
        case 'admin':
          return redirect('admin');
          break;

        case 'laboran':
          return redirect('laboran');
          break;

        case 'keuangan':
          return redirect('keuangan');
          break;

        case 'wadek':
          return redirect('wadek');
          break;

        case 'kaur_laboratorium':
          return redirect('kaur_laboratorium');
          break;

        case 'staff_keuangan':
          return redirect('staff_keuangan');
          break;
        
        default:
          # code...
          break;
      }
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
