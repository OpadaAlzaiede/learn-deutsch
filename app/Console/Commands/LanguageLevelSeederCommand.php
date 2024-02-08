<?php

namespace App\Console\Commands;

use Database\Seeders\LanguageLevelSeeder;
use Illuminate\Console\Command;

class LanguageLevelSeederCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'language_levels:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(LanguageLevelSeeder $languageLevelSeeder)
    {
        $this->info('Seeding Language Levels...');
        $languageLevelSeeder->run();
        $this->info('Seeded successfully.');
    }
}
