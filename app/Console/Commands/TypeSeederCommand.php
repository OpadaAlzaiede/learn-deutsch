<?php

namespace App\Console\Commands;

use App\Models\Type;
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
        if(Type::query()->count() > 0) {

            $this->error('Types have already been seeded !');
            return;
        }

        $this->info('Seeding Types...');
        $typeSeeder->run();
        $this->info('Seeded successfully.');
        $this->newLine();
    }
}
