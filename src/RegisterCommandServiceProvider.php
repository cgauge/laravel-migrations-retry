<?php

namespace CustomerGauge\RetryMigrations;

use CustomerGauge\RetryMigrations\Commands\MigrateRetryCommand;
use Illuminate\Support\ServiceProvider;

class RegisterCommandServiceProvider extends ServiceProvider
{
    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MigrateRetryCommand::class,
            ]);
        }
    }
}
