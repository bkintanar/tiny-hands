<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:api', 'role:admin', 'verified'], 'prefix' => 'a'], function () {
    //
});
