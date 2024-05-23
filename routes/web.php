<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth', 'verified']],function(){
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
});