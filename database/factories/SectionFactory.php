<?php

namespace Database\Factories;

use App\Models\Hall;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Section>
 */
class SectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'hall_id' => Hall::factory()->create(),
            'row_count' => $this->faker->randomDigit(),
            'column_count' => $this->faker->randomDigit(),
            'row_number_from' => $this->faker->randomDigit(),
            'column_number_from' => $this->faker->randomDigit()
        ];
    }
}
