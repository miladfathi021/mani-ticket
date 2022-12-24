<?php

namespace Tests\Feature\User;

use App\Models\Event;
use App\Models\Hall;
use App\Models\Seat;
use App\Models\Section;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function users_can_see_all_active_events()
    {
        $this->withoutExceptionHandling();
        $this->singIn();

        $event = Event::factory()->create([
            'date_start' => Carbon::today()->toDateString(),
            'date_end' => Carbon::tomorrow()->toDateString()
        ]);

        $this->getJson(route('events.index'))
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    [
                        'name' => $event->name,
                        'description' => $event->description,
                        'date_start' => Carbon::today()->toDateString(),
                    ]
                ]
            ]);
    }

    /** @test **/
    public function user_can_see_all_halls_a_event()
    {
        $this->withoutExceptionHandling();
        $this->singIn();
        $carbon = new Carbon();

        $hall = Hall::factory()->create();
        $section = Section::factory()->create([
            'hall_id' => $hall->id
        ]);

        $seats = Seat::factory()->count(10)->create([
            'section_id' => $section->id
        ]);

        $event = Event::factory()
            ->hasAttached($hall, [
                'date_start' => $carbon->next(1)->toDateString(),
                'date_end' => $carbon->next(4)->toDateString(),
                'time_start' => '12:00',
                'time_end' => '23:00'
            ])
            ->create([
                'date_start' => Carbon::today()->toDateString(),
                'date_end' => $carbon->next(4)->toDateString()
            ]);


        $this->getJson(route('events.show', $event->id))
            ->assertStatus(200)
            ->assertJson([
                "data" => [
                    "name" => $event->name,
                    "halls" => [
                        [
                            "name" => $hall->name
                        ]
                    ]
                ]
            ]);
    }
}
