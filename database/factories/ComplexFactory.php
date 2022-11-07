<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComplexFactory extends Factory
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
            'user_id' => User::factory()->create()->id,
            'address' => $this->faker->address(),
            'description' => $this->faker->text(100)
        ];
    }
}
