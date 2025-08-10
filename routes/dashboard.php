<?php

use App\Http\Controllers\Dashboard\AmbulanceController;
use App\Http\Controllers\Dashboard\DoctorController;
use App\Http\Controllers\Dashboard\InsuranceController;
use App\Http\Controllers\Dashboard\PatientController;
use App\Http\Controllers\Dashboard\PaymentAccountController;
use App\Http\Controllers\Dashboard\RecieptAccountController;
use App\Http\Controllers\Dashboard\Sections;
use App\Http\Controllers\Dashboard\ServicesController;
use App\Http\Controllers\Dashboard\xRayController;
use App\Livewire\GroupServices;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;

Route::group(
[
	'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function(){ 
    
    // ==============================DASHBOARD-HOMEPAGE==============================
    Route::middleware('auth:web')->get('/dashboard/users', [DashboardController::class , 'user_index'])
    ->name('dashboard.users');    
    Route::middleware('auth:admin')->get('/dashboard/admins', [DashboardController::class , 'admin_index'])
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

    // ==============================INSURANCE-START==============================
    
    Route::middleware('auth:admin')->controller(InsuranceController::class)->prefix('insurance')
    ->group(function(){
        Route::get('/','index')->name('dashboard.insurance.index');
        Route::post('/','store')->name('dashboard.insurance.store');
        Route::put('/','update')->name('dashboard.insurance.update');
        Route::delete('/','destroy')->name('dashboard.insurance.destroy');
    });
    // ==============================INSURANCE-END==============================

    // ==============================AMBULANCE-START==============================
    Route::middleware('auth:admin')->controller(AmbulanceController::class)->prefix('ambulance')
    ->group(function(){
        Route::get('/','index')->name('dashboard.ambulance.index');
        Route::get('/create','create')->name('dashboard.ambulance.create');
        Route::post('/','store')->name('dashboard.ambulance.store');
        Route::put('/','update')->name('dashboard.ambulance.update');
        Route::delete('/','destroy')->name('dashboard.ambulance.destroy');
    });
    // ==============================AMBULANCE-END==============================

    // ==============================PATIENT-START==============================
    Route::middleware('auth:admin')->controller(PatientController::class)->prefix('patient')
    ->group(function(){
        Route::get('/','index')->name('dashboard.patient.index');
        Route::get('/show/{patient_id}' , 'show')->name('dashboard.patient.show');
        Route::get('/create','create')->name('dashboard.patient.create');

        Route::post('/','store')->name('dashboard.patient.store');
        Route::put('/','update')->name('dashboard.patient.update');
        Route::delete('/','destroy')->name('dashboard.patient.destroy');
    });
    // ==============================PATIENT-END==============================

    // ==============================PROMiSSORY-START [سندات القبض]==============================
    Route::middleware('auth:admin')->controller(RecieptAccountController::class)->prefix('promissory')
    ->group(function(){
        Route::post('/','store')->name('dashboard.finance_promissory.store');
        // FOR PRINTING ; 
        Route::get('/show/{receiept_account_id}','show')->name('dashboard.finance_promissory.show');
        Route::get('/','index')->name('dashboard.finance_promissory.index');
        Route::get('/create','create')->name('dashboard.finance_promissory.create');
        Route::get('/edit/{receiept_account_id}','edit')->name('dashboard.finance_promissory.edit');
        Route::put('/','update')->name('dashboard.finance_promissory.update');
        Route::delete('/','destroy')->name('dashboard.finance_promissory.destroy');
    });
    // ==============================PROMiSSORY-END==============================
    // ==============================PAYMENT-ACCOUNT-START [سندات الصرف]==============================
    Route::middleware('auth:admin')
    ->controller(PaymentAccountController::class)
    ->prefix('payment')
    ->group(function(){
        Route::get('/','index')->name('dashboard.finance_payment_account.index');
        Route::get('/create','create')->name('dashboard.finance_payment_account.create');
        Route::post('/','store')->name('dashboard.finance_payment_account.store');
        Route::get('/edit/{payment_account_id}','edit')->name('dashboard.finance_payment_account.edit');
        Route::put('/','update')->name('dashboard.finance_payment_account.update');
        Route::delete('/','destroy')->name('dashboard.finance_payment_account.destroy');
    });
    // ==============================PAYMENT-ACCOUNT-END==============================

    Route::prefix('xRays')->controller(xRayController::class)->middleware('auth:admin')->group(function(){
        Route::get('/','index')->name('dashboard.employees.xrays.index');
        Route::get('/create','create')->name('dashboard.employees.xrays.create');
        Route::post('/','store')->name('dashboard.employees.xrays.store');
        Route::delete('/','destroy')->name('dashboard.employees.xrays.destroy');

    });
    // ==============================LIVEWIRE-GROUP-SERVICES==============================
    Route::get('print_single_invoice', function () {
        return view('livewire.Single-Invoices.print-single-invoice');
    })
    ->middleware('auth:admin')
    ->name('dashboard.single-invoices.print');

    require __DIR__.'/auth.php';
});


// ==============================LIVEWIRE-GROUP-SERVICES==============================
Route::get('{lang}/groupservices', function () {
     return view('livewire.include-group-services');
 })
->middleware('auth:admin')
->name('dashboard.group-services.index');

// ==============================LIVEWIRE-SINGLE-INVOICES==============================
Route::get('{lang}/single_invoice',function(){
    return view('livewire.single-invoices.include-single-invoices');
})
->middleware('auth:admin')
->name('dashboard.single-invoices.index');
