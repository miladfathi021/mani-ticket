<?php

namespace Database\Factories;

use App\Models\Complex;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class HallFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'complex_id' => Complex::factory()->create(),
            'description' => $this->faker->text(100)
        ];
    }
}
