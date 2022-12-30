<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'role:member', 'verified'], 'prefix' => 's'], function () {
    //
});
