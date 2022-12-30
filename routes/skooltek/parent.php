<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'role:parent', 'verified'], 'prefix' => 'p'], function () {
    Route::get('dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');
});
