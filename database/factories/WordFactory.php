<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Word>
 */
class WordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'word' => $this->faker->word,
            'ar_translation' => $this->faker->word,
            'en_translation' => $this->faker->word,
            'type_id' => rand(1, 3),
            'language_level_id' => rand(1, 6)
        ];
    }
}
