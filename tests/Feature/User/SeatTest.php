<?php

namespace Tests\Feature\User;

use App\Models\Event;
use App\Models\Hall;
use App\Models\Seat;
use App\Models\Section;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class SeatTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function user_can_see_a_section_with_seats()
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

        $event = Event::factory([
            'date_start' => $carbon->today()->toDateString(),
        ])
            ->hasAttached($hall, [
                'date_start' => $carbon->next(1)->toDateString(),
                'date_end' => $carbon->next(4)->toDateString(),
                'time_start' => '12:00',
                'time_end' => '23:00'
            ])
            ->hasAttached(
                $seats, [
                    'event_hall_id' => 1,
                    'seat_status' => Seat::$STATUS['active']
                ]
            )
            ->create([
                'date_start' => Carbon::today()->toDateString(),
                'date_end' => $carbon->next(4)->toDateString()
            ]);

        Artisan::call('events:start');

        $this->getJson(route('seats.show', [$event->halls[0]->pivot->id, $section->id]))->dd();
    }
}
