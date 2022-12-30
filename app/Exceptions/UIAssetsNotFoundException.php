<?php

namespace App\Exceptions;

use Spatie\Ignition\Contracts\Solution;
use App\Solutions\UIAssetsNotFoundSolution;
use Spatie\Ignition\Contracts\ProvidesSolution;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class UIAssetsNotFoundException extends FileNotFoundException implements ProvidesSolution
{
    public function getSolution(): Solution
    {
        return new UIAssetsNotFoundSolution();
    }
}
