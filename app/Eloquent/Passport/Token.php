<?php

namespace App\Eloquent\Passport;

use Exception;
use DateTimeImmutable;
use Laravel\Passport\Passport;
use Lcobucci\JWT\Configuration;
use League\OAuth2\Server\CryptKey;
use Lcobucci\JWT\Signer\Rsa\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Laravel\Passport\PersonalAccessTokenResult;

class Token extends \Laravel\Passport\Token
{
    public function getConnectionName()
    {
        return $this->connection;
    }

    /**
     * Create a new personal access token.
     *
     * @throws Exception
     *
     * @return PersonalAccessTokenResult
     */
    public function getPersonalAccessTokenResult()
    {
        $privateKey = new CryptKey('file://' . Passport::keyPath('oauth-private.key'), null, false);

        $configuration = Configuration::forSymmetricSigner(new Sha256(), InMemory::file($privateKey->getKeyPath()));

        $now = new DateTimeImmutable();
        $expiresAt = new DateTimeImmutable($this->expires_at->toDateTimeString());

        $token = $configuration->builder()
            ->permittedFor($this->client_id)
            ->issuedBy('self')
            ->identifiedBy($this->id)
            ->issuedAt($now)
            ->canOnlyBeUsedAfter($now)
            ->expiresAt($expiresAt)
            ->relatedTo($this->user->id)
            ->withClaim('scopes', [])
            ->getToken($configuration->signer(), $configuration->signingKey());

        return new PersonalAccessTokenResult($token->toString(), $this);
    }
}
