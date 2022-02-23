<?php

namespace Zeevx\LaraLazer\Command;

use Illuminate\Console\Command;

class LaraLazerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lazerpay:publish {--force : Overwrite any existing config file}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish lazerpay config file';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->call('vendor:publish', [
            '--tag' => 'lara-lazer-config',
            '--force' => $this->option('force'),
        ]);
    }
}
