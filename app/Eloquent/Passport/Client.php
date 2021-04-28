<?php

namespace App\Eloquent\Passport;

class Client extends \Laravel\Passport\Client
{
    public function getConnectionName()
    {
        return $this->connection;
    }
}
