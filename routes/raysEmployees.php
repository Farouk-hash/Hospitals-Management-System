<?php

use App\Http\Controllers\Doctors\RaysController;
use App\Livewire\Chat\Chatlist;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;

Route::group(
[
	'prefix' => LaravelLocalization::setLocale() ,
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' , 'auth:ray_employee' ]
], function(){ 
    
    Route::get('/dashboard/xrayemployee' , [DashboardController::class , 'xrayemployee_index'])
    ->name('dashboard.xrayemployee');

    Route::prefix('rays')->controller(RaysController::class)->group(function(){
        Route::get('/','index')->name('rays_employees.rays.index');
        Route::get('/edit/{ray_id}','edit')->name('rays_employees.rays.edit');
        Route::put('/','update')->name('rays_employees.rays.update');
        Route::delete('/','destroy')->name('rays_employees.rays.destroy');
        Route::get('/show/{ray_id}' , 'show_ray_images')->name('rays_employees.rays.show_ray_images');
    });


});

