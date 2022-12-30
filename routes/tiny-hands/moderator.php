<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'role:moderator', 'verified'], 'prefix' => 'p'], function () {
    //
});
