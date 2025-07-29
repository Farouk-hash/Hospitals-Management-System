<?php

use App\Http\Controllers\Dashboard\Sections;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;

Route::group(
[
	'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function(){ 
    
    // ==============================Dashboard-Homepage==============================
    Route::middleware('auth:web')->get('/dashboard/users', [DashboardController::class , 'index'])
    ->name('dashboard.users');    
    Route::middleware('auth:admin')->get('/dashboard/admins', [DashboardController::class , 'index'])
    ->name('dashboard.admins');

    // ==============================Sections==============================
    Route::middleware('auth:admin')->controller(Sections::class)
    ->prefix('sections')->group(function(){
        Route::get('/' , 'index')->name('dashboard.sections.index');
        Route::post('/','store')->name('dashbord.sections.store');
        Route::post('/update','update')->name('dashboard.sections.update');
        Route::delete('/','destroy')->name('dashboard.sections.destroy');
    });
    require __DIR__.'/auth.php';

});

