<?php

namespace App\Console\Commands;

use App\Models\User;
use Database\Seeders\AdminSeeder;
use Illuminate\Console\Command;

class AdminSeederCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:seeder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(AdminSeeder $adminSeeder)
    {
        if(
            User::whereHas('roles', function ($query) {
                $query->where('name', config('roles.admin', 'admin'));
            })
            ->exists()
        ) {

            $this->error('Admin account has already been seeded !');
            return;
        }

        $this->info('Seeding Admin Account...');
        $adminSeeder->run();
        $this->info('Seeded successfully.');
        $this->newLine();
    }
}
