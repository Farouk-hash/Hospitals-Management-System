<?php

use App\Http\Controllers\Dashboard\DoctorController;
use App\Http\Controllers\Dashboard\Sections;
use App\Http\Controllers\Dashboard\ServicesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;

Route::group(
[
	'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function(){ 
    
    // ==============================DASHBOARD-HOMEPAGE==============================
    Route::middleware('auth:web')->get('/dashboard/users', [DashboardController::class , 'index'])
    ->name('dashboard.users');    
    Route::middleware('auth:admin')->get('/dashboard/admins', [DashboardController::class , 'index'])
    ->name('dashboard.admins');

    // ==============================SECTIONS-START==============================
    Route::middleware('auth:admin')->controller(Sections::class)
    ->prefix('sections')->group(function(){
        Route::get('/' , 'index')->name('dashboard.sections.index');
        Route::get('/{section_id}','show')->name('dashboard.sections.show');
        Route::post('/','store')->name('dashbord.sections.store');
        Route::put('/','update')->name('dashboard.sections.update');
        Route::delete('/','destroy')->name('dashboard.sections.destroy');
    });
    // ==============================SECTIONS-END==============================

    // ==============================DOCTORS-START==============================
    Route::middleware('auth:admin')->controller(DoctorController::class)
    ->prefix('doctors')->group(function(){
        Route::get('/' , 'index')->name('dashboard.doctors.index');
        Route::get('/create' , 'create')->name('dashboard.doctors.create'); // create-form
        Route::post('/','store')->name('dashboard.doctors.store'); // store-action 

        Route::get('/edit/{doctor_id}' , 'edit')->name('dashboard.doctors.edit'); // edit-form
        Route::put('/','update')->name('dashboard.doctors.update'); // update-action ;
        Route::put('/status','status')->name('dashboard.doctors.update_status');
        Route::put('/password','update_password')->name('dashboard.doctors.update_password');

        Route::delete('/','destroy')->name('dashboard.doctors.destroy');
    });
    // ==============================DOCTORS-END==============================
    
    // =============================SERVICES-START==============================
    Route::middleware('auth:admin')->controller(ServicesController::class)->prefix('services')
    ->group(function(){
        Route::get('/','index')->name('dashboard.services.index');
        Route::post('/','store')->name('dashboard.services.store');
        Route::put('/','update')->name('dashboard.services.update');
        Route::delete('/','destroy')->name('dashboard.services.destroy');

    });
    // ==============================SERVICES-END==============================

    require __DIR__.'/auth.php';

});

