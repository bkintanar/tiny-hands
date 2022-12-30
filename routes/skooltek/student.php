<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'role:student', 'verified'], 'prefix' => 's'], function () {
    Route::get('dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');
});
