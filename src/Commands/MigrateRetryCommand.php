<?php

namespace CustomerGauge\RetryMigrations\Commands;

use Illuminate\Database\Console\Migrations\BaseCommand;
use Illuminate\Support\Facades\Artisan;

class MigrateRetryCommand extends BaseCommand
{
    protected $signature = 'migrate:retry 
        {--tries=5 : The amount of times to retry.}
        {--delay=3 : The amount in seconds to wait until next retry.}
        {--seed   : Whether we should seed the database or not}';

    public function handle()
    {
        $tries = (int)$this->option('tries');
        $delay = (int)$this->option('delay');

        retry($tries, function () {
            Artisan::call('migrate', $this->migrateParameters());
        }, $delay * 1000);

        $this->output->write(Artisan::output());
    }

    private function migrateParameters()
    {
        $parameters = [];

        if ($this->shouldSeed()) {
            $parameters['--seed'] = true;
        }

        return $parameters;
    }

    private function shouldSeed(): bool
    {
        return (bool)$this->option('seed');
    }
}
