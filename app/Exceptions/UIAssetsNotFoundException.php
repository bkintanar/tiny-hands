<?php

namespace App\Exceptions;

use Facade\IgnitionContracts\Solution;
use App\Solutions\UIAssetsNotFoundSolution;
use Facade\IgnitionContracts\ProvidesSolution;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class UIAssetsNotFoundException extends FileNotFoundException implements ProvidesSolution
{
    public function getSolution(): Solution
    {
        return new UIAssetsNotFoundSolution();
    }
}
