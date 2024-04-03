<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Ecdsa\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $secret = [
            '-----BEGIN PRIVATE KEY-----',
            'MIGTAgEAMBMGByqGSM49AgEGCCqGSM49AwEHBHkwdwIBAQQg7ktNQa6pxH4zGHKb',
            '/zRMAps/ke47YlZuXieO8kBRh1ygCgYIKoZIzj0DAQehRANCAAQHO+5+fdn3Zmg+',
            'yMfTFssQpMxmma1PkOaPK+6zMzhB0O3Ca4F9LkxQnkabTV1I7vZPq3AwynGRXBag',
            '5QDWUs+s',
            '-----END PRIVATE KEY-----',
        ];

        $implode = implode($secret);
        $this->app->bind(Configuration::class, fn () => Configuration::forSymmetricSigner(
            signer: new Sha256(),
            key: InMemory::plainText($implode),
        ));
    }
}
