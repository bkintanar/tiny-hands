<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'role:teacher', 'verified'], 'prefix' => 't'], function () {
    Route::get('dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');
});
