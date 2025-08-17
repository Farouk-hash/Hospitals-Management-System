<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    
    public const WEB = '/dashboard/users';
    public const ADMIN = '/dashboard/admins';
    public const DOCTOR = '/dashboard/doctors';
    public const RAY_EMPLOYEE = '/dashboard/xrayemployee';

    public const PATIENT = '/dashboard/patient';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            // FOR ADMINS ;
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/dashboard.php'));
                
            // FOR DOCTORS ;
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/doctor.php'));

            // FOR xRAYS-EMPLOYEE ;
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/raysEmployees.php'));

            // FOR PATIENTS ;
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/patient.php'));
            
            // FOR CHAT ;
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/chat.php'));
        });
    }
    
}
