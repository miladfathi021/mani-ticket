<?php

namespace Database\Factories;

use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seat>
 */
class SeatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'column' => $this->faker->randomDigit(),
            'row' => $this->faker->randomDigit(),
            'seat_code' => $this->faker->uuid,
            'section_id' => Section::factory()->create(),
        ];
    }
}
