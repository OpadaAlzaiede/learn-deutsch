<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\LanguageLevel;
use App\Models\Type;
use App\Models\Word;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        $types = Type::all();
        $levels = LanguageLevel::all();

        foreach ($types as $type) {

            foreach ($levels as $level) {

                Word::factory(10)->create([
                    'type_id' => $type->id,
                    'language_level_id' => $level->id
                ]);
            }
        }
    }

}
