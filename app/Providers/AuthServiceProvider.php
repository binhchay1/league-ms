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
        $this->app->bind(Configuration::class, fn () => Configuration::forSymmetricSigner(
            signer: new Sha256(),
            key: InMemory::plainText(asset('key.txt')),
        ));
    }
}
