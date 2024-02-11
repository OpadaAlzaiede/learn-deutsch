<?php

namespace App\Console\Commands;

use App\Models\LanguageLevel;
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
        if(LanguageLevel::query()->count() > 0) {

            $this->error('Language Levels have already been seeded !');
            return;
        }

        $this->info('Seeding Language Levels...');
        $languageLevelSeeder->run();
        $this->info('Seeded successfully.');
        $this->newLine();
    }
}
