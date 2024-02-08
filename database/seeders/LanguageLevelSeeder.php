<?php

namespace Database\Seeders;

use App\Models\LanguageLevel;
use Illuminate\Database\Seeder;

class LanguageLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = config('language_setup.language_levels');

        foreach ($levels as $level) {

            LanguageLevel::create(['level' => $level]);
        }
    }
}
