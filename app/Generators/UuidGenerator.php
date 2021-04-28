<?php

namespace App\Generators;

use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;

class UuidGenerator implements Generator
{
    public function generate(): string
    {
        return Str::of(Uuid::uuid4()->toString())->limit(16, '')->replace('-', '');
    }
}
