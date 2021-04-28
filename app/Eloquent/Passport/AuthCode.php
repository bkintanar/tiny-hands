<?php

namespace App\Eloquent\Passport;

class AuthCode extends \Laravel\Passport\AuthCode
{
    public function getConnectionName()
    {
        return $this->connection;
    }
}
