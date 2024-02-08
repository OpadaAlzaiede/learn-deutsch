<?php

namespace App\Console\Commands;

use Database\Seeders\TypeSeeder;
use Illuminate\Console\Command;

class TypeSeederCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'types:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(TypeSeeder $typeSeeder)
    {
        $this->info('Seeding Types...');
        $typeSeeder->run();
        $this->info('Seeded successfully.');
    }
}
