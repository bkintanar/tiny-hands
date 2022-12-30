<?php

namespace App\Solutions;

use Illuminate\Support\Facades\Artisan;
use Spatie\Ignition\Contracts\RunnableSolution;

class UIAssetsNotFoundSolution implements RunnableSolution
{
    public function getSolutionTitle(): string
    {
        return config('app.name') . ' UI assets are missing';
    }

    public function getSolutionDescription(): string
    {
        return 'Publish the ' . config('app.name') . ' UI assets using `php artisan vendor:publish --tag=tiny-hands::ui`.';
    }

    public function getDocumentationLinks(): array
    {
        return ['README.md' => 'https://github.com/bkintanar/tiny-hands'];
    }

    public function getSolutionActionDescription(): string
    {
        return 'Click the button below to let the app run the above artisan command for you.';
    }

    public function getRunButtonText(): string
    {
        return 'Publish ' . config('app.name') . ' UI assets';
    }

    public function run(array $parameters = []): void
    {
        Artisan::call('vendor:publish', $parameters);
    }

    public function getRunParameters(): array
    {
        return ['--tag' => 'tiny-hands::ui'];
    }
}
