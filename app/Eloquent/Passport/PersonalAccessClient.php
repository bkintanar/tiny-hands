<?php

namespace App\Eloquent\Passport;

class PersonalAccessClient extends \Laravel\Passport\PersonalAccessClient
{
    public function getConnectionName()
    {
        return $this->connection;
    }
}
