<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'role:admin', 'verified'], 'prefix' => 'a'], function () {
    Route::get('dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');
});
