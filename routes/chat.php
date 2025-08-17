<?php

use App\Livewire\Chat\Create;
use App\Livewire\Chat\Main;
use Illuminate\Support\Facades\Route;

// Route::group(
// [
// 	'prefix' => LaravelLocalization::setLocale() ,
// 	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
// ], function(){ 
// });

Route::prefix('{lang}/chat')->group(function(){
    Route::get('/conversation/{send_to}',Create::class)->name('chat.create');
    Route::get('/last_conversations',Main::class)->name('chat.main');
});
