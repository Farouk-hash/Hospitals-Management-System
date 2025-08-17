<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;

Route::group(
[
	'prefix' => LaravelLocalization::setLocale() ,
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' , 'auth:patient' ]
], function(){ 
    
    Route::get('/dashboard/patient' , [DashboardController::class , 'patient_index'])
    ->name('dashboard.patient');

    

});

