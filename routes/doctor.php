<?php

use App\Http\Controllers\Doctors\DiagnosticController;
use App\Http\Controllers\Doctors\InvoicesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;

Route::group(
[
	'prefix' => LaravelLocalization::setLocale() ,
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' , 'auth:doctor' ]
], function(){ 
    
    Route::get('/dashboard/doctors' , [DashboardController::class , 'doctor_index'])
    ->name('dashboard.doctors');

    Route::prefix('invoices')->controller(InvoicesController::class)->group(function(){
        Route::get('/' , 'index')->name('doctors_dashboard.doctors.index');
    });

    Route::prefix('diagnostic')->controller(DiagnosticController::class)->group(function(){
        //Route::get('/create/{invoice_id}','index')->name('doctors_dashboard.diagnostic.create');
        Route::post('/','store')->name('doctors_dashboard.diagnostic.store');
        Route::post('/createReview','store_diagnostic_review')->name('doctors_dashboard.diagnostic_review.store');
        Route::post('/createLab' , 'store_diagnostic_lab')->name('doctors_dashboard.diagnostic_lab.store');
        
        Route::get('/show/{patient_id}' , 'show')->name('doctors_dashboard.diagnostic.show');
    });

});

