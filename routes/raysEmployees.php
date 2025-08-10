<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;

Route::group(
[
	'prefix' => LaravelLocalization::setLocale() ,
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' , 'auth:xray_employee' ]
], function(){ 
    
    Route::get('/dashboard/xrayemployee' , [DashboardController::class , 'xrayemployee_index'])
    ->name('dashboard.xrayemployee');

});

