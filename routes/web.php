<?php

use Illuminate\Support\Facades\Route;
use App\Exceptions\UIAssetsNotFoundException;

Route::get('{path}', function () {
    if (file_exists(public_path('index.html'))) {
        return file_get_contents(public_path('index.html'));
    }

    throw new UIAssetsNotFoundException();
})->where('path', '(.*)')->name('nuxt');
