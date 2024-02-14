<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AppCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Seeding application data [language levels | types | roles].');
        $this->newLine();

        $this->call('roles:seed');
        $this->call('language_levels:seed');
        $this->call('types:seed');
        $this->call('admin:seeder');

        $this->info('Application data seeded successfully.');
    }
}
