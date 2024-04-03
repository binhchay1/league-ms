<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Lcobucci\JWT\Configuration;
use Illuminate\Support\Facades\Process;

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
        $result = Process::run('ruby client_secret.rb');
        $output = $result->output();

        $this->app->bind(Configuration::class, $output);
    }
}
