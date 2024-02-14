<?php

namespace App\Console\Commands;

use Database\Seeders\RoleSeeder;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class RoleSeederCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'roles:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(RoleSeeder $roleSeeder)
    {
        if(Role::query()->count() > 0) {

            $this->error('Roles have already been seeded !');
            return;
        }

        $this->info('Seeding Roles...');
        $roleSeeder->run();
        $this->info('Seeded successfully.');
        $this->newLine();
    }
}
