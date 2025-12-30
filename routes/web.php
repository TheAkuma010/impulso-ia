<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard;
use App\Livewire\Onboarding\BusinessForm;
use App\Livewire\Onboarding\ProductsForm;
use App\Livewire\Onboarding\AudiencesForm;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/products', ProductsForm::class)->name('products');
    Route::get('/audiences', AudiencesForm::class)->name('audiences');

    Route::get('/onboarding/business', BusinessForm::class)->name('onboarding.business');

});

