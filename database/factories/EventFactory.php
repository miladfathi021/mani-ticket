<?php

namespace Database\Factories;

use App\Models\Artist;
use App\Models\Complex;
use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\event>
 */
class EventFactory extends Factory
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
            'description' => $this->faker->text(20),
            'complex_id' => Complex::factory()->create(),
            'artist_id' => Artist::factory()->hasImage(1)->create(),
            'date_start' => $this->faker->date,
            'time_start' => $this->faker->time('H:i'),
            'date_end' => $this->faker->date,
            'time_end' => $this->faker->time('H:i')
        ];
    }
}
