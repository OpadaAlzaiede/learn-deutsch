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

        $types = $this->seedTypes();
        $levels = $this->seedLevels();

        foreach ($types as $type) {

            foreach ($levels as $level) {

                Word::factory(10)->create([
                    'type_id' => $type->id,
                    'language_level_id' => $level->id
                ]);
            }
        }
    }

    protected function seedTypes(): array {

        $languageTypes = [];

        $types = config('language_setup.types');

        foreach ($types as $type) {

            array_push($languageTypes, Type::create([
                'type' => $type
            ]));
        }

        return $languageTypes;
    }

    protected function seedLevels(): array {

        $languageLevels = [];

        $levels = config('language_setup.language_levels');

        foreach ($levels as $level) {

            array_push($languageLevels, LanguageLevel::create([
                'level' => $level
            ]));
        }

        return $languageLevels;
    }
}
