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
        return view('dashboard.auth.signin'); // For Patients , Admins ; 
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $guard = $request->input('guard');
    
        $routeServiceProviderValue = $this->routeServiceProviderValue($guard);
        $request->authenticate();
        $request->session()->regenerate();

        return redirect()->intended($routeServiceProviderValue);         
    }
    protected function routeServiceProviderValue(string $guard){
        if($guard == 'admin'){
            return RouteServiceProvider::ADMIN ;
        }elseif($guard == 'doctor'){
            return RouteServiceProvider::DOCTOR;
        }elseif($guard == 'xray_employee'){
            return RouteServiceProvider::RAY_EMPLOYEE;
        }else{
            return RouteServiceProvider::HOME ;
        }
    }
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        if (Auth::guard('admin')->check()) {
            $guard = 'admin';
        } elseif (Auth::guard('web')->check()) {
            $guard = 'web';
        }elseif (Auth::guard('doctor')->check()) {
            $guard = 'doctor';
        }elseif (Auth::guard('xray_employee')->check()) {
            $guard = 'xray_employee';
        } else {
            abort(500); // not authenticated
        }

        Auth::guard($guard )->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
