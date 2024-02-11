<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::findByName(config('roles.admin', 'admin'), 'web');

        $admin = User::create([
           'name' => 'admin',
           'email' => 'admin@admin.com',
           'password' => Hash::make('password'),
        ]);

        $admin->assignRole($adminRole);
    }
}
