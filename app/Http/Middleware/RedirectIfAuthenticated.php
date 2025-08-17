<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;
        // Define the redirect paths for each guard
        $redirectPaths = [
            'admin' => RouteServiceProvider::ADMIN,
            'doctor' => RouteServiceProvider::DOCTOR,
            'ray_employee'=>RouteServiceProvider::RAY_EMPLOYEE,
            'patient'=>RouteServiceProvider::PATIENT,
            'web' => RouteServiceProvider::WEB, // default web guard
        ];
        
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $redirectPath = $redirectPaths[$guard] ?? RouteServiceProvider::WEB;
                return redirect($redirectPath);
            }
        }
        return $next($request);
    }
}
